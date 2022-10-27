<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsOrderResource extends JsonResource
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
            'product' => $this->measuresProduct->product->name,
            'measure' =>$this->measuresProduct->measure->measure,
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,
        ];
    }
}
