@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include('layouts.headers.header_with_search')

<div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar -->
            <aside class="col-12 col-md-3 col-lg-2 bg-light main-nav-bar p-3">
                @foreach ($sidebar as $type => $brands)
                    <a href="{{ route('products.list', ['type' => $type]) }}" class="nav-link link-dark">
                        {{ $type }}
                    </a>
                    @if ($brands->count())
                        <ul>
                            @foreach ($brands as $brand)
                                <li>
                                    <a class="nav-link link-dark"
                                       href="{{ route('products.list', ['type' => $type, 'brand' => $brand]) }}">
                                        {{ $brand }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
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
                                            <img src="{{ asset('resources/images/' . $product->image_path) }}" class="card-img-top product-card card-img" alt="product image">

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
@if (session('order_success'))
    <script>
        window.addEventListener('load', () => {
            setTimeout(() => {
                alert("{{ session('order_success') }}\nWe will inform you about its state via your email");
            }, 200);
        });
    </script>
@endif

@endsection
