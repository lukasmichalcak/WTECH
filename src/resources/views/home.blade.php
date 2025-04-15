@extends('layouts.app')

@section('title', 'Home')

@section('content')
@include('layouts.headers.header_with_search')

<div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar -->
            <aside class="col-12 col-md-3 col-lg-2 bg-light main-nav-bar p-3">
                <ul class="nav nav-pills row">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">
                            Home</a>
                    </li>
                    <li><a href="#" class="nav-link link-dark">
                            Smartphones</a>
                    </li>
                    <li><a href="#" class="nav-link link-dark">
                            Laptops</a>
                    </li>
                    <li><a href="#" class="nav-link link-dark">
                            TVs</a>
                    </li>
                    <li><a href="#" class="nav-link link-dark">
                            Appliances</a>
                    </li>
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
                            <!-- First card -->
                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55">
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Second card -->
                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55">
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Third card -->
                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55" >
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card align-items-center h-100">
                                    <img src="{{ Vite::asset('resources/images/A55.png') }}" class="card-img-top product-card" alt="a55" >
                                    <div class="card-body">
                                        <h5 class="card-title">Samsung A55 128GB/8GB</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>400.99$</p>
                                        <a href="#" class="card-link"><i class="bi bi-cart-plus"></i></a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

@include('layouts.footers.footer')
@endsection
