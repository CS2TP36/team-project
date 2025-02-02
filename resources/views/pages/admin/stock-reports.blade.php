@use (App\Http\Controllers\Admin\ReportController)
@php($warnings = ReportController::getWarnings())
@extends("layouts.admin")
@section("title","Stock Reports")
@section("content")
    <h3>Stock Reports</h3>
    <br>
    <article>
        <h4>Warnings</h4>
        @if($warnings)
            <ul>
                @foreach($warnings as $warning)
                    <li>{{ $warning[0]["name"] . ": " . $warning[1] }}</li>
                @endforeach
            </ul>
        @else
            <p>No warnings</p>
        @endif
    </article>

@endsection
