<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Model\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderCompleted(Request $request)
    {
        if ($request->order && $request->logged_in) {
            # code...
            return view('user.transaction');
        }
        return redirect()->route('view.cart');
    }

    public function viewOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        foreach ($orders as $key) {
            // var_dump($key->cart);
            $key->cart = json_decode($key->cart, true);
        }
        // var_dump($orders);
        return view('user.order', compact('orders'));
    }
}
