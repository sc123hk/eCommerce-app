<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Listing;
use App\Models\CartListing;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cartListings = CartListing::where('user_id', auth()->user()->id)->get();
        $cart = [];
        foreach ($cartListings as $cartListing) {
            $listings = Listing::where('id',$cartListing->listing_id)->get();
            array_push($cart, [
                'id' => $listings[0]->id,
                'title' => $listings[0]->title,
                'price' => $listings[0]->price,
                'quantity' => $cartListing->quantity
            ]);
        }
        return view('cart.index',['cart' => $cart ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $category, string $title, Request $request)
    {
        //
        $listings = Listing::where('title',$title)->get();
        if ($listings[0]->quantity == 0) {
            return redirect()->route('listing.show', ['category' => $category, 'id' => $title])->with('message','Quota Full!');
        }
        // $cart = $request->session()->get('cart',[]);
        // $exist = false;
        // if (!empty($cart)) {
        //     foreach ($cart as &$item) {
        //         if ($item['title'] == $listings[0]->title) {
        //             $exist = true;
        //             $item['quantity']++;
        //             break;
        //         }
        //     }
        // }
        // if (!$exist) {
        //     array_push($cart, [
        //         'id' => $listings[0]->picture,
        //         'title' => $listings[0]->title,
        //         'price' => $listings[0]->price,
        //         'quantity' => 1
        //     ]);
        // }
        // $request->session()->put('cart', $cart);
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
        return redirect()->route('listing.show', ['category' => $category, 'title' => $title])->with('message','Pin to Map Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // $idArr = $request->keys();
        // array_shift($idArr);
        // $updateCart = [];
        // foreach ($idArr as $id) {
        //     if ($request->input($id) == 0) {
        //         continue;
        //     } else {
        //         $listings = Listing::where('picture',$id)->get();
        //         array_push($updateCart, [
        //             'id' => $listings[0]->picture,
        //             'title' => $listings[0]->title,
        //             'price' => $listings[0]->price,
        //             'quantity' => $request->input($id)
        //         ]);
        //     }
        // }
        // $request->session()->put('cart', $updateCart);
        $userId = auth()->user()->id;
        $cartListings = CartListing::where('user_id', $userId)->get();
        // foreach ($cartListings as $cartListing) {
        //     if ($request->input($cartListing->listing_id) != 0) {
        //         $cartListing->quantity = $request->input($cartListing->listing_id);
        //         $cartListing->save();
        //     } else {
        //         $cartListing->delete();
        //     }
        // }
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
        // return redirect()->route('cart.index')->with('message','Update Cart successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function checkout(Request $request)
    {
        // $cart = $request->session()->get('cart');
        // $total = 0;
        // foreach ($cart as $item) {
        //     $listings = Listing::where('picture',$item['id'])->get();
        //     if (intval($item['quantity']) > $listings[0]->quantity) {
        //         return redirect()->route('cart.index')->with('message','Insufficient for '.$listings[0]->title);
        //     }
        //     $total += $item['price'] * $item['quantity'];
        // }
        $cartListings = CartListing::where('user_id', auth()->user()->id)->get();
        $total = 0;
        $cart = [];
        foreach ($cartListings as $cartListing) {
            $listings = Listing::where('id',$cartListing->listing_id)->get();
            if ($cartListing->quantity > $listings[0]->quantity) {
                return redirect()->route('cart.index')->with('message','Full Quota for the Trip to'.$listings[0]->title);
            }
            $total += $listings[0]->price * $cartListing->quantity;
            array_push($cart, [
                'title' => $listings[0]->title,
                'price' => $listings[0]->price,
                'quantity' => $cartListing->quantity
            ]);
        }
        return view('cart.checkout',['total' => $total, 'cart' => $cart]);
    }

    public function purchase()
    {
        // $cart = request()->session()->get('cart');
        // foreach ($cart as $item) {
        //     $listings = Listing::where('picture',$item['id'])->get();
        //     $listings[0]->quantity -= $item['quantity'];
        //     $listings[0]->save();
        // }
        // request()->session()->put('cart', []);
        $cartListings = CartListing::where('user_id', auth()->user()->id)->get();
        foreach ($cartListings as $cartListing) {
            $listings = Listing::where('id',$cartListing->listing_id)->get();
            $listings[0]->quantity -= $cartListing->quantity;
            $listings[0]->save();
            $orderRow = new Order();
            $orderRow->user_id = auth()->user()->id;
            $orderRow->title = $listings[0]->title;
            $orderRow->quantity = $cartListing->quantity;
            $orderRow->save();
            $cartListing->delete();
        }
        return redirect()->route('cart.index')->with('message','Purchase Successfully!');
    }
}
