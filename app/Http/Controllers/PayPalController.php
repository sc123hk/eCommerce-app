<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Listing;
use App\Models\CartListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function pay()
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "HKD",
                        "value" => Session::get('total')
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] !== null) {
            foreach($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
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
            return redirect()->route('cart.read')->with('message','Purchase Successfully!');
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function cancel()
    {
        return redirect()->route('cart.read')->with('message','Purchase Canceled!');
    }
}
