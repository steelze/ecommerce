<?php

namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Model\Cart;
use Auth;
use App\Model\Order;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        $request = session('request-address');
        if ($paymentDetails['data']['status']) {

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
                'method' => 'Online Transaction',
                'paid' => 1,
                'payment_id' => $paymentDetails['data']['authorization']['authorization_code']
            ];
            Order::create($data);

            $cart = $this->clearCart();

            return redirect()->route('order.completed', [
                'email' => Auth::user()->email,
                'trans' => $paymentDetails['data']['authorization']['authorization_code'],
                'order' => $orderId,
                'logged_in' => 'true',  
                'order' => 'completed-true',  
                'name' => Auth::user()->name
            ]);
        }
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
        return json_encode($request);
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
