<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Model\SubCategory;
use App\Model\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['getsubcategories']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
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
                'name' => "required",
                'category' => 'required'
            ],
            [
                'name.required' => 'Subcategory name is required',
                'category.required' => 'Select Category',
            ]
        );
        $category = SubCategory::where(['category_id' => $request->category, 'name' => $request->name])->first();
        if($category) {
            return redirect()->back()->withInput($request->only('name', 'category'))->withErrors(['name' => 'Name already exists for this category']);
        }
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $data = [
            'name' => $request->name,
            'category_id' => $request->category,
            'slug' => $slug,
        ];
        SubCategory::create($data);
        return redirect()->route('subcategory.create')->with('msg', 'SubCategory Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.subcategory.edit', compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate(
            [
                'name' => "required",
                'category_id' => 'required'
            ],
            [
                'name.required' => 'Subcategory name is required',
                'category.required' => 'Select Category',
            ]
        );
        $getSubcategory = SubCategory::where(['category_id' => $request->category_id, 'name' => $request->name])->first();
        if($getSubcategory && $getSubcategory->id !== $subcategory->id) {
            return redirect()->back()->withInput($request->only('name', 'category'))->withErrors(['name' => 'Name already exists for this category']);
        }
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $request['slug'] = $slug;
        $subcategory->update($request->all());
        return redirect()->route('subcategory.index')->with('msg', 'SubCategory Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subcategory.index')->with('msg', 'SubCategory Deleted!');
    }

    public function getsubcategories($id)
    {
        $list = SubCategory::where('category_id', $id)->get();
        return $list;
    }
}
