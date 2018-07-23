<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Cart;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function viewCart()
    {
        return view('user.cart');
    }

    public function addToCart(Request $request, $id)
    {
        $product = $this->getProduct($id);
         
        $oldCart = $this->getCart($request);

        $cart = new Cart($oldCart);

        $cart->addItem($product, $product->id);
        
        $this->setCart($request, $cart);
        
        $this->response();
    }

    public function removeFromCart(Request $request, $id)
    {
        $id = (int) $id;

        $oldCart = $this->getCart($request);

        $cart = new Cart($oldCart);

        $cart->removeItem($id);

        $this->setCart($request, $cart);

        $this->response();
    }

    public function addMultipleCart(Request $request)
    {
        
        $product = $this->getProduct($request->id);
        
        $oldCart = $this->getCart($request);
        
        $cart = new Cart($oldCart);
        
        $cart->addMultipleItem($product, $product->id, $request->qty);
        
        $this->setCart($request, $cart);
        
        $this->response();
    }

    public function updateCart(Request $request)
    {
        return $request->all();
    }

    public function getProduct($id)
    {
        return Product::find($id);
    }

    public function getCart($request)
    {
        return $request->session()->has('cart') ? $request->session()->get('cart') : null;  
    }

    public function setCart($request, $cart)
    {
        $request->session()->put('cart', $cart);
    }

    public function response()
    {
        return response()->json(['msg' => true], Response::HTTP_CREATED);
    }
}
