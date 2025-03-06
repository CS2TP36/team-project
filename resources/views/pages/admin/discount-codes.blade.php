@extends('layouts.admin')

@section('title', 'Create a Discount Code')

@section('content')
    <article>
        <h4>Add a new discount code</h4>
        <form action="{{ route('admin.discounts.add') }}" method="POST">
            @csrf
            <label for="code">Code: </label>
            <input type="text" name="code" id="code" required>
            <label for="start">Start date: </label>
            <input type="date" name="start" id="start" required>
            <label for="expiry">Expiry date: </label>
            <input type="date" name="expiry" id="expiry" required>
            <label for="discount">Discount: </label>
            <article>
                <fieldset role="group" style="width: 30%">
                    <input type="number" name="percent_off" value="25" style="width: fit-content" id="discount" min="1" max="100" required onchange="document.getElementById('slider').value = this.value">
                    <p style="text-align: center; margin-top: auto; margin-bottom: auto">% off</p>
                </fieldset>
                <input type="range" id="slider" value="25" min="1" max="100" onchange="document.getElementById('discount').value = this.value">
            </article>
            <input type="submit">
        </form>
    </article>
@endsection
