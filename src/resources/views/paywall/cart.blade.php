@extends('layouts.app')

@section('title', 'Cart')

@section('content')
@include('layouts.headers.header_with_search')

<main>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-5">
                <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none" href="#"><i class="bi bi-cart-plus"></i> Cart</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.invoice') }}"><i class="bi bi-mailbox"></i> Invoice</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.shipping') }}"><i class="bi bi-truck"></i> Shipping</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.payment') }}"><i class="bi bi-wallet2"></i> Payment</a></li>

            </ol>
        </nav>

        <div class="row row-cols-1 gy-2 ps-5 pe-5">
            <!-- First card -->
            <div class="col my-card border">
                <div class="row row-cols-2 row-cols-md-4 align-items-center m-2">
                    <div class="col">
                        <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
                    </div>

                    <div class="col">
                        <h5 class="card-title mb-0">Samsung A55 128GB/8GB</h5>
                    </div>

                    <div class="col">
                        <p class="card-price fw-bold mb-0">400.99$</p>
                    </div>

                    <div class="col my-card-stepper">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary decrease-amount">−</button>
                            <span class="px-3 fs-5 fw-bold border rounded amount-value">1</span>
                            <button class="btn btn-outline-secondary increase-amount">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second card -->
            <div class="col my-card border">
                <div class="row row-cols-2 row-cols-md-4 align-items-center m-2">
                    <div class="col">
                        <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
                    </div>

                    <div class="col">
                        <h5 class="card-title mb-0">Samsung A55 128GB/8GB</h5>
                    </div>

                    <div class="col">
                        <p class="card-price fw-bold mb-0">400.99$</p>
                    </div>

                    <div class="col my-card-stepper">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary decrease-amount">−</button>
                            <span class="px-3 fs-5 fw-bold border rounded amount-value">1</span>
                            <button class="btn btn-outline-secondary increase-amount">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Third card -->
            <div class="col my-card border">
                <div class="row row-cols-2 row-cols-md-4 align-items-center m-2">
                    <div class="col">
                        <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
                    </div>

                    <div class="col">
                        <h5 class="card-title mb-0">Samsung A55 128GB/8GB</h5>
                    </div>

                    <div class="col">
                        <p class="card-price fw-bold mb-0">400.99$</p>
                    </div>

                    <div class="col my-card-stepper">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-outline-secondary decrease-amount">−</button>
                            <span class="px-3 fs-5 fw-bold border rounded amount-value">1</span>
                            <button class="btn btn-outline-secondary increase-amount">+</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row justify-content-end ps-5 pe-5 p-2">
            <div class="col-auto border text-end">
                <p class="card-price">Sum total: 400.99$</p>
            </div>
        </div>

        <div class="row ps-4 pe-4 p-2">
            <div class="col">
                <a href="{{ route('home') }}" class="btn btn-secondary m-2 size-20-text rounded-pill">
                    <i class="bi bi-arrow-left-short"></i>
                    Back to shopping
                </a>
            </div>
            <div class="col text-end">
                <a href="{{ route('paywall.invoice') }}" class="btn btn-primary m-2 size-20-text rounded-pill">
                    Invoice details
                    <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</main>

@include('layouts.footers.footer')
@endsection
