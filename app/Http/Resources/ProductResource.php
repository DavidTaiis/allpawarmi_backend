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
            'price' => $this->price,
            'stock' => $this->stock,
            'measure' => $this->measure->measure,
            'description' => $this->product->description,
            'idFarmer' => $this->users_id
        ];
    }
}
