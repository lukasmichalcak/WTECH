@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include('layouts.headers.header_with_search')

<div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar -->
            <aside class="col-12 col-md-3 col-lg-2 bg-light main-nav-bar p-3">

                <a href="#" class="nav-link link-dark">
                        Smartphones</a>
                    <ul>
                        <li>Apple</li>
                        <li>Samsung</li>
                        <li>Xiaomi</li>
                        <li>GenericMobile</li>
                    </ul>


                <a href="{{ route('products.list', ['type' => 'laptop']) }}" class="nav-link link-dark">
                        Laptops</a>
                    <ul>
{{--                        <li><a href="{{ url('/products-list') }}?brand=Apple">Apple</a></li>--}}
                        <li><a href="{{ route('products.list', ['brand' => 'Apple','type' => 'laptop']) }}">MacBook</a></li>
                        <li><a href="{{ route('products.list', ['brand' => 'Dell', 'type' => 'laptop']) }}">Dell</a></li>
                        <li><a href="{{ route('products.list', ['brand' => 'HP', 'type' => 'laptop']) }}">HP</a></li>

                    </ul>


                <a href="#" class="nav-link link-dark">
                        TVs</a>
                    <ul>
                        <li>LG</li>
                        <li>Samsung</li>
                        <li>Sony</li>
                        <li>VisionTech</li>
                        <li>GenericTV</li>
                    </ul>


                <a href="#" class="nav-link link-dark">
                        Appliances</a>
                    <ul>
                        <li>Whirlpool</li>
                        <li>Electrolux</li>
                        <li>Bosch</li>
                        <li>HomeMaster</li>
                        <li>GenericAppliance</li>
                    </ul>

                <a href="#" class="nav-link link-dark">
                        Accessories</a>
                    <ul>
                        <li>Logitech</li>
                        <li>Razer</li>
                        <li>Bose</li>
                        <li>SoundNova</li>
                        <li>GenericAccessory</li>
                    </ul>


                <a href="#" class="nav-link link-dark">
                        Components</a>
                    <ul>
                        <li>NVIDIA</li>
                        <li>AMD</li>
                        <li>Intel</li>
                        <li>HyperCool</li>
                        <li>GenericComponent</li>
                    </ul>


            </aside>

            <!-- Main Content -->
            <main class="col-12 col-md-9 col-lg-10 text-center">
                <div class="p-3">
                    <div class="carousel-wrapper row align-items-center justify-content-center">

                        <div class="col-auto">
                            <button type="button" class="btn btn-primary carousel-left-button ml-auto"><i class="bi bi-arrow-left"></i></button>
                        </div>
                        <div class="col-9">
                            <img src="https://picsum.photos/id/694/900/375" alt="banner image" class="img-fluid">

                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary carousel-right-button mr-auto"><i class="bi bi-arrow-right"></i></button>
                        </div>

                    </div>

                    <div class="col-12 p-3" style="background-color: white">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                            @forelse ($products as $product)
                                <div class="col">
                                    <a href="{{ url('/product/' . $product->id) }}" class="text-decoration-none text-reset">
                                        <div class="card align-items-center h-100">
                                            <!-- If you have an image column in your products table -->
                                                <img src="{{ Vite::asset('resources/images/GeneratedTV.jpg') }}" class="card-img-top product-card card-img"  alt="product image">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ $product->price }}$</p>
                                                <a href="#" class="card-link" onclick="event.stopPropagation()"><i class="bi bi-cart-plus"></i></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p>No products available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

@include('layouts.footers.footer')
@endsection
