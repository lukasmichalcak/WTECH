@extends('layouts.app')

@section('title', 'Shipping')

@section('content')
@include('layouts.headers.header_with_search')

<main>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-5">
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.cart') }}"> <i class="bi bi-cart-plus"></i> Cart</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.invoice') }}"><i class="bi bi-mailbox"></i> Invoice</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none" href="#"><i class="bi bi-truck"></i> Shipping</a></li>
                <li class="breadcrumb-item"><a class="text-body text-decoration-none" href="{{ route('paywall.payment') }}"><i class="bi bi-wallet2"></i> Payment</a></li>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 col-lg-6 size-20-text ps-5 pe-5">
                <h1 class="pb-4">Choose your preferred delivery option:</h1>
                <div class="border rounded-3 mb-3">
                    <div class="form-check d-flex justify-content-between align-items-start p-3 border-bottom">
                        <label class="form-check-label" for="storePickup">
                            <strong>Store pickup</strong><br>
                            <i>Store located at: Hraničná 667/8 05801, Trnava, Slovakia</i>
                        </label>
                        <input class="form-check-input" type="radio" name="transportOptions"
                               id="storePickup" value="store_pickup">
                    </div>

                    <div class="form-check d-flex justify-content-between align-items-start p-3 border-bottom">
                        <label class="form-check-label" for="standardDelivery">
                            <strong>Standard Delivery</strong><br>
                            <i>Products will be delivered according to your address details (+ 5$)</i>
                        </label>
                        <input class="form-check-input" type="radio" name="transportOptions"
                               id="standardDelivery" value="standard_delivery">
                    </div>

                    <div class="form-check d-flex justify-content-between align-items-start p-3 border-bottom">
                        <label class="form-check-label" for="speedyDelivery">
                            <strong>Speedy Delivery</strong><br>
                            <i>Delivery to your address, made at an accelerated pace (+ 10$)</i>
                        </label>
                        <input class="form-check-input" type="radio" name="transportOptions"
                               id="speedyDelivery" value="speedy_delivery">
                    </div>

                    <div class="text-center mt-3">
                        <button id="save-shipping-btn" class="btn btn-success rounded-pill mt-3 mb-3">Use Delivery Option</button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-start p-3 border border-5 rounded-3 mb-3">
                    <div>
                        <strong>Return Delivery</strong><br>
                        <i>Free 30 days delivery</i>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 pe-5 ps-5 ps-lg-0">
                <div class="border rounded-3">
                    <h3 class="fw-bold m-2 border-bottom">Order Summary</h3>

                    <div class="container-fluid">
                        <div class="row row-cols-1 gy-2 pb-2">
                            @foreach($cartItems as $cartItem)
                                @php
                                    $variantHash = normalizeVariants($cartItem->selected_variants);
                                @endphp

                                <div class="col my-card border">
                                    <div class="row row-cols-3 row-cols-xl-4 align-items-center m-2">
                                        <div class="col">
                                            <img src="{{ $cartItem->product->image_path }}" class="img-thumbnail img-fluid" alt="{{ $cartItem->product->name }}" style="max-width: 100px;">
                                        </div>

                                        <div class="col">
                                            <h5 class="card-title mb-0">{{ $cartItem->product->name }}</h5>
                                            @foreach(sortVariants( $cartItem->selected_variants) as $attribute => $variant)
                                                <span>
                                                {{ $attribute }}: {{ $variant }}<br>
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="col">
                                            <p class="card-price fw-bold mb-0">{{ $cartItem->product->price }}$</p>
                                        </div>

                                        <div class="col-12 col-xl-auto">
                                            <div class="d-flex flex-column align-items-center gap-2">
                                                <button class="btn btn-outline-secondary increase-amount"
                                                        data-id="{{ $cartItem->product_id }}" data-variant="{{ $variantHash }}">+</button>
                                                <span class="px-3 fs-5 fw-bold border rounded amount-value">{{ $cartItem->amount }}</span>
                                                <button class="btn btn-outline-secondary decrease-amount"
                                                        data-id="{{$cartItem->product_id }}" data-variant="{{ $variantHash }}">−</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="container-fluid">
                            <div class="row justify-content-end pb-2 me-0">
                                <div class="col-auto border text-end">
                                    <p id="cart-total" class="card-price">Products sum: {{ $cartTotal }}$</p>
                                </div>
                            </div>

                            @php
                                $transportFees = [
                                    'store_pickup' => 0,
                                    'standard_delivery' => 5,
                                    'speedy_delivery' => 10,
                                ];

                                $shipping = session()->get('checkout.shipping', []);

                                if ($shipping) {
                                    $fee = $transportFees[$shipping['transport_option']];
                                }
                            @endphp

                            @if($shipping)
                                <div class="row justify-content-end pb-2 me-0">
                                    <div class="col-auto border text-end">
                                        <p class="card-price">
                                            Transport fees: +{{ $fee }}$
                                        </p>
                                    </div>
                                </div>

                                <div class="row justify-content-end pb-2 me-0">
                                    <div class="col-auto border text-end">
                                        <p id="sum-total" class="card-price">
                                            Sum total: {{ $cartTotal + $fee }}$
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @php
                                $steps = [
                                    'invoice' => isStepComplete('invoice'),
                                    'shipping' => isStepComplete('shipping'),
                                    'payment' => isStepComplete('payment'),
                                ];

                                $classValue = 0;
                                if ($steps['invoice']) $classValue += 33;
                                if ($steps['shipping']) $classValue += 33;
                                if ($steps['payment']) $classValue += 33;
                                if ($classValue == 99) $classValue++;
                                $progressClass = 'progress-' . $classValue;
                            @endphp

                            <div id="checkout-progress-bar" class="progress my-3" role="progressbar"
                                 aria-label="ProgressBar" aria-valuenow="{{ $progressClass }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-success {{ $progressClass }}"></div>
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
                <a href="{{ route('paywall.invoice') }}" class="btn btn-secondary m-2 size-20-text rounded-pill">
                    <i class="bi bi-arrow-left-short"></i>
                    Back to Invoice
                </a>
            </div>
            <div class="col text-end">
                <a href="{{ route('paywall.payment') }}" class="btn btn-primary m-2 size-20-text rounded-pill">
                    Secure checkout
                    <i class="bi bi-arrow-right-short"></i>
                </a>
            </div>
        </div>
    </div>
