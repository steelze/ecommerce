<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:brands'
            ],
            [
                'name.required' => 'Brand name is required',
                'name.unique' => 'Brand Already Exists'
            ]
        );
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            ];
        Brand::create($data);
        return redirect()->route('brand.create')->with('msg', 'Brand Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate(
            [
                'name' => "required|unique:brands,id,$brand->id"
            ],
            [
                'name.required' => 'Brand name is required',
                'name.unique' => 'Brand Already Exists'
            ]
        );
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $request['slug'] = $slug;
        $brand->update($request->all());
        return redirect()->route('brand.index')->with('msg', 'Brand Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brand.index')->with('msg', 'Brand Deleted!');
    }
}
