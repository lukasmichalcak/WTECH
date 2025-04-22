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
                <div class="border rounded-3 p-4 mb-3">
                    <div class="border-bottom form-check">

                        <div class="d-flex justify-content-between align-items-start p-3 rounded-3 mb-2">
                            <label class="form-check-label" for="card"><strong>Pay with following card info</strong></label>
                            <input class="form-check-input" type="radio" name="paymentMethod"
                                   id="card" value="card">
                        </div>

                        <div class="row mb-4 justify-content-center">
                            <div class="col-auto">
                                <img src="{{ Vite::asset('resources/icons/credit-card.svg') }}" alt="Credit Card" class="img-fluid" style="max-height: 160px;">
                            </div>
                        </div>

                        @auth
                            <div class="mb-3">
                                <label for="card-select" class="form-label">Choose Saved Card:</label>
                                <select id="card-select" class="form-select">
                                    <option value="" selected disabled>Select one...</option>
                                    @foreach ($cards as $card)
                                        <option value="{{ $card->id }}"
                                                data-number="{{ $card->number }}"
                                                data-expiration="{{ $card->expiration_date }}"
                                                data-cv="{{ $card->cv }}">
                                            {{ $card->number }}, {{ $card->expiration_date }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endauth

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Card number:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="number" placeholder="1234 5678 9012 3456">
                                    <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label">Expiry date:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="expirationDate" placeholder="MM / YY">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">CV:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="cv" placeholder="•••">
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

                    <div class="border-bottom form-check">
                        <div class="d-flex justify-content-between align-items-start p-3 rounded-3 mb-2">
                            <label class="form-check-label" for="internetBanking"><strong>I prefer Internet Banking</strong></label>
                            <input class="form-check-input" type="radio" name="paymentMethod"
                                   id="internetBanking" value="internetBanking">
                        </div>
                    </div>

                    <div class="border-bottom form-check">
                        <div class="d-flex justify-content-between align-items-start p-3 rounded-3">
                            <label class="form-check-label" for="cashInPlace"><strong>I prefer to pay cash in-place</strong></label>
                            <input class="form-check-input" type="radio" name="paymentMethod"
                                   id="cashInPlace" value="cashInPlace">
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button id="save-payment-btn" class="btn btn-success rounded-pill mt-3 mb-3">Use Payment Option</button>
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
                                            <img src="{{ Vite::asset('resources/images/A55.png') }}" class="img-thumbnail img-fluid" alt="a55" style="max-width: 100px;">
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
                <a href="{{ route('paywall.shipping') }}" class="btn btn-secondary m-2 size-20-text rounded-pill">
                    <i class="bi bi-arrow-left-short"></i>
                    Back to Shipping
                </a>
            </div>
            <div class="col text-end">
                <form id="finalize-form" method="POST" action="{{ route('payment.finalize') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary m-2 size-20-text rounded-pill">
                        Confirm payment <i class="bi bi-arrow-right-short"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

@include('layouts.footers.footer')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const select = document.getElementById('card-select');
        if (!select) return;

        select.addEventListener('change', (e) => {
            const selected = select.options[select.selectedIndex];

            document.getElementById('number').value = selected.dataset.number;
            document.getElementById('expirationDate').value = selected.dataset.expiration;
            document.getElementById('cv').value = selected.dataset.cv;
        });
    });
</script>
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
    window.stepStatus = @json($steps);
    document.getElementById('save-payment-btn')?.addEventListener('click', () => {
        const selectedOption = document.querySelector('input[name="paymentMethod"]:checked')?.value;

        if (!selectedOption) {
            alert('Please choose a payment method.');
            return;
        }

        if (selectedOption === 'card') {
            const number = document.getElementById('number')?.value?.trim();
            const expiration = document.getElementById('expirationDate')?.value?.trim();
            const cv = document.getElementById('cv')?.value?.trim();

            if (!number || !expiration || !cv) {
                alert('Please fill in all card details.');
                return;
            }
        }

        fetch("{{ route('payment.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ payment_method: selectedOption })
        })
            .then(res => res.json())
            .then(response => {
                let $classValue;
                let $progressClass;
                if (response.success) {
                        window.stepStatus.payment = true;
                        const progressBarWrapper = document.getElementById('checkout-progress-bar');
                        const progressBar = progressBarWrapper?.querySelector('div.progress-bar');

                        if (progressBarWrapper && progressBar) {
                            $classValue = 0;
                            if (window.stepStatus.invoice) $classValue += 33;
                            if (window.stepStatus.shipping) $classValue += 33;
                            if (window.stepStatus.payment) $classValue += 33;
                            if ($classValue === 99) $classValue++;
                            $progressClass = 'progress-' + $classValue;

                            progressBarWrapper.setAttribute('aria-valuenow', $classValue);
                            progressBar.classList.forEach(className => {
                                if (className.startsWith('progress-')) {
                                    progressBar.classList.remove(className);
                                }
                            });
                            progressBar.classList.add($progressClass);
                        }

                } else {
                    alert("Failed to save delivery option.");
                }
            })
            .catch(() => alert("Something went wrong."));
    });
</script>
@endsection
