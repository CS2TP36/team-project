<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pull Products stored in product model 
use App\Models\Basket; // Pulls the Basket table 

class BasketController extends Controller
{
    // Show basket items
    public function index(Request $request)
    {
        $baskets = Basket::query();
    
        // Filter by user or session
        if ($request->user()) {
            $baskets->where('user_id', $request->user()->id);
        } else {
            $baskets->where('session_id', $request->session()->getId());
        }
    
        $basketItems = $baskets->with('product')->get();
    
        $total = $basketItems->sum(fn($item) => $item->product->price * $item->quantity);
    
        return view('pages.basket', compact('basketItems', 'total'));
    }
    
    // Add item to basket
    public function add(Request $request)
{
    $product = Product::find($request->product_id);

    if (!$product) {
        return redirect()->back()->withErrors('Product not found!');
    }

    $basket = Basket::query();

    // Find by user or session
    if ($request->user()) {
        $basket->where('user_id', $request->user()->id);
    } else {
        $basket->where('session_id', $request->session()->getId());
    }

    $existingItem = $basket->where('product_id', $product->id)->where('size', $request->size)->first();

    if ($existingItem) {
        $existingItem->increment('quantity', $request->quantity ?? 1);
    } else {
        Basket::create([
            'user_id' => $request->user()->id ?? null,
            'session_id' => $request->session()->getId(),
            'product_id' => $product->id,
            'size' => $request->size,
            'quantity' => $request->quantity ?? 1,
        ]);
    }

    return redirect()->route('basket.index')->with('success', 'Product added to basket!');
}


    // Update item quantity in basket
    public function update(Request $request, $id)
    {
        $basketItem = Basket::find($id);
    
        if (!$basketItem) {
            return redirect()->route('basket.index')->withErrors('Item not found!');
        }
    
        $basketItem->update(['quantity' => $request->quantity]);
    
        return redirect()->route('basket.index')->with('success', 'Basket updated!');
    }
    

    // Remove item from basket
    public function remove($id)
    {
        $basketItem = Basket::find($id);
    
        if ($basketItem) {
            $basketItem->delete();
        }
    
        return redirect()->route('basket.index')->with('success', 'Product removed from basket!');
    }
}
