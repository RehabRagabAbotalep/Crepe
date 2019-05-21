<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name_en' =>$this->name_en,
            'name_ar' =>$this->name_ar,
            'price' =>$this->price,
            'discount' =>$this->discount,
            'Price-after-discount' =>$this->totalPrice,
            'href'=>[
                'link' =>route('products.show',$this->id)
            ]
        ];
    }
}
