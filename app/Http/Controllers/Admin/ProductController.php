<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(){
    	$categories = Category::all();
    	return view('admin.Products.create',compact('categories'));
    }

    public function store(Request $request){
    	$request->validate([
    		'name_en'=>'required|string|min:4',
            'name_ar'=>'required|string|min:4',
    		'price'=>'required',
    		'category_id'=>'required',
    		'image'=>'required|image|mimes:jpg,png,jpeg|max:2048',
    	]);

    	$product = new Product;
    	$image_name = time(). '.'.$request->image->getClientOriginalExtension();
    	$request->image->move('images',$image_name);

    	$product->image = $image_name;
    	$product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
    	$product->price = $request->price;
    	$product->discount = $request->discount;
    	$product->totalPrice =round((1-($product->discount/100))*$product->price,2);
    	$product->category_id = $request->category_id;
    	$product->save();
    	return back()->with('status','Created Sucessfuly');
    }

    public function index(){
    	$products = Product::with('category')->get();
    	//return $products;
    	return view('admin.Products.index',compact('products'));
    }

    public function delete($id){
    	$product = Product::find($id);
    	$product->delete();
    	return back()->with('status','deleted Sucessfuly');
    }

    public function edit($id){
    	$categories = Category::all();
    	$product = Product::find($id);
    	return view('admin.Products.edit',compact('product'),compact('categories'));
    }


    public function update(Request $request,$id){
    	
    	$request->validate([
    		'name_en'=>'string|min:4',
            'name_ar'=>'string|min:4',
    		'category_id'=>'required',
    		'image'=>'image|mimes:jpg,png,jpeg|max:2048',
    	]);


        Product::findOrFail($id)->update($request->all());
        
        

        /*
    	if($request->hasFile('image')){
    		$image_name =time().'.'. $request->image->getClientOriginalExtension();
    		$request->image->move('images',$image_name);
    		$product->image = $image_name;
    	}
    	$product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
    	$product->price = $request->price;
    	$product->category_id = $request->category_id;
    	$product->discount = $request->discount;
    	$product->totalPrice =round((1-($product->discount/100))*$product->price,2);
    	$product->save();*/
    	return redirect('products')->with('status','Updated Sucessfuly');

    }
}
