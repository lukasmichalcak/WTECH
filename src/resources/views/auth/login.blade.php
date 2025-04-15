@extends('layouts.app')

@section('title', 'login')
@section('content')
@include('layouts.headers.header')

<main>
    <div class="d-flex justify-content-center container login-main-div">
        <div class="login-form-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h1 class="form-group mt-3">Log in</h1>

                <a href="register-page.html">Don't have an account? Sign up</a>

                <div class="form-group mt-3 mb-3 login-fields">
                    <label for="exampleInputUsername">Email</label>
                    <input type="email" class="form-control" id="exampleInputUsername" name="username" aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="form-group mt-3 mb-3 login-fields">
                    <label for="exampleInputPassword2">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" name="password" placeholder="Enter password">
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary rounded-pill d-block text-center login-button">Log in</button>
            </form>
        </div>
    </div>
</main>

@include('layouts.footers.footer')

@endsection
