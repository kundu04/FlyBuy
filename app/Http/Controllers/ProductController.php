<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::get();
        return view('admin.product.index',compact('products')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
            'name'=>'required',
            'description'=>'required|min:3',
            'image'=>'required|mimes:jpeg,png',
            'price'=>'required|numeric',
            'additional_info'=>'required',
            'category'=>'required',
        ]);
        $image = $request->file('image')->store('public/product');
        Product::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'image'=>$image,
            'price'=>$request->price,
            'additional_info'=>$request->additional_info,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->subcategory
        ]);
        notify()->success('Product created successfully!');
        return redirect()->back();
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
        $product=Product::find($id);
        return view('admin.product.edit',compact('product'));
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
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required|min:3',
            'image'=>'mimes:jpeg,png',
            'price'=>'required|numeric',
            'additional_info'=>'required',
            'category'=>'required',
        ]);
        $product=Product::find($id);
        $image=$product->image;
        if($request->file('image')){
            $image=$request->file('image')->store('public/product');
            \Storage::delete($product->image);
        }
        $subcat=$product->subcategory_id;
        if($request->subcategory){
            $subcat=$request->subcategory;
            
        }
        $product->name=$request->name;
        $product->description=$request->description;
        $product->image=$image;
        $product->price=$request->price;
        $product->additional_info=$request->additional_info;
        $product->category_id=$request->category;
        $product->subcategory_id=$subcat;
        $product->save();

        notify()->success('Product updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $filename=$product->image;
        $product->delete();
        \Storage::delete($filename);
        notify()->success('Product deleted successfully!');
        return redirect()->route('product.index');
    }

    public function loadSubCategories(Request $request,$cat_id){
        $subcategories=Subcategory::where('category_id',$cat_id)->pluck('name','id');
        return response()->json($subcategories);

    }
}
