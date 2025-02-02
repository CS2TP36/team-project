<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            // TODO: add warning for high rate of sale

            // adds the warning to the array if product has one
            if ($warning[1]) {
                $warnings[] = $warning;
            }
        }
        return $warnings;
    }
}
