<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// class to stand in between the product page and the database.
class ProductLister extends Controller
{
    // function which gets filtered items from the database, then sorts them and finally returns them in an array.
    public static function get(bool $mens=true, string $sortBy="id", bool $ascending=true, string $catFilter="") {
            // get all the products from the db from selected gender
            $products = Product::all()->where('mens', $mens);
            // apply a category filter if there is one
            if ($catFilter != "") {
                $products = $products->where('category', $catFilter);
            }
            // sort by field and direction
            if ($ascending) {
            $products = $products->sortBy($sortBy);
            } else {
                $products = $products->sortByDesc($sortBy);
            }
            // return the list of products
            return $products;
    }
    // function for getting the args from the url and passing them back to the page
    public function show(bool $mens=true, string $sortBy="id", bool $ascending=true, string $catFilter="") {
        // returns the sanitised args to the page
        return view('pages.products', ['mens' => $mens, 'ascending' => $ascending, 'sortBy' => $sortBy, 'catFilter' => $catFilter]);
    }
}
