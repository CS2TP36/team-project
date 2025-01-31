@extends('layouts.page')
@section('title', "TestPage")
@section('head')
    @vite('resources/app.css')
@endsection
@section('content')
    <h1>A Page to test routing</h1>
    <p>If this is visible in the browser this has worked.</p>
@endsection
