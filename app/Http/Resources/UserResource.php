<?php

namespace App\Http\Resources;

use App\Models\WalletsByUsers;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'photo' => ImageResource::collection($this->images),
            'company' => new CompanyResource($this->company),
            'level' => new LevelResource($this->level),
            'completeObjectives' => 0,
            'points' => $this->wallet ? $this->wallet->points : 0,
            'accumulatedPoints' => $this->wallet ? $this->wallet->total_points : 0
        ];
    }
}
