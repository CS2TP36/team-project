<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;      // Pull Products from your Product model 
use App\Models\WishlistItem;    // Pulls the Wishlist table/model

class WishlistController extends Controller
{
    // 1. Show wishlist items
    public function index(Request $request)
    {
        $wishlists = WishlistItem::query();

        // Filter by user ID if logged in, otherwise by session
        if ($request->user()) {
            $wishlists->where('user_id', $request->user()->id);
        } else {
            $wishlists->where('session_id', $request->session()->getId());
        }

        // Eager-load the product relationship (assuming your Wishlist model has a 'product' relation)
        $wishlistItems = $wishlists->with('product')->get();

        // If you need a total:
        $total = $wishlistItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.wishlist', compact('wishlistItems', 'total'));
    }

    // 2. Add item into wishlist
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'size'       => 'required|in:S,M,L',
        ], [
            'size.required' => 'Please choose a size.',
            'size.in'       => 'The selected size is invalid. Please choose S, M, or L.',
        ]);

        // Retrieve the product
        $product = Product::find($validated['product_id']);
        if (!$product) {
            return redirect()->back()->withErrors('Product not found!');
        }

        // Build a query for the current user or session
        $wishlist = WishlistItem::query();
        if ($request->user()) {
            $wishlist->where('user_id', $request->user()->id);
        } else {
            $wishlist->where('session_id', $request->session()->getId());
        }

        // Check if the same product/size combo is already in the wishlist
        $existingItem = $wishlist
            ->where('product_id', $product->id)
            ->where('size', $validated['size'])
            ->first();

        if ($existingItem) {
            // If it exists, just increment the quantity
            $existingItem->increment('quantity', $validated['quantity']);
        } else {
            // Otherwise, create a new wishlist record
            WishlistItem::create([
                'user_id'    => $request->user()->id ?? null,
                'session_id' => $request->session()->getId(),
                'product_id' => $product->id,
                'size'       => $validated['size'],
                'quantity'   => $validated['quantity'],
            ]);
        }

        // Redirect to the wishlist page with success message
        return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist!');
    }

    // 3. Update item quantity in wishlist
    public function update(Request $request, $id)
    {
        $wishlistItem = WishlistItem::find($id);
        if (!$wishlistItem) {
            return redirect()->route('wishlist.index')->withErrors('Item not found!');
        }

        $wishlistItem->update(['quantity' => $request->quantity]);

        return redirect()->route('wishlist.index')->with('success', 'Wishlist updated!');
    }

    // 4. Remove item from wishlist
    public function remove($id)
    {
        $wishlistItem = WishlistItem::find($id);

        if ($wishlistItem) {
            $wishlistItem->delete();
        }

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist!');
    }
}
