<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'name'=>'required|unique:categories',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg'
        ]);

        $image=$request->file('image')->store('public/files');

        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description,
            'img'=>$image

        ]);
        notify()->success('Category created successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $category=Category::find($id);
        $image=$category->img;
        if($request->file('image')){
            $image=$request->file('image')->store('public/files');
            \Storage::delete($category->img);
        }
        $category->name=$request->name;
        $category->description=$request->description;
        $category->img=$image;
        $category->save();

        notify()->success('Category updated successfully!');
        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $filename=$category->img;
        $category->delete();
        \Storage::delete($filename);
        notify()->success('Category deleted successfully!');
        return redirect()->route('category.index');

    }
}
