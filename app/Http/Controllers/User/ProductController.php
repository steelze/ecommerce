<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class ProductController extends Controller
{
    public function showProduct($category, $id, $slug)
    {
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->images = json_decode($product->images, true);
        }
        $featured = Product::where('featured', '=', 1 )->inRandomOrder()->take(4)->get();
        foreach ($featured as $key) {
            $key->images = json_decode($key->images, true);
        }
        return view('user.product', compact('product', 'featured'));
    }
}
