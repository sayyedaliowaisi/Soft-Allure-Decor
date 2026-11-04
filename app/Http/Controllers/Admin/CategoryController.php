<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CATEGORY LIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $categories = Category::withCount('products')
            ->latest()
            ->paginate(10);

        $totalCategories = Category::count();

        $activeCategories = Category::where('status', true)
            ->count();

        $inactiveCategories = Category::where('status', false)
            ->count();

        return view('admin.categories.index', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'inactiveCategories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE CATEGORY
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.categories.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE CATEGORY
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->validationRules()
        );

        $validated['slug'] = $this->makeSlug(
            $validated['slug'] ?? null,
            $validated['name']
        );

        $newImage = null;

        unset($validated['image']);

        try {
            if ($request->hasFile('image')) {
                $newImage = $request
                    ->file('image')
                    ->store('categories', 'public');

                $validated['image'] = $newImage;
            }

            Category::create($validated);

        } catch (\Throwable $exception) {
            if ($newImage) {
                $this->deleteManagedImage($newImage);
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW CATEGORY
    |--------------------------------------------------------------------------
    */

    public function show(Category $category)
    {
        return redirect()
            ->route('admin.categories.edit', $category);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT CATEGORY
    |--------------------------------------------------------------------------
    */

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE CATEGORY
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate(
            $this->validationRules($category)
        );

        $validated['slug'] = $this->makeSlug(
            $validated['slug'] ?? null,
            $validated['name'],
            $category
        );

        $oldImage = $category->image;
        $newImage = null;

        unset($validated['image']);

        try {
            if ($request->hasFile('image')) {
                $newImage = $request
                    ->file('image')
                    ->store('categories', 'public');

                $validated['image'] = $newImage;
            }

            $category->update($validated);

        } catch (\Throwable $exception) {
            if ($newImage) {
                $this->deleteManagedImage($newImage);
            }

            throw $exception;
        }

        if ($newImage && $oldImage && $oldImage !== $newImage) {
            $this->deleteManagedImage($oldImage);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE CATEGORY
    |--------------------------------------------------------------------------
    */

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()
                ->route('admin.categories.index')
                ->with(
                    'error',
                    'Cannot delete this category because it contains products.'
                );
        }

        $image = $category->image;

        $category->delete();

        if ($image) {
            $this->deleteManagedImage($image);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | VALIDATION RULES
    |--------------------------------------------------------------------------
    */

    private function validationRules(?Category $category = null): array
    {
        $nameRule = Rule::unique('categories', 'name');

        if ($category) {
            $nameRule->ignore($category->id);
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                $nameRule,
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | GENERATE UNIQUE CATEGORY SLUG
    |--------------------------------------------------------------------------
    */

    private function makeSlug(
        ?string $inputSlug,
        string $name,
        ?Category $category = null
    ): string {
        $slug = Str::slug(
            filled($inputSlug) ? $inputSlug : $name
        );

        if ($slug === '') {
            throw ValidationException::withMessages([
                'slug' => 'Please enter a valid category name or slug.',
            ]);
        }

        if (strlen($slug) > 255) {
            throw ValidationException::withMessages([
                'slug' => 'Category slug cannot exceed 255 characters.',
            ]);
        }

        $query = Category::where('slug', $slug);

        if ($category) {
            $query->where('id', '!=', $category->id);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'slug' => 'This category slug already exists.',
            ]);
        }

        return $slug;
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE MANAGED CATEGORY IMAGE
    |--------------------------------------------------------------------------
    */

    private function deleteManagedImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $path = str_replace('\\', '/', $path);

        if (
            Str::startsWith($path, 'categories/') &&
            !str_contains($path, '..')
        ) {
            Storage::disk('public')->delete($path);
        }
    }
}
