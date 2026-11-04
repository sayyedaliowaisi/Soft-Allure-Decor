<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PRODUCT LISTING
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $products = Product::query()
            ->with('category')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact(
            'products',
            'search'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE FORM
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('admin.products.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        $validated['slug'] = $this->makeSlug($validated);
        $validated['featured'] = $request->boolean('featured');
        $validated['status'] = $request->boolean('status');

        unset(
            $validated['gallery_images'],
            $validated['delete_gallery_images']
        );

        $uploadedPaths = [];

        try {
            DB::transaction(function () use (
                $request,
                $validated,
                &$uploadedPaths
            ) {
                if ($request->hasFile('image')) {
                    $validated['image'] = $this->uploadImage(
                        $request->file('image'),
                        'products',
                        $uploadedPaths
                    );
                }

                $product = Product::create($validated);

                $this->saveGalleryImages(
                    $request,
                    $product,
                    $uploadedPaths
                );
            });
        } catch (\Throwable $e) {
            $this->deleteManagedImages($uploadedPaths);

            throw $e;
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show(Product $product)
    {
        return redirect()
            ->route('admin.products.edit', $product);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT FORM
    |--------------------------------------------------------------------------
    */
    public function edit(Product $product)
    {
        $product->load('images');

        $categories = Category::query()
            ->orderBy('name')
            ->get();

        return view('admin.products.edit', compact(
            'product',
            'categories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product);

        $validated['slug'] = $this->makeSlug($validated, $product);
        $validated['featured'] = $request->boolean('featured');
        $validated['status'] = $request->boolean('status');

        unset(
            $validated['gallery_images'],
            $validated['delete_gallery_images']
        );

        $uploadedPaths = [];
        $pathsToDelete = [];

        try {
            DB::transaction(function () use (
                $request,
                $product,
                $validated,
                &$uploadedPaths,
                &$pathsToDelete
            ) {
                $oldMainImage = $product->image;

                if ($request->hasFile('image')) {
                    $validated['image'] = $this->uploadImage(
                        $request->file('image'),
                        'products',
                        $uploadedPaths
                    );

                    if ($oldMainImage) {
                        $pathsToDelete[] = $oldMainImage;
                    }
                }

                $product->update($validated);

                // Add new gallery images.
                $this->saveGalleryImages(
                    $request,
                    $product,
                    $uploadedPaths
                );

                // Remove selected gallery image records.
                $deleteIds = $request->input(
                    'delete_gallery_images',
                    []
                );

                if (!empty($deleteIds)) {
                    $images = $product->images()
                        ->whereIn('id', $deleteIds)
                        ->get();

                    foreach ($images as $image) {
                        $pathsToDelete[] = $image->image;

                        $image->delete();
                    }
                }
            });
        } catch (\Throwable $e) {
            // Database rolled back: remove only newly uploaded files.
            $this->deleteManagedImages($uploadedPaths);

            throw $e;
        }

        // Delete replaced/removed files after DB commit.
        $this->deleteManagedImages($pathsToDelete);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */
    public function destroy(Product $product)
    {
        $pathsToDelete = [];

        DB::transaction(function () use (
            $product,
            &$pathsToDelete
        ) {
            if ($product->image) {
                $pathsToDelete[] = $product->image;
            }

            $galleryPaths = $product->images()
                ->pluck('image')
                ->all();

            $pathsToDelete = array_merge(
                $pathsToDelete,
                $galleryPaths
            );

            $product->delete();
        });

        // Files are removed only after product deletion succeeds.
        $this->deleteManagedImages($pathsToDelete);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATE PRODUCT
    |--------------------------------------------------------------------------
    */
    private function validateProduct(
        Request $request,
        ?Product $product = null
    ): array {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id'),
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'price_unit' => [
                'required',
                'string',
                Rule::in(array_keys(Product::PRICE_UNITS)),
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'description' => [
                'nullable',
                'string',
                'max:20000',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'gallery_images' => [
                'nullable',
                'array',
                'max:10',
            ],

            'gallery_images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'delete_gallery_images' => [
                'nullable',
                'array',
            ],

            'delete_gallery_images.*' => [
                'integer',
                Rule::exists('product_images', 'id')
                    ->where('product_id', $product?->id ?? 0),
            ],

            'featured' => [
                'required',
                'boolean',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE UNIQUE SLUG
    |--------------------------------------------------------------------------
    */
    private function makeSlug(
        array $validated,
        ?Product $product = null
    ): string {
        $source = !empty($validated['slug'])
            ? $validated['slug']
            : $validated['name'];

        $slug = Str::slug($source);

        if ($slug === '') {
            throw ValidationException::withMessages([
                'slug' => 'Please enter a valid product name or slug.',
            ]);
        }

        if (strlen($slug) > 255) {
            throw ValidationException::withMessages([
                'slug' => 'The generated slug is too long.',
            ]);
        }

        $exists = Product::query()
            ->where('slug', $slug)
            ->when($product, function ($query) use ($product) {
                $query->where('id', '!=', $product->id);
            })
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'slug' => 'This product slug already exists. Please use another slug.',
            ]);
        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD IMAGE AND TRACK PATH
    |--------------------------------------------------------------------------
    */
    private function uploadImage(
        $file,
        string $directory,
        array &$uploadedPaths
    ): string {
        $path = $file->store($directory, 'public');

        if (!$path) {
            throw new \RuntimeException(
                'Unable to upload product image.'
            );
        }

        $uploadedPaths[] = $path;

        return $path;
    }

    /*
    |--------------------------------------------------------------------------
    | SAVE GALLERY IMAGES
    |--------------------------------------------------------------------------
    */
    private function saveGalleryImages(
        Request $request,
        Product $product,
        array &$uploadedPaths
    ): void {
        $nextOrder = (int) $product->images()
            ->max('sort_order') + 1;

        foreach ($request->file('gallery_images', []) as $file) {
            $path = $this->uploadImage(
                $file,
                'products/gallery',
                $uploadedPaths
            );

            $product->images()->create([
                'image' => $path,
                'sort_order' => $nextOrder++,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE MANAGED IMAGES
    |--------------------------------------------------------------------------
    */
    private function deleteManagedImages(array $paths): void
    {
        foreach (array_unique($paths) as $path) {
            $this->deleteManagedImage($path);
        }
    }

    private function deleteManagedImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $path = str_replace('\\', '/', $path);

        // Only delete images inside the managed products directory.
        if (!Str::startsWith($path, 'products/')) {
            return;
        }

        if (str_contains($path, '..')) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
