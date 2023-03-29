<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class StripeController extends Controller
// {
//     public function index()
//     {
//         return view('home');
//     }

//     public function donate()
//     {
//         \Stripe\Stripe::setApiKey(config('stripe.sk'));

//         $session = \Stripe\Checkout\Session::create([
//             'line_items' => [
//                 [
//                     'price_data' => [
//                         'currency' => 'gbp',
//                         'product_data' => [
//                             'name' => 'Buy Me a Coffee',
//                         ],
//                         'unit_amount' => 500,
//                     ],
//                     'quantity' => 1,
//                 ],
//             ],
//             'mode' => 'payment', // fixed the error here
//             'success_url' => route('success'),
//             'cancel_url' => route('home'),
//         ]);

//         return redirect()->away($session->url);
//     }

//     public function success()
//     {
//         return view('home');
//     }
// }
