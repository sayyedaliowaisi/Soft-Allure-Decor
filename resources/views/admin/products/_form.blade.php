
@php
    $editing = isset($product);

    $imageUrl = function ($path) {
        if (!$path) {
            return asset('images/product-placeholder.jpg');
        }

        if (\Illuminate\Support\Str::startsWith($path, [
            'http://', 'https://', '/'
        ])) {
            return $path;
        }

        if (\Illuminate\Support\Str::startsWith($path, [
            'storage/', 'images/', 'uploads/'
        ])) {
            return asset($path);
        }

        return asset('storage/' . $path);
    };

    $image = $imageUrl($editing ? $product->image : null);

    $existingImages = $editing
        ? $product->images
        : collect();

    $selectedCategory = old(
        'category_id',
        $editing ? $product->category_id : ''
    );

    $selectedPriceUnit = old(
        'price_unit',
        $editing ? ($product->price_unit ?? 'piece') : 'piece'
    );

    $selectedStatus = old(
        'status',
        $editing ? (int) $product->status : 1
    );

    $selectedFeatured = old(
        'featured',
        $editing ? (int) $product->featured : 0
    );

    $deleteGalleryIds = array_map(
        'intval',
        (array) old('delete_gallery_images', [])
    );
@endphp

<form
    action="{{ $editing
        ? route('admin.products.update', $product)
        : route('admin.products.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="ap-product-form"
>
    @csrf

    @if($editing)
        @method('PUT')
    @endif

    <div class="ap-form-grid">

        {{-- MAIN COLUMN --}}
        <div class="ap-form-main">

            {{-- BASIC INFORMATION --}}
            <div class="ap-panel ap-form-panel">

                <h2>Basic Information</h2>

                <div class="ap-field">
                    <label for="apName">Product Name *</label>

                    <input
                        type="text"
                        id="apName"
                        name="name"
                        value="{{ old('name', $editing ? $product->name : '') }}"
                        placeholder="e.g. Premium Velvet Curtains"
                        maxlength="255"
                        required
                    >

                    @error('name')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="ap-field">
                    <label for="apSlug">Product Slug</label>

                    <input
                        type="text"
                        id="apSlug"
                        name="slug"
                        value="{{ old('slug', $editing ? $product->slug : '') }}"
                        placeholder="premium-velvet-curtains"
                        maxlength="255"
                    >

                    <small>
                        Leave blank to generate from product name.
                    </small>

                    @error('slug')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="ap-field">
                    <label for="apCategory">Category *</label>

                    <select
                        id="apCategory"
                        name="category_id"
                        required
                    >
                        <option value="">Select Category</option>

                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected((string) $selectedCategory === (string) $category->id)
                            >
                                {{ $category->name }}
                                {{ !$category->status ? '(Inactive)' : '' }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror

                    @if($categories->isEmpty())
                        <small>
                            No categories available.
                            <a href="{{ route('admin.categories.create') }}">
                                Create a category first
                            </a>.
                        </small>
                    @endif
                </div>

                {{-- PRICE AND UNIT --}}
                <div class="ap-price-fields">

                    <div class="ap-field">
                        <label for="apPrice">Product Price (₹)</label>

                        <input
                            type="number"
                            id="apPrice"
                            name="price"
                            min="0"
                            max="99999999.99"
                            step="0.01"
                            value="{{ old('price', $editing ? $product->price : '') }}"
                            placeholder="e.g. 2499.00"
                        >

                        <small>
                            Leave blank for Price on Request.
                        </small>

                        @error('price')
                            <small class="ap-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="ap-field">
                        <label for="apPriceUnit">Price Unit *</label>

                        <select
                            id="apPriceUnit"
                            name="price_unit"
                            required
                        >
                            @foreach(\App\Models\Product::PRICE_UNITS as $value => $label)
                                <option
                                    value="{{ $value }}"
                                    @selected($selectedPriceUnit === $value)
                                >
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        <small>
                            Example: ₹100 / Piece, ₹850 / Roll.
                        </small>

                        @error('price_unit')
                            <small class="ap-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- PRODUCT DESCRIPTION --}}
            <div class="ap-panel ap-form-panel">

                <h2>Product Description</h2>

                <div class="ap-field">
                    <label for="apShortDescription">
                        Short Description
                    </label>

                    <textarea
                        id="apShortDescription"
                        name="short_description"
                        rows="3"
                        maxlength="1000"
                        placeholder="Short product summary..."
                    >{{ old('short_description', $editing ? $product->short_description : '') }}</textarea>

                    @error('short_description')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="ap-field">
                    <label for="apDescription">
                        Full Description
                    </label>

                    <textarea
                        id="apDescription"
                        name="description"
                        rows="8"
                        maxlength="20000"
                        placeholder="Detailed product description..."
                    >{{ old('description', $editing ? $product->description : '') }}</textarea>

                    @error('description')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror
                </div>

            </div>

        </div>

        {{-- SIDE COLUMN --}}
        <div class="ap-form-side">

            {{-- MAIN PRODUCT IMAGE --}}
            <div class="ap-panel ap-form-panel">

                <h2>Main Product Image</h2>

                <div class="ap-image-preview">
                    <img
                        id="apImagePreview"
                        src="{{ $image }}"
                        alt="Product image preview"
                    >
                </div>

                <div class="ap-field">

                    <label for="apImage">
                        {{ $editing ? 'Replace Main Image' : 'Upload Main Image' }}
                    </label>

                    <input
                        type="file"
                        id="apImage"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        JPG, PNG or WebP. Maximum 4 MB.

                        @if($editing)
                            Leave blank to keep the existing image.
                        @endif
                    </small>

                    @error('image')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror

                </div>

            </div>

            {{-- PRODUCT GALLERY --}}
            <div class="ap-panel ap-form-panel">

                <h2>Product Gallery</h2>

                <p class="ap-gallery-help">
                    Add multiple images for the product detail thumbnails.
                    Main image will appear first.
                </p>

                <div class="ap-field">

                    <label for="apGalleryImages">
                        Additional Images
                    </label>

                    <input
                        type="file"
                        id="apGalleryImages"
                        name="gallery_images[]"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                    >

                    <small>
                        Select up to 10 images per upload.
                        Maximum 4 MB per image.
                    </small>

                    @error('gallery_images')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror

                    @foreach($errors->get('gallery_images.*') as $messages)
                        @foreach($messages as $message)
                            <small class="ap-error">{{ $message }}</small>
                        @endforeach
                    @endforeach

                </div>

                {{-- EXISTING GALLERY --}}
                @if($editing && $existingImages->isNotEmpty())

                    <h3 class="ap-gallery-title">
                        Existing Gallery Images
                    </h3>

                    <div class="ap-gallery-list">

                        @foreach($existingImages as $galleryImage)

                            <label class="ap-gallery-item">

                                <img
                                    src="{{ $imageUrl($galleryImage->image) }}"
                                    alt="{{ $product->name }} gallery image"
                                    loading="lazy"
                                >

                                <span>

                                    <input
                                        type="checkbox"
                                        name="delete_gallery_images[]"
                                        value="{{ $galleryImage->id }}"
                                        @checked(in_array((int) $galleryImage->id, $deleteGalleryIds, true))
                                    >

                                    Delete Image

                                </span>

                            </label>

                        @endforeach

                    </div>

                @endif

                @error('delete_gallery_images')
                    <small class="ap-error">{{ $message }}</small>
                @enderror

                @foreach($errors->get('delete_gallery_images.*') as $messages)
                    @foreach($messages as $message)
                        <small class="ap-error">{{ $message }}</small>
                    @endforeach
                @endforeach

            </div>

            {{-- PUBLISHING SETTINGS --}}
            <div class="ap-panel ap-form-panel">

                <h2>Publishing Settings</h2>

                <div class="ap-field">

                    <label for="apStatus">Product Status</label>

                    <select id="apStatus" name="status">

                        <option
                            value="1"
                            @selected((string) $selectedStatus === '1')
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            @selected((string) $selectedStatus === '0')
                        >
                            Inactive
                        </option>

                    </select>

                    <small>
                        Inactive products are hidden from public listings.
                    </small>

                    @error('status')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror

                </div>

                <div class="ap-field">

                    <label for="apFeatured">Featured Product</label>

                    <select id="apFeatured" name="featured">

                        <option
                            value="0"
                            @selected((string) $selectedFeatured === '0')
                        >
                            No
                        </option>

                        <option
                            value="1"
                            @selected((string) $selectedFeatured === '1')
                        >
                            Yes
                        </option>

                    </select>

                    <small>
                        Use this option for highlighted products.
                    </small>

                    @error('featured')
                        <small class="ap-error">{{ $message }}</small>
                    @enderror

                </div>

            </div>

        </div>

    </div>

    {{-- FORM ACTIONS --}}
    <div class="ap-form-footer">

        <a
            href="{{ route('admin.products.index') }}"
            class="ap-btn ap-btn-outline"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="ap-btn ap-btn-primary"
            id="apSubmitButton"
        >
            {{ $editing ? 'Update Product' : 'Save Product' }}
        </button>

    </div>

</form>
