<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function read(?string $category = null, ?string $title = null)
    {
        if (!is_null($title)) {
            $listings = Listing::where('title',$title)->get();
            if ($listings->isEmpty()) {
                    abort(404);
            }
            return view('listings.show', ['listing' => $listings[0], 'filterCategory' => $category]);
        } else {
            if ($category == 'All') {
                return view('listings.index',['listings' => Listing::all(), 'filterCategory' => 'All']);
            } else {
                $listings = Listing::where('category',$category)->get();
                if ($listings->isEmpty()) {
                    abort(404);
                }
                return view('listings.index', ['listings' => $listings, 'filterCategory' => $category]);
            }
        }
    }
}
