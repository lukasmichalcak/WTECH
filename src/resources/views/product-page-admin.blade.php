@extends('layouts.app')

@section('title', 'Product Page')

@section('content')
    @include('layouts.headers.header_with_search')


    <!-- Split Content Area -->
    <div class="container mt-3">
        <div class="row">
            <!-- Left Section (50% or 6/12) -->
            <div class="col-md-7 content-section">

                <!-- Main Image -->
                @if(count($images) > 0)
                    <form action="{{ route('product.admin.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete the main image?');">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="image_id" id="selected-image-id" value="{{ $images[0]->id }}">

                        <img id="main-image" src="{{ asset('resources/images/' . $images[0]->path) }}" class="main-img img-fluid shadow mb-2" alt="{{ $product->name }}">

                        <button type="submit" class="btn btn-danger">🗑️ Delete This Image</button>
                    </form>
                @else
                    <img id="main-image" src="{{ Vite::asset('resources/images/placeholder.png') }}" class="main-img img-fluid shadow" alt="Product image not available">
                @endif

                <!-- Thumbnail Images -->
                <div class="container px-0 mt-3">
                    <div class="row row-cols-md-3 row-cols-lg-6 gx-0">
                        @foreach($images as $index => $image)
                            <div class="col-2">
                                <img src="{{ asset('resources/images/' . $image->path) }}"
                                     class="img-thumbnail"
                                     onclick="changeImage('{{ asset('resources/images/' . $image->path) }}', '{{ $image->id }}')"
                                     alt="{{ $product->name }} - Image {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Button to delete the whole product and its images -->
                <form action="{{ url('/product-admin/' . $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this product and all its images?');" class="mt-4">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger w-100">🗑️ Delete Product & All Images</button>
                </form>


                <script>
                    function changeImage(newImageSrc, imageId) {
                        document.getElementById('main-image').src = newImageSrc;
                        document.getElementById('selected-image-id').value = imageId;
                    }
                </script>

            </div>

            <!-- Right Section (50% or 6/12)aaa -->
            <div class="col-md-5 content-section">

{{--                <form action="{{ route('product-admin.update', ['id' => $product->id]) }}" method="POST">--}}
                    <form method="POST" action="{{ route('product-admin.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')


                    <h2>Product name</h2>
                    <input type="text" id="product-name" name="name" class="form-control" value="{{ $product->name }}" required>

                    <!-- Brand buttons -->
                    <div class="mb-3">
                        <label for="product-brand" class="form-label">Brand:</label>
                        <select id="product-brand" name="brand" class="form-control" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" {{ $product->brand === $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <h2>Product description</h2>
                    <textarea id="product-description" name="description" class="form-control" rows="6" required>{{ $product->description }}</textarea>

                    <!-- Price -->
                    <div class="mb-3 mt-5">
                        <label for="product-price" class="form-label">Price ($):</label>
                        <input
                            type="number"
                            id="product-price"
                            name="price"
                            class="form-control no-spinners"
                            value="{{ $product->price }}"
                            step="0.01"
                            min="0"
                            required
                        >
                    </div>

                    <!-- Number in stock -->
                    <div class="mb-3 mt-3">
                        <label for="product-stock" class="form-label">Stocks left:</label>
                        <input
                            type="number"
                            id="product-stock"
                            name="stock"
                            class="form-control no-spinners"
                            value="{{ $product->stock }}"
                            step="1"
                            min="0"
                            required
                        >

                    </div>
                    <!-- Uploading image -->
{{--                    <div class="mb-3 mt-4">--}}
{{--                        <label for="product-image" class="form-label">Upload new image:</label>--}}
{{--                        <input type="file" class="form-control" id="product-image" name="image" accept="image/*">--}}
{{--                    </div>--}}


                        <!-- Uploading multiple images -->
                        <div class="mb-3 mt-4">
                            <label for="product-images" class="form-label">Upload new images:</label>
                            <input type="file" class="form-control" id="product-images" name="images[]" accept="image/*" multiple>
                        </div>


                        <!-- Button for uploading -->
                    <button type="submit" class="btn btn-primary mt-4">💾 Save Changes</button>
                </form>


            </div>
        </div>
    </div>


    @include('layouts.footers.footer')
    <script>

        window.onload = function () {

            const attributeGroups = document.querySelectorAll('.attribute-variants');


            attributeGroups.forEach(function (group) {

                // Find all buttons within this specific attribute group only
                const groupButtons = group.querySelectorAll('.color-btn');

                // Add click event listener to each button in this specific group
                groupButtons.forEach(function (btn) {
                    btn.addEventListener('click', function () {

                        groupButtons.forEach(function (b) {
                            b.classList.remove('btn-primary');
                            b.classList.add('btn-secondary');
                        });

                        // Set the clicked button to btn-primary
                        this.classList.remove('btn-secondary');
                        this.classList.add('btn-primary');
                    });
                });
            });
        };
    </script>
    <script>
        document.getElementById('add-cart-btn')?.addEventListener('click', () => {
            const productId = "{{ $product->id }}";
            const selectedVariants = {};

            document.querySelectorAll('.attribute-variants').forEach(group => {
                const activeBtn = group.querySelector('.btn-primary');
                if (activeBtn) {
                    const attributeName = group.previousElementSibling?.textContent.trim(); // Assuming attribute name is above
                    const variantName = activeBtn.textContent.trim();
                    if (attributeName && variantName) {
                        selectedVariants[attributeName] = variantName;
                    }
                }
            });

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: productId,
                    selected_variants: selectedVariants
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        if (data.newItem) {
                            const badge = document.getElementById('cart-badge');
                            if (badge) {
                                const currentCount = parseInt(badge.textContent) || 0;
                                badge.textContent = currentCount + 1;
                            }
                            else {
                                const cartIcon = document.querySelector('.bi-cart');

                                if (cartIcon) {
                                    const span = document.createElement('span');
                                    span.id = 'cart-badge';
                                    span.className = 'position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge';
                                    span.textContent = '1';
                                    cartIcon.parentNode.appendChild(span);
                                }
                            }
                        }
                    } else {
                        alert("Failed to add product.");
                    }
                })
                .catch(() => {
                    alert("Something went wrong.");
                });
        });
    </script>
@endsection
