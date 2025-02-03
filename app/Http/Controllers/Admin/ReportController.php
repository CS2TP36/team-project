<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndividualOrder;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // a function to get the stock level warnings for the reports page, returns an  array of warnings in format [product, warning]
    static function getWarnings(): array
    {
        $warnings = [];
        foreach (Product::all() as $product) {
            $warning = [$product, ""];
            // checks for low stock (<3)
            if ($product->stock < 3) {
                if (!$warning[1]) {
                    $warning[1] = "Low stock: ";
                } else {
                    $warning[1] .= ", Low stock: ";
                }
                $warning[1] .= $product->stock;
            }

            // add warning for high rate of sale
            $rateOfSale = self::rateOfSale($product);
            if ($rateOfSale > 3) {
                if (!$warning[1]) {
                    $warning[1] = "Selling fast: ";
                } else {
                    $warning[1] .= ", Selling fast: ";
                }
                $warning[1] .= $rateOfSale . " sales/day";
            }

            // adds the warning to the array if product has one
            if ($warning[1]) {
                $warnings[] = $warning;
            }
        }
        return $warnings;
    }
    // a function to get the average rate of sale of a particular product, returns float in the unit: sales / day, negative numbers should be ignored due to insufficient data
    static function rateOfSale($product): float
    {
        // works on last 14 days so needs to ensure product has existed for at least 14 days
        if ($product->created_at->diffInDays() < 14) {
            return -1;
        }
        // gets the sales for the last 14 days for specified product
        $product_id = $product->id;
        $orders = IndividualOrder::all()->where('product_id', $product_id)->where('created_at', '>', now()->subDays(14));
        if (count($orders)==0) {
            return 0;
        }
        // calculates the total number sold in the last 14 days
        $total = 0;
        foreach ($orders as $order) {
            $total += $order->quantity;
        }
        return $total / 14;
    }
    // a function to estimate the number of days till stock reaches zero
    static function daysTillZero($product): int
    {
        // get the current stock
        $stock = $product->stock;
        // get the rate of sale
        $rateOfSale = self::rateOfSale($product);
        if ($rateOfSale <= 0) {
            return -1;
        }
        // calculate the number of days until stock is 0
        return $stock / $rateOfSale;
    }
}
