<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pull Products stored in product model 

class BasketController extends Controller
{
    // Show basket items
    public function index()
    {
        $basket = session()->get('basket', []); // Get basket from session
        $total = collect($basket)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('pages.basket', compact('basket', 'total'));
    }

    // Add item to basket
    public function add(Request $request)
    {
        $product = Product::find($request->product_id); // Find product by ID

        if (!$product) {
            return redirect()->back()->withErrors('Product not found!');
        }

        $basket = session()->get('basket', []); // Get current basket from session

        // If product already in basket, update quantity
        if (isset($basket[$product->id])) {
            $basket[$product->id]['quantity'] += $request->quantity;
        } else {
            // Otherwise add new product to basket
            $basket[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->getMainImage(), 
            ];
        }

        session()->put('basket', $basket); // Save updated basket to session

        return redirect()->route('basket.index')->with('success', 'Product added to basket!');
    }

    // Update item quantity in basket
    public function update(Request $request, $id)
    {
        $basket = session()->get('basket', []);

        if (isset($basket[$id])) {
            $basket[$id]['quantity'] = $request->quantity;
            session()->put('basket', $basket);
        }

        return redirect()->route('basket.index')->with('success', 'Basket updated!');
    }

    // Remove item from basket
    public function remove($id)
    {
        $basket = session()->get('basket', []);

        if (isset($basket[$id])) {
            unset($basket[$id]);
            session()->put('basket', $basket);
        }

        return redirect()->route('basket.index')->with('success', 'Product removed from basket!');
    }
}
