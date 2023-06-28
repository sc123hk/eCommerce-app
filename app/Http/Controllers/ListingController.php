<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('listings.index',['listings' => Listing::all(), 'filterValue' => 'All']);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category, string $id)
    {
        //
        $listings = Listing::where('picture',$id)->get();
        if ($listings->isEmpty()) {
            abort(404);
        }
        return view('listings.show', ['listing' => $listings[0], 'filterValue' => $category]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filter (string $category)
    {
        //
        if ($category == 'All') {
            return $this->index();
        }
        $listings = Listing::where('category',$category)->get();
        if ($listings->isEmpty()) {
            abort(404);
        }
        return view('listings.index', ['listings' => $listings, 'filterValue' => $category]);
    }
}
