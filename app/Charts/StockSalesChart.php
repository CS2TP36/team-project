<?php

namespace App\Charts;

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
        }

        return (new OriginalLineChart)
            ->setTitle('Recent Sales for ' . $product->name)
            ->setSubtitle('Last 14 days')
            ->addData('Stock level', [/*TODO: add stock level data*/])
            ->setXAxisOption(new XAxisOption($last14days));
    }
}
