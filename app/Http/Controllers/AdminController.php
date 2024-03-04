<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
    public function index(Request $request) {
        $listings = Listing::all();
        if ($request->has('title')) {
            $listing = Listing::where('title',$request->input('title'))->get();
            return response()->json([
                'category' => $listing[0]->category,
                'description' => $listing[0]->description,
                'price' => $listing[0]->price,
                'quantity' => $listing[0]->quantity,
            ]);
        } else {
            return view('admin.index',['listings' => $listings]);
        }
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'regex:/^[a-zA-Z\s]+$/',
            'description' => 'string',
            'image' => 'mimes:jpg',
        ]);
        $listingRow = new Listing();
        $listingRow->title = $request->title;
        $listingRow->category = $request->category;
        $listingRow->description = $request->description;
        $listingRow->price = $request->price;
        $listingRow->quantity = $request->quantity;
        $listingRow->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move(public_path('img'),strval(Listing::max('id')).'.jpg');
        }
        return redirect()->route('admin.index');
    }

    public function delete(Request $request) {
        $listing = Listing::find($request->listingId);
        if ($listing) {
            $listing->delete();
        }
        File::delete(public_path('img/'.strval($request->listingId).'.jpg'));
        return redirect()->route('admin.index');
    }

    public function update(Request $request) {
        $listing = Listing::find($request->listingId);
        $listing->category = $request->category;
        $listing->description = is_null($request->description) ? $listing->description : $request->description;
        $listing->price = is_null($request->price) ? $listing->price : $request->price;
        $listing->quantity = is_null($request->quantity) ? $listing->quantity : $request->quantity;
        $listing->save();
        return redirect()->route('admin.index');
    }
}
