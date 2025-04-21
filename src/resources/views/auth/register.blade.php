@extends('layouts.app')

@section('title', 'register')

@section('content')
    @include('layouts.headers.header')
    <main>
        <!-- Split Content Area -->
        <div class="container d-flex justify-content-center">

            <form method="POST" action="{{ route('register') }}">

                @csrf
                <div class="container mt-5">
                    <h2 class="mb-3 text-center">Create an account</h2>
                    <p class="text-center">
                        <a href="{{ route('login') }}">Already have an account? Log in</a>
                    </p>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="Enter first name" name="first_name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter last name" name="last_name">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Choose a username" name="username">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email">
                                <small class="form-text text-muted">We'll never share your email.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Re-enter password" name="passwordConfirmation">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" placeholder="Street, number, apartment" name="address">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" placeholder="City" name="city">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">ZIP Code</label>
                                <input type="text" class="form-control" placeholder="Postal code" name="zip">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="Slovakia">

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill d-block text-center login-button">Create Account</button>

                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" id="register-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </form>
        </div>
    </main>


    @include('layouts.footers.footer')

@endsection
