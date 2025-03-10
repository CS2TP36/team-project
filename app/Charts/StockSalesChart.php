<?php

namespace App\Charts;

use App\Models\IndividualOrder;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
use marineusde\LarapexCharts\Charts\LineChart AS OriginalLineChart;
use marineusde\LarapexCharts\Options\XAxisOption;

// class for creating a stock sales chart for a specified product
class StockSalesChart
{
    public function build(Product $product): OriginalLineChart
    {
        // an array for storing the date of the last 14 days
        $last14days = [now()];
        for ($i = 1; $i < 14; $i++) {
            $last14days[] = now()->subDays($i);
        } // [14,13,12,11,10,9,8,7,6,5,4,3,2,1]
        $last14days = array_reverse($last14days); // [1,2,3,4,5,6,7,8,9,10,11,12,13,14]
        // get number of sales from each of the last 14 days
        $salesPerDay = [];
        foreach ($last14days as $day) {
            $sales = IndividualOrder::select("*")->where('product_id', $product->id)->whereDate('created_at', $day)->get();
            $quantity = 0;
            // make sure to multiply by the quantity attached to each individualorder
            foreach ($sales as $sale) {
                $quantity += $sale['quantity'];
            }
            $salesPerDay[] = $quantity;
        } // [1,2,3,4,5,6,7,8,9,10,11,12,13,14]
        // now roughly calculate the stock level for each of the last 14 days
        $salesPerDay = array_reverse($salesPerDay); // [14,13,12,11,10,9,8,7,6,5,4,3,2,1]
        $stockCount = $product->stock;
        $stockLevel = [$stockCount];
        foreach ($salesPerDay as $sales) {
            $stockCount += $sales;
            $stockLevel[] = $stockCount;
        } // [14,13,12,11,10,9,8,7,6,5,4,3,2,1]
        $stockLevel = array_reverse($stockLevel); // [1,2,3,4,5,6,7,8,9,10,11,12,13,14]
        // get days from the timestamps
        $last14days = array_map(fn($day) => $day->format('d/m'), $last14days);

        // returns the built chart with the required data
        return (new OriginalLineChart)
            ->setTitle('Daily Stock levels for ' . $product->name)
            ->setSubtitle('Last 14 days')
            ->addData('Stock level', $stockLevel)
            ->setXAxisOption(new XAxisOption($last14days));
    }
}
