@extends('layouts.page')
@section('title','Account')
@section('content')
    <div class="account-page">
        <h1>My Account</h1>
        <hr>
        <p><strong>Name:</strong> {{$user['first_name']}} {{$user['last_name']}}</p>
        <hr>
        <p><strong>Email:</strong> {{$user['email']}}</p>
        <hr>
        <a href="/change-pass"><button type="button">Change password</button></a>
        <a href="/logout"><button type="button">Sign out</button></a>
    </div>
@endsection

