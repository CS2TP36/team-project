<?php

namespace App\Charts;

use App\Models\IndividualOrder;
use App\Models\Product;
use marineusde\LarapexCharts\Charts\LineChart AS OriginalLineChart;
use marineusde\LarapexCharts\Options\XAxisOption;

// class for creating a stock sales chart for a specified product
class StockSalesChart
{
    public function build(Product $product): OriginalLineChart
    {
        // an array for storing the date of the last 14 days
        $last14days = [now()->day];
        for ($i = 1; $i < 14; $i++) {
            $last14days[] = now()->subDays($i)->day;
        } // [14,13,12,11,10,9,8,7,6,5,4,3,2,1]
        $last14days = array_reverse($last14days); // [1,2,3,4,5,6,7,8,9,10,11,12,13,14]
        // get number of sales from each of the last 14 days
        $salesPerDay = [];
        foreach ($last14days as $day) {
            $salesPerDay[] = IndividualOrder::all()->where('product_id', $product->id)->where('created_at', $day)->count();
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

        // returns the built chart with the required data
        return (new OriginalLineChart)
            ->setTitle('Recent Sales for ' . $product->name)
            ->setSubtitle('Last 14 days')
            ->addData('Stock level', $stockLevel)
            ->setXAxisOption(new XAxisOption($last14days));
    }
}
