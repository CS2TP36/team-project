<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShowProduct extends Controller
{
    public function show($id = -1) {
        // allow for returning random product if none entered
        if ($id == -1) {
            $product = Product::all()->random(1)->first();
        } else {
        $product = Product::all()->where('id', $id)->first();
        }
        return view('pages.product', ['product' => $product]);
    }
}
