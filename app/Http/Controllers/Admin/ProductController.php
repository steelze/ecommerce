<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\Brand;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('categories', 'brands', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        if($request->hasFile('image')) {
            foreach($request->file('image') as $file)
            {
                $name = $file->getClientOriginalName();
                $path = $file->storeAs(
                    'product', $name, 'public'
                );
                $images[] = $name;  
            }
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category,
            'sub_category_id' => $request->subcategory,
            'brand_id' => $request->brand,
            'price' => $request->price,
            'featured' => $request->featured,
            'last_price' => $request->last_price,
            'last_price' => $request->last_price,
            'description' => $request->description,
            'images' => json_encode($images)
        ];

        Product::create($data);
        return redirect()->route('product.create')->with('msg', 'Product Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $request['slug'] = $slug;
        $product->update($request->all());
        return redirect()->route('product.index')->with('msg', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('msg', 'Product Deleted!');
    }
}
