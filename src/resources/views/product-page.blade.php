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
                        <img id="main-image" src="{{ asset('resources/images/' . $images[0]->path) }}" class="main-img img-fluid shadow" alt="{{ $product->name }}">
                    @else
                        <img id="main-image" src="{{ Vite::asset('resources/images/placeholder.png') }}" class="main-img img-fluid shadow" alt="Product image not available">
                    @endif

                    <!-- Thumbnail Images -->
                    <div class="container px-0">
                        <div class="row row-cols-md-3 row-cols-lg-6 gx-0">
                            @forelse($images as $index => $image)
                                <div class="col-2">
                                    <img src="{{ asset('resources/images/' . $image->path) }}"
                                         class="img-thumbnail"
                                         onclick="changeImage('{{ asset('resources/images/' . $image->path) }}')"
                                         alt="{{ $product->name }} - Image {{ $index + 1 }}">
                                </div>
                            @empty
                                <div class="col-6">
                                    <p>No product images available</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <script>
                        function changeImage(newImageSrc) {
                            document.getElementById('main-image').src = newImageSrc;
                        }
                    </script>

                </div>

                <!-- Right Section (50% or 6/12)aaa -->
                <div class="col-md-5 content-section">
                    <h2>{{ $product->name }}</h2>
                    <h3>{{ $product->brand }}</h3>
                    <p>{{ $product->description}}</p>

                    <div class="ms-2">

                        @forelse ($attributes as $attribute)
                            <h3>{{ $attribute->name }}</h3>

                            <div class="attribute-variants">
                                @forelse ($attribute->variants as $index => $variant)
                                    <button type="button" class="btn {{ $index === 0 ? 'btn-primary' : 'btn-secondary' }} btn-sm color-btn"
                                            data-variant-id="{{ $variant->id }}">
                                        {{ $variant->name }}
                                    </button>
                                @empty
                                    <p>No variants available for this attribute</p>
                                @endforelse
                            </div>
                        @empty
                            <h3>No attributes found</h3>
                        @endforelse

                        <h3 class="mt-5 price">{{ $product->price }}</h3>

                        <button id="add-cart-btn" type="button" class="btn btn-secondary btn-sm add-cart-btn"> Add to cart <i class="bi bi-cart-plus"></i></button>

                        <h4 class="mt-1"   id="stock-left">Stocks left: {{ $product->stock}}</h4>

                    </div>
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
