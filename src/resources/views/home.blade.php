@extends('layouts.app')

@section('title', 'Home')

@section('content')
<header>
        <nav class="navbar prometex-color navbar-expand-lg navbar-light bg-light ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Prometex</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-supported-content" aria-controls="navbar-supported-content" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse" id="navbar-supported-content">

                    <div class="me-auto"></div>

                    <!-- Search Bar (Properly Responsive) -->
                    <div class="search-container d-flex">

                        <!-- Search Form -->
                        <form class="d-flex search-form">
                            <input class="form-control me-2 search-input" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-light my-0 search-button" type="submit">Search</button>
                        </form>
                    </div>

                    <div class="me-auto"></div>

                    <div class="justify-content-center">
                        <a class="nav-link navbar-icons d-inline-block me-3 fs-4" href="profile-page.html">
                            <i class="bi bi-person"></i>
                        </a>
                        <a class="nav-link navbar-icons d-inline-block position-relative me-3" href="shopping-cart.html">
                            <i class="bi bi-cart fs-4"></i>
                            <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle
                        badge rounded-pill bg-danger cart-badge">3</span>
                        </a>
                    </div>


                </div>

            </div>
        </nav>
    </header>

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

<footer class="py-3 my-4 border-top mb-0 mt-auto">


        <div class="container text-center">
            <div class="row">

                <div class="col">
                    <a href="#" class="nav-link px-2 text-body-secondary footer-text">Home</a>
                </div>
                <div class="col">
                    <a href="#" class="nav-link px-2 text-body-secondary footer-text">Features</a>
                </div>
                <div class="col">
                    <a href="#" class="nav-link px-2 text-body-secondary footer-text">Pricing</a>
                </div>
                <div class="col">
                    <a href="#" class="nav-link px-2 text-body-secondary footer-text">FAQs</a>
                </div>
                <div class="col">
                    <a href="#" class="nav-link px-2 text-body-secondary footer-text">About</a>
                </div>
            </div>
            <div class="pt-2">

                <p class="mb-0 text-body-secondary company-text-footer">© 2025 Prometex, Inc</p>

            </div>
        </div>
    </footer>
@endsection
