@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <h1>Hello, user {{ $user->id }}</h1>
    <p>Your name is: {{ $user->first_name }}</p>
    <p>Your email is: {{ $user->email }}</p>
@endsection
