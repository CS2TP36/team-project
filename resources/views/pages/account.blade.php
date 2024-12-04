@extends('layouts.page')
@section('title','Account')
@section('content')
    <div id="account-page">

    <h1>My Account</h1>
    <hr>
    <p><strong>Name:</strong> {{$user['first_name']}} {{$user['last_name']}}</p>
    <hr>
    <p><strong>Email:</strong> {{$user['email']}}</p>
    <hr>
    <button type="button">Change password</button>
    <button type="button">Signout</button>

    </div>

@endsection

