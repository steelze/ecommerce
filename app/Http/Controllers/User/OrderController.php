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
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        foreach ($orders as $key) {
            $key->cart = json_decode($key->cart, true);
        }
        return view('user.order', compact('orders'));
    }

    public function viewSingleOrder(Order $id)
    {
        $order = $id;
        $order->cart = json_decode($order->cart, true);
        $order->shipping_details = json_decode($order->shipping_details, true);
        // foreach ($order->cart['item'] as $key) {
        //    echo json_decode($key['item']['images'], true)[0];
        // }
        return view('user.single-order', compact('order'));
    }
}
