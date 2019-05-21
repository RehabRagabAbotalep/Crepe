<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(){
    	return view('admin.Category.create');
    }

    public function store(Request $request){
    	$request->validate([
    		'name_en'=>'required|string|min:4',
            'name_ar'=>'required|string|min:4',
    	]);
    	$category = new Category;
    	$category -> name_en = $request -> name_en;
        $category -> name_ar = $request -> name_ar;
    	$category->save();
    	return back()->with('status','Created Sucessfuly');

    }

    public function index(){
    	$categories = Category::all();
    	//return $categories;
    	return view('admin.Category.index',compact('categories'));
    }

    public function delete($id){
    	$category = Category::find($id);
    	$category->delete();
    	return redirect('categories')->with('status','deleted Sucessfuly');
    }

    public function edit($id){
    	$category = category::find($id);
    	return view('admin.Category.edit',compact('category'));
    }

    public function update(Request $request,$id){
    	$request->validate([
    		'name_en'=>'required|string|min:4',
            'name_ar'=>'required|string|min:4',
    	]);
    	$category = Category::find($id)->update([
    		'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
    	]);
    	return redirect('categories')->with('status','Updated sucessfuly');
    }
}
