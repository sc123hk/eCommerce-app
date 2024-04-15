<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Listing;
use App\Models\CartListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function read()
    {
        $cartListings = CartListing::where('user_id', auth()->user()->id)->get();
        $cart = [];
        foreach ($cartListings as $cartListing) {
            $listings = Listing::where('id',$cartListing->listing_id)->get();
            array_push($cart, [
                'id' => $listings[0]->id,
                'title' => $listings[0]->title,
                'price' => $listings[0]->price,
                'quantity' => $cartListing->quantity,
            ]);
        }
        return view('cart.index',['cart' => $cart ]);
    }

    public function create(string $category, string $title, Request $request)
    {
        $listings = Listing::where('title',$title)->get();
        if ($listings[0]->quantity == 0) {
            return redirect()->back()->with( ['category' => $category, 'id' => $title, 'message' => 'Insufficient Listing!']);
        }
        $userId = auth()->user()->id;
        $cartListings = CartListing::where('user_id', $userId)->where('listing_id', $listings[0]->id)->get();
        $exist = false;
        if (!empty($cartListings[0])) {
            $exist = true;
            $cartListings[0]->quantity++;
            $cartListings[0]->save();
        } 
        if (!$exist) {
            $cartListings = new CartListing();
            $cartListings->user_id = $userId;
            $cartListings->listing_id = $listings[0]->id;
            $cartListings->quantity = 1;
            $cartListings->save();
        }
        return redirect()->back()->with(['category' => $category, 'title' => $title, 'message' => 'Add to Cart Successfully!']);
    }
    
    public function update(Request $request)
    {
        $userId = auth()->user()->id;
        $cartListings = CartListing::where('user_id', $userId)->get();
        foreach ($cartListings as $cartListing) {
            if ($cartListing->listing_id == $request->input('id')) {
                if ($request->input('quantity') == 0) {
                    $cartListing->delete();
                    return response()->json([
                        'delete' => true,
                    ]);
                } else {
                    $cartListing->quantity = $request->input('quantity');
                    $cartListing->save();
                }
            }
        }
        return;
    }

    public function checkout(Request $request)
    {
        $cartListings = CartListing::where('user_id', auth()->user()->id)->get();
        $total = 0;
        $cart = [];
        foreach ($cartListings as $cartListing) {
            $listings = Listing::where('id',$cartListing->listing_id)->get();
            if ($cartListing->quantity > $listings[0]->quantity) {
                return redirect()->route('cart.read')->with('message','Full Quota for the Trip to'.$listings[0]->title);
            }
            $total += $listings[0]->price * $cartListing->quantity;
            array_push($cart, [
                'title' => $listings[0]->title,
                'price' => $listings[0]->price,
                'quantity' => $cartListing->quantity
            ]);
        }
        Session::put('total', $total);
        return view('cart.checkout',['total' => $total, 'cart' => $cart]);
    }
}
