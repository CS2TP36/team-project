<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pull Products stored in product model 
use App\Models\Basket; // Pulls the Basket table 
use App\Models\WishlistItem;//Pulls items from the Wishlist 
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    // Show basket items
    public function index()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login.show')
                ->with('error', 'You must be logged in to view your basket. Please log in or create an account.');
        }

        // Fetch basket items for this user
        $basketItems = Basket::with('product')->where('user_id', Auth::id())->get();

        // Calculate total
        $total = $basketItems->sum(fn($item) => $item->getTotalPrice());

        // Pass both items and total to the blade
        return view('pages.basket', compact('basketItems', 'total'));
    }
    
    // Add item into basket
    public function add(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'size' => 'required|in:S,M,L',
    ], [
        'size.required' => 'Please Choose a size.',
        'size.in' => 'The selected size is not Selected.Please Choose Size S, M, or L.',
    ]);



    $product = Product::find($validated['product_id']);

    if (!$product) {
        return redirect()->back()->withErrors('Product not found!');
    }

    $basket = Basket::query();

        if ($request->user()) {
        $basket->where('user_id', $request->user()->id);
    } else {
        $basket->where('session_id', $request->session()->getId());
    }

    $existingItem = $basket
    ->where('product_id', $product->id)
    ->where('size', $validated['size'])
    ->first();

    if ($existingItem) {
        $existingItem->increment('quantity', $request->quantity ?? 1);
    } else {
        Basket::create([
            'user_id' => $request->user()->id ?? null,
            'session_id' => $request->session()->getId(),
            'product_id' => $product->id,
            'size' => $validated['size'],
            'quantity' => $validated['quantity'],
        ]);
    }
          // Removes the item from the wishlist after adding it to the basket
        WishlistItem::where('product_id', $product->id)
        ->where('size', $validated['size'])
        ->where(function ($query) use ($request) {
            if ($request->user()) {
                $query->where('user_id', $request->user()->id);
            } else {
                $query->where('session_id', $request->session()->getId());
            }
        })
        ->delete();

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
    
    public function removeOutOfStock(Request $request)
    {
        $basketItems = Basket::with('product')->where('user_id', Auth::id())->get();
        foreach ($basketItems as $item) {
            if (!$item->product || $item->product->stock < $item->quantity) {
                $item->delete();
            }
        }
        return redirect()->route('basket.index')->with('message', 'Out-of-stock items have been removed from your basket.');
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
