<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\Resource;

class CategoryCollection extends Resource
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
            'href'  =>[
                'link' =>route('categories.show',$this->id)
            ]
        ];
    }
}
