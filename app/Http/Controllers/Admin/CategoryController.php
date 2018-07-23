<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
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
                'name' => 'required|unique:categories'
            ],
            [
                'name.required' => 'Category name is required',
                'name.unique' => 'Category Already Exists'
            ]
        );
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            ];
        Category::create($data);
        return redirect()->route('category.create')->with('msg', 'Category Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(
            [
                'name' => "required|unique:categories,id,$category->id"
            ],
            [
                'name.required' => 'Category name is required',
                'name.unique' => 'Category Already Exists'
            ]
        );
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        $request['slug'] = $slug;
        $category->update($request->all());
        return redirect()->route('category.index')->with('msg', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('msg', 'Category Deleted!');
    }
}
