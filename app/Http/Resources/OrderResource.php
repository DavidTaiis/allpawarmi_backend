<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'seller' => $this->user->name,
            'total' => $this->total,
            'deliver_date' => $this->deliver_date,
            'client' => $this->userClient->name,
            'client_id' => $this->userClient->id,
            'status' => $this->status
        ];
    }
}
