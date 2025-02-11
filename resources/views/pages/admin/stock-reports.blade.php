@use (App\Http\Controllers\Admin\ReportController)
@use (App\Models\Product)
@use(App\Charts\StockSalesChart)
@php
    $warnings = ReportController::getWarnings();
    $products = Product::all()->sortBy("name");
@endphp
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
    <article>
        <h4>Stock Levels</h4>
        <form method="POST" action="{{ route('admin.reports.stockLevelForm') }}">
            @csrf
            <select name="product" onchange="this.form.submit()">
                <option value="0">Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product["id"] }}">{{ $product["name"] }}</option>
                @endforeach
            </select>
            @if(session("slevels"))
                @php
                    // get the product from the session and run necessary calculations
                    $product = Product::all()->where("id", session("slevels"))->first();
                    $rateOfSale = ReportController::rateOfSale($product);
                    $daysTillZero = ReportController::daysTillZero($product);
                    // set the values to "Insufficient data" if they are negative
                    if ($daysTillZero < 0) {
                        $daysTillZero = "Never";
                    }
                    if ($rateOfSale < 0) {
                        $rateOfSale = "Insufficient data";
                    }
                @endphp
                <!-- Output the values to the page -->
                <h5><a href="/product/{{ $product->id }}">{{ $product->name }}</a></h5>
                <p>Current stock level: {{ $product->stock }}</p>
                <p>Rate of sale: {{ $rateOfSale }}</p>
                <p>Estimated days till out of stock: {{ $daysTillZero }}</p>
                @if($rateOfSale == 0)
                    <p style="color: red">Nobody wants to buy this, maybe reduce price?</p>
                @endif
                <h4>Stock level graph</h4>
                @if($product["created_at"] < now()->subDays(13))
                    @php
                        // get the product from the session
                        $product = Product::all()->where("id", session("slevels"))->first();
                        // build the chart for the product
                        $chart = (new StockSalesChart)->build($product);
                    @endphp
                    {!! $chart->container() !!}
                    <script src="{{ $chart->cdn() }}"></script>
                    {!! $chart->script() !!}
                @else
                    <p>Product too new for a graph</p>
                @endif
            @endif
        </form>

    </article>


@endsection
