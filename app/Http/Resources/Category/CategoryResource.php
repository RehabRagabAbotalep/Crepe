<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'cerated_at' =>$this->created_at->toDateTimeString(),
            'cerated_at_human' =>$this->created_at->
            diffForHumans(),
            'href' =>[
                'products' =>route('products.index',$this->id)
            ]
        ];
    }
}
