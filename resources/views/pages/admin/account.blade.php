@use(Illuminate\Support\Facades\Auth)
@extends("layouts.admin")
@section("title","Account")
@section("content")
    <article>
        @if(Auth::check())
            <h3>Account</h3>
            <p>Name: {{ Auth::getUser()["first_name"] . " " . Auth::getUser()["last_name"]}}</p>
            <p>Email: {{ Auth::getUser()["email"] }}</p>
        @else
            <p>You are not logged in</p>
        @endif
    </article>
@endsection
