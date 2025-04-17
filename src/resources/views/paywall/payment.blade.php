@extends('layouts.app')

@section('title', 'Payment')

@section('content')
@include('layouts.headers.header_with_search')

<main>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-5">
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.cart') }}"> <i class="bi bi-cart-plus"></i> Cart</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.invoice') }}"><i class="bi bi-mailbox"></i> Invoice</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.shipping') }}"><i class="bi bi-truck"></i> Shipping</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none" href="#"><i class="bi bi-wallet2"></i> Payment</a></li>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 size-20-text ps-5 pe-5">
                <div class="container border rounded-3 p-4 mb-2">
                    <div class="row mb-4 justify-content-center">
                        <div class="col-auto">
                            <img src="{{ Vite::asset('resources/icons/credit-card.svg') }}" alt="Credit Card" class="img-fluid" style="max-height: 160px;">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col">
                            <label class="form-label fw-semibold">Use saved card:</label>
                        </div>
                        <div class="col">
                            <select class="form-select">
                                <option>Mastercard</option>
                                <option>Visa</option>
                                <option>Amex</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Name on card:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="John Doe">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Card number:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label class="form-label">Expiry date:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="MM / YY">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">CV:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="•••">
                                <span class="input-group-text"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-end">
                            <img src="{{ Vite::asset('resources/icons/visa.svg') }}" alt="Visa" height="30" class="mx-1">
                            <img src="{{ Vite::asset('resources/icons/mastercard.svg') }}" alt="MasterCard" height="30" class="mx-1">
                            <img src="{{ Vite::asset('resources/icons/amex.svg') }}" alt="Amex" height="30" class="mx-1">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-start p-3 border border-5 rounded-3 mb-2">
                    <div>
                        <strong>I prefer Internet Banking</strong><br>
                    </div>
                    <label>
                        <input type="checkbox">
                    </label>
                </div>
                <div class="d-flex justify-content-between align-items-start p-3 border border-5 rounded-3">
                    <div>
                        <strong>I prefer to pay cash in-place</strong><br>
                    </div>
                    <label>
                        <input type="checkbox">
                    </label>
                </div>
            </div>

            <div class="col-md-6 pe-5 ps-5 ps-md-0">
                <div class="border rounded-3">
                    <h3 class="fw-bold m-2 border-bottom">Order Summary</h3>

                    <div class="container-fluid">
                        <div class="row row-cols-1 gy-2 pb-2">
                            <!-- First card -->
                            <div class="col my-card border-bottom">
                                <div class="row align-items-center px-2 py-2">
                                    <div class="col">
                                        <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
                                    </div>

                                    <div class="col">
                                        <div class="row row-cols-1 gy-4">
                                            <div class="col">
                                                <h5 class="card-title mb-0">Samsung A55 128GB/8GB</h5>
                                            </div>

                                            <div class="col">
                                                <p class="card-price fw-bold mb-0">400.99$</p>
                                            </div>
                                        </div>
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
                            <div class="col my-card border-bottom">
                                <div class="row align-items-center px-2 py-2">
                                    <div class="col">
                                        <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
                                    </div>

                                    <div class="col">
                                        <div class="row row-cols-1 gy-4">
                                            <div class="col">
                                                <h5 class="card-title mb-0">Samsung A55 128GB/8GB</h5>
                                            </div>

                                            <div class="col">
                                                <p class="card-price fw-bold mb-0">400.99$</p>
                                            </div>
                                        </div>
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
                            <div class="col my-card border-bottom">
                                <div class="row align-items-center px-2 py-2">
                                    <div class="col">
                                        <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
                                    </div>

                                    <div class="col">
                                        <div class="row row-cols-1 gy-4">
                                            <div class="col">
                                                <h5 class="card-title mb-0">Samsung A55 128GB/8GB</h5>
                                            </div>

                                            <div class="col">
                                                <p class="card-price fw-bold mb-0">400.99$</p>
                                            </div>
                                        </div>
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

                        <div class="container-fluid">
                            <div class="row justify-content-end pb-2 me-0">
                                <div class="col-auto border text-end">
                                    <p class="card-price">Sum total: 400.99$</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col text-center">
                                    <img src="{{ Vite::asset('resources/icons/visa.svg') }}" alt="Visa" height="60" class="mx-1">
                                    <img src="{{ Vite::asset('resources/icons/mastercard.svg') }}" alt="MasterCard" height="60" class="mx-1">
                                    <img src="{{ Vite::asset('resources/icons/amex.svg') }}" alt="Amex" height="60" class="mx-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ps-4 pe-4 p-2">
            <div class="col">
                <a href="{{ route('paywall.shipping') }}" class="btn btn-secondary m-2 size-20-text rounded-pill">
                    <i class="bi bi-arrow-left-short"></i>
                    Back to Shipping
                </a>
            </div>
            <div class="col text-end">
                <a href="{{ route('home') }}" class="btn btn-primary m-2 size-20-text rounded-pill">
                    Confirm payment
                    <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</main>

@include('layouts.footers.footer')
@endsection
