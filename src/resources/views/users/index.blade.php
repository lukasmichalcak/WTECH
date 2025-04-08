@extends('layouts.app')

@section('title', 'Users Index')

@section('content')
    <h1>Users Index</h1>
    <table>
        <tr><th>ID</th><th>Meno</th><th>Email</th></tr>
        @foreach($usersList as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </table>
@endsection
