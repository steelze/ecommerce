<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', '=', 1 )->inRandomOrder()->take(14)->get();
        foreach ($products as $key) {
            $key->images = json_decode($key->images, true);
        }
        return view('welcome', compact('products'));
    }
}
