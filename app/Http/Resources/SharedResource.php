<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SharedResource extends JsonResource
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
            'name' => $this->name,
            'meeting_point' => $this->meeting_point,
            'date' => $this->date,
            'hour' => $this->hour,
            'status' => $this->status,
            'users_id' => $this->user->name,
            'id_users' => $this->user->id,
        ];
    }
}
