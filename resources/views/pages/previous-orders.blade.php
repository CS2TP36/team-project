@extends("layouts.page")
@use(App\Http\Controllers\PreviousOrders)
@use(Illuminate\Support\Facades\Auth)
@section("title", "Previous Orders")
@section("content")
    @php($orders = PreviousOrders::class->getPreviousOrders(Auth::getUser()))
    <div id="previous-orders">

    </div>
@endsection
