<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{   
    public function __construct(){
        $this->middleware('auth:api')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        return ProductResource::collection($category->products);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request,Category $category)
    {
        $image_name = time(). '.'.$request->image->getClientOriginalExtension();
        $product = new Product;
        $product->name_en = $request->name_en;
        $product->name_ar = $request->name_ar;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->image = $image_name;
        $product->totalPrice =round((1-($product->discount/100))*$product->price,2);
        $category->products()->save($product);
        $request->image->move('images',$image_name);
        return Response([
            'data' =>new ProductResource($product)
        ],Response::HTTP_CREATED);


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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,Product $product)
    {   
        $request->validate([
            'name_en'=>'string',
            'name_ar'=>'string',
            'image'=>'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $image_name =time().'.'. $request->image->getClientOriginalExtension();
            $request->image->move('images',$image_name);
            $data['image'] = $image_name;
        }
        $category->products()->update($data);
        /*
        $product->name_en = $request->name_en;
        $product->description_en = $request->description_en;
        $product->description_ar = $request->description_ar;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->totalPrice =round((1-($product->discount/100))*$product->price,2);
        $category->products()->save($product);*/     
        return Response([
            'data' =>new ProductResource($product)
        ],Response::HTTP_OK);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,Product $product)
    {
        $product->delete();
        return Response(null,Response::HTTP_NO_CONTENT);
    }
}
