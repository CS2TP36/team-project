<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Show wishlist items
    public function index(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }
        $wishlists = WishlistItem::query();

        // Filter by user ID if logged in, otherwise by session
        if ($request->user()) {
            $wishlists->where('user_id', $request->user()->id);
        } else {
            $wishlists->where('session_id', $request->session()->getId());
        }

        $wishlistItems = $wishlists->with('product')->get();

        return view('pages.wishlist', compact('wishlistItems'));
    }

    // Add item to wishlist
    public function add(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('login')->with('error', 'Please login to add products to your wishlist.');
        }
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size'       => 'required|in:S,M,L',
        ], [
            'size.required' => 'Please choose a size.',
            'size.in'       => 'Invalid size selected. Please choose S, M, or L.',
        ]);

        // Check if the product already exists in the wishlist
        $wishlist = WishlistItem::query();
        if ($request->user()) {
            $wishlist->where('user_id', $request->user()->id);
        } else {
            $wishlist->where('session_id', $request->session()->getId());
        }

        $existingItem = $wishlist
            ->where('product_id', $validated['product_id'])
            ->where('size', $validated['size'])
            ->first();

        if (!$existingItem) {
            WishlistItem::create([
                'user_id'    => $request->user()->id ?? null,
                'session_id' => $request->session()->getId(),
                'product_id' => $validated['product_id'],
                'size'       => $validated['size'],
            ]);
        }

        return redirect()->route('wishlist.index')->with('success', 'Product added to wishlist!');
    }

    // Remove item from wishlist
    public function remove($id)
    {
        if (!Auth::check()){
            return redirect()->route('login')->with('error', 'Please login to remove products from your wishlist.');
        }
        $wishlistItem = WishlistItem::find($id);
        if ($wishlistItem) {
            $wishlistItem->delete();
        }
        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist!');
    }
}
