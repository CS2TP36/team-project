<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// class to stand in between the product page and the database.
class ProductLister extends Controller
{
    // function which gets filtered items from the database, then sorts them and finally returns them in an array.
    public static function get(int $mens=2, string $sortBy="id", bool $ascending=true, int $catFilter=0, int $priceFilter=0) {
            // get all the products from the db from selected gender
            if ($mens!=2) {
                $products = Product::all()->where('mens', $mens);
            } else {
                $products = Product::all();
            }
            // apply a category filter if there is one
            if ($catFilter != 0) {
                $products = $products->where('category_id', $catFilter);
            }
            if ($priceFilter != 0) {
                switch ($priceFilter) {
                    case 1:
                        $products = $products->where('price', '<=', 25);
                        break;
                    case 2:
                        $products = $products->where('price', '>', 25)->where('price', '<=', 35);
                        break;
                    case 3:
                        $products = $products->where('price', '>', 35)->where('price', '<=', 45);
                        break;
                    case 4:
                        $products = $products->where('price', '>', 45);
                }
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
    public function show(int $mens=2, string $sortBy="id", bool $ascending=true, int $catFilter=0, int $priceFilter=0) {
        // returns the sanitised args to the page
        return view('pages.products', ['mens' => $mens, 'ascending' => $ascending, 'sortBy' => $sortBy, 'catFilter' => $catFilter, 'priceFilter' => $priceFilter]);
    }
}
