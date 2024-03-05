<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function read()
    {
        //
        $orders = Order::where('user_id', auth()->user()->id)->get()->sortByDesc('created_at');
        return view('order.index',['orders' => $orders]);
    }
    
    public function update(Request $request)
    {
        //
        $order = Order::findOrFail($request->input('id'));
        if ($order->user_id != auth()->user()->id) {
            abort(403);
        }
        $order->updated_at = now();
        $order->save();
        return redirect()->route('order.read')->with('message', 'Trip Updated Successfully');
    }
}
