@extends('layouts.app')

@section('title', 'Profile')

@section('content')
@include('layouts.headers.header_with_search')

<main>

    <div class="container mt-5">
        <h2 class="fw-bold text-center mb-4">Profile for user: {{ $user->username }}</h2>

        <div class="container border rounded-3 p-4 mb-4">
            <form method="POST" action="{{ route('name.update') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success rounded-pill mt-3" type="submit">Update Name</button>
                    </div>
                </div>
            </form>
        </div>

        @foreach ($address_details as $address)
            <div class="container border rounded-3 p-4 mb-4 position-relative">

                @if(count($address_details) > 1)
                    <form method="POST" action="{{ route('address.delete', ['id' => $address->id]) }}"
                          class="position-absolute top-0 end-0 m-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-close delete-button" aria-label="Delete"></button>
                    </form>
                @endif

                <form method="POST" action="{{ route('address.update', ['id' => $address->id]) }}">
                    @csrf

                    <h5 class="fw-semibold mb-4">Billing Address {{ $loop->iteration }}</h5>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Street Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $address->address }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ $address->city }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" name="zip_code" value="{{ $address->zip_code }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" value="{{ $address->country }}">
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button class="btn btn-success rounded-pill mt-3" type="submit">Update Address Details</button>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach

        <div class="text-center pb-3 mb-4">
            <button type="button" class="btn btn-primary rounded-pill mt-3" data-bs-toggle="modal"
                    data-bs-target="#newAddressModal">Add New Address +</button>
        </div>

        <div class="modal fade" id="newAddressModal" tabindex="-1" aria-labelledby="newAddressModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('address.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-semibold" id="newAddressModalLabel">Add A New Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Street Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" name="zip_code" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" name="country" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success rounded-pill">Save Address</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @foreach($card_details as $cards)
            <div class="container border rounded-3 p-4 mb-4 position-relative">

                @if(count($card_details) > 1)
                    <form method="POST" action="{{ route('card.delete', ['id' => $cards->id]) }}"
                          class="position-absolute top-0 end-0 m-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-close delete-button" aria-label="Delete"></button>
                    </form>
                @endif

                <form method="POST" action="{{ route('card.update', ['id' => $cards->id]) }}">
                    @csrf

                    <h5 class="fw-semibold mb-4">Credit Card {{ $loop->iteration }}</h5>
                    <div class="row mb-4 justify-content-center">
                        <div class="col-auto">
                            <img src="{{ Vite::asset('resources/icons/credit-card-2.svg') }}" alt="Credit Card" class="img-fluid">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Card Number:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="number" value="{{ $cards->number }}">
                                <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label class="form-label">Expiration Date:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="expiration_date" value="{{ $cards->expiration_date }}">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">CV:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="cv" value="{{ $cards->cv }}">
                                <span class="input-group-text"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <button class="btn btn-success rounded-pill mt-3" type="submit">Update Card Details</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-end">
                            <img src="{{ Vite::asset('resources/icons/visa.svg') }}" alt="Visa" height="30" class="mx-1">
                            <img src="{{ Vite::asset('resources/icons/mastercard.svg') }}" alt="MasterCard" height="30" class="mx-1">
                            <img src="{{ Vite::asset('resources/icons/amex.svg') }}" alt="Amex" height="30" class="mx-1">
                        </div>
                    </div>
                </form>
            </div>
        @endforeach

        <div class="text-center pb-3">
            <button type="button" class="btn btn-primary rounded-pill mt-3" data-bs-toggle="modal"
                    data-bs-target="#newCardModal">Add New Card +</button>
        </div>

        <div class="modal fade" id="newCardModal" tabindex="-1" aria-labelledby="newCardModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('card.store') }}">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-semibold" id="newAddressModalLabel">Add A New Card</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" name="number" required>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Expiration Date</label>
                                    <input type="text" class="form-control" name="expiration_date" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CV</label>
                                    <input type="text" class="form-control" name="cv" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success rounded-pill">Save Card</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</main>

@include('layouts.footers.footer')
@endsection
