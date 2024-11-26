<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $item = [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'in_charge' => $this->in_charge,
        ];

        return $item;
    }
}