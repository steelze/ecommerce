<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Http\Requests\Checkout\AddressRequest;
use App\Model\Checkout;
use Auth;
use App\Model\Order;
use function GuzzleHttp\json_encode;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        if (!session()->has('cart') || session('cart')->totalQty <= 0 ) {
            return redirect('/');
        }
        // session('order', 'valid');
        $total = $this->getCart()->totalPrice;
        return view('user.checkout', compact('total'));
    }

    public function viewPaymentForm()
    {
        // return 'here';
        if (!session()->has('cart') || session('cart')->totalQty <= 0) {
                return redirect('/');
        }

        // $total = $this->getCart();
        return view('user.payment');
    }
    
    public function address(AddressRequest $request)
    {
        if ($request->shipping) {

            $cart = $this->getCart();
            
            $orderId = $this->getOrderId();
            $orderCart = [
                'item' => $cart->items, 
                'totalQty' => $cart->totalQty, 
                'totalPrice' => $cart->totalPrice, 
            ];
            $data = [
                'user_id' => Auth::user()->id,
                'cart' => json_encode($orderCart),
                'order_id' => $orderId,
                'shipping_details' => $this->getShippingDetails($request),
                'method' => 'Pay On Delievery'
            ];
            Order::create($data);

            $cart = $this->clearCart();

            return redirect()->route('order.completed', [
                'email' => Auth::user()->email,
                'order' => $orderId,
                'logged_in' => 'true',  
                'order' => 'completed-true',  
                'name' => Auth::user()->name
            ]);
        }
        $request->session()->put('request-address', $request->all());
        return redirect()->route('user.checkout.payment');
    }

    protected function getCart()
    {
        $oldCart = session('cart');

        $cart = new Cart($oldCart);

        return $cart;
    }

    public function getShippingDetails($request)
    {
        unset($request['_token']);
        unset($request['shipping']);
        return json_encode($request->all());
    }

    public function getOrderId()
    {
        return mt_rand(1000, 9999);
    }

    public function clearCart()
    {
        session()->forget('cart');
        session()->forget('order');
        session()->forget('request-address');
    }
}
