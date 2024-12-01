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
    public function show(string $mens, string $sortBy, string $ascending, string $catFilter="") {
        // if unset set default values
        if ($mens = ""){
            $mens = 1;
        } else {
            $mens = filter_var($mens, FILTER_VALIDATE_BOOLEAN);
        }
        if ($ascending = ""){
            $ascending = 1;
        } else {
            $ascending = filter_var($ascending, FILTER_VALIDATE_BOOLEAN);
        }
        if ($sortBy = "") {
            $sortBy = "id";
        }
        // returns the sanitised args to the page
        return view('pages.products', ['$mens' => $mens, '$ascending' => $ascending, '$sortBy' => $sortBy, '$catFilter' => $catFilter]);
    }
}
