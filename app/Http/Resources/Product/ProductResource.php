<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'name_en' =>$this->name_en,
            'name_ar' =>$this->name_ar,
            'description_en' =>$this->description_en,
            'description_ar' =>$this->description_ar,
            'price' =>$this->price,
            'discount' =>$this->discount,
            'Price-after-discount' =>$this->totalPrice,
            'image' =>$this->image,

        ];
    }
}
