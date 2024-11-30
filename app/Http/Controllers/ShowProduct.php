<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShowProduct extends Controller
{
    public function show($id) {
        $product = Product::all()->where('id', $id)->first();
        return view('pages.product', ['product' => $product]);
    }
}
