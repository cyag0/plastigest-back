<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $item = [
            'name' => $this->name,
            'product_id' => $this->product_id,
            'label' => $this->label,
            'code' => $this->code,
            'quantity' => $this->quantity,

        ];
        if ($this->relationLoaded('product')) {
            $item['product'] = $this->product->name;
        }
        return $item;
    }
}