</main>

@include('layouts.footers.footer')
<script>
    @if(isset($fee))
        window.transportFee = {{ $fee }};
    @else
        window.transportFee = 0;
    @endif
    document.querySelectorAll('.my-card').forEach(card => {
        const productId = card.querySelector('.increase-amount')?.dataset.id;
        const variantHash = card.querySelector('.increase-amount')?.dataset.variant;
        const amountDisplay = card.querySelector('.amount-value');

        const update = (type) => {
            fetch(`{{ url('/cart') }}/${type}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    variant_hash: variantHash,
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.removed) {
                        card.remove();

                        const badge = document.getElementById('cart-badge');
                        if (badge) {
                            if (data.cartItemsCount > 0) {
                                badge.textContent = data.cartItemsCount;
                            } else {
                                badge.remove();
                            }
                        }
                    } else {
                        amountDisplay.textContent = data.amount;
                    }

                    const totalDisplay = document.getElementById('cart-total');
                    if (totalDisplay && data.cartTotal !== undefined) {
                        totalDisplay.textContent = `Products sum: ${data.cartTotal.toFixed(2)}$`;
                    }

                    const sumDisplay = document.getElementById('sum-total');
                    if (sumDisplay && data.cartTotal !== undefined) {
                        const fee = window.transportFee ?? 0;
                        const sum = data.cartTotal + fee;
                        sumDisplay.textContent = `Sum total: ${sum.toFixed(2)}$`;
                    }
                });
        };

        card.querySelector('.increase-amount')?.addEventListener('click', () => update('increase'));
        card.querySelector('.decrease-amount')?.addEventListener('click', () => update('decrease'));
    });
</script>
<script>
    document.getElementById('save-shipping-btn')?.addEventListener('click', () => {
        const selectedOption = document.querySelector('input[name="transportOptions"]:checked')?.value;

        if (!selectedOption) {
            alert('Please choose a delivery option.');
            return;
        }

        fetch("{{ route('shipping.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ transport_option: selectedOption })
        })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    // You can show a toast or visually mark the shipping step as complete
                    window.location.href = "{{ route('paywall.payment') }}"; // optionally redirect
                } else {
                    alert("Failed to save delivery option.");
                }
            })
            .catch(() => alert("Something went wrong."));
    });
</script>
@endsection
