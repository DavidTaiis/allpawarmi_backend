<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => $this->product->name,            
            'productId' => $this->product->id,
            'price' => $this->price,
            'stock' => $this->stock,
            'measure' => $this->measure->measure,
            'measureId' => $this->measure->id,
            'description' => $this->product->description,
            'farmer' => $this->user->name,
            'phoneFarmer' => $this->user->phone_number,
            'farmerId' => $this->users_id,
            'images' => ImageResource::collection($this->product->images)
        ];
    }
}
