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
                    <img id="main-image" src="{{ Vite::asset('resources/images/LaptopMainImage.jpg')}}" class="main-img img-fluid shadow" alt="Main Product Image">

                    <!-- Thumbnail Images -->
                    <div class="container px-0">
                        <div class="row row-cols-md-3 row-cols-lg-6 gx-0">
                            <div class="col-2">
                                <img src="{{ Vite::asset('resources/images/LaptopImage1.jpg')}}" class="img-thumbnail" onclick="changeImage('../static/images/MacBookPro_1.png')" alt="Thumbnail 0">
                            </div>
                            <div class="col-2">
                                <img src="{{ Vite::asset('resources/images/LaptopImage2.png')}}" class="img-thumbnail" onclick="changeImage('../static/images/MacBookPro_2.jpg')" alt="Thumbnail 1">
                            </div>
                            <div class="col-2">
                                <img src="{{ Vite::asset('resources/images/LaptopImage3.jpg')}}" class="img-thumbnail" onclick="changeImage('../static/images/MacBookPro_2.jpg')" alt="Thumbnail 2">
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Right Section (50% or 6/12)aaa -->
                <div class="col-md-5 content-section">
                    <h2>{{ $product->name }}</h2>
                    <h3>{{ $product->brand }}</h3>
                    <p>{{ $product->description}}</p>


                    <div class="mt-3">
                        <h3 style="color: red">Product Tags</h3>
{{--                        <div class="d-flex flex-wrap gap-2">--}}
{{--                            <span class="badge bg-light text-dark">MacBook Pro</span>--}}
{{--                            <span class="badge bg-light text-dark">Apple</span>--}}
{{--                            <span class="badge bg-light text-dark">M4 Chip</span>--}}
{{--                            <span class="badge bg-light text-dark">14-inch</span>--}}
{{--                            <span class="badge bg-light text-dark">Space Black</span>--}}
{{--                        </div>--}}

                        @forelse ($tags as $tag)
                            <span class="badge bg-light text-dark">{{ $tag->name }}</span>
                        @empty
                            <span class="badge bg-light text-dark">no tag</span>
                        @endforelse


                    </div>

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

                        <button type="button" class="btn btn-secondary btn-sm add-cart-btn"> Add to cart   <i class="bi bi-cart-plus"></i></button>

                        <h4 class="mt-1"   id="stock-left">Stocks left: {{ $product->stock}}</h4>

                    </div>
                </div>
            </div>
        </div>


    @include('layouts.footers.footer')
@endsection

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

