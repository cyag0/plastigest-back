<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $method = $this->additional['method'] ?? null;

        $item = [
            'id' => $this->id ?? null,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'status' => $this->is_active ? 'Activo' : 'Inactivo',
            'role_id' => $this->role_id,
        ];


        if ($this->relationLoaded("role")) {
            $item['role'] = $this->role->name ?? "null";
        }



        if ($this->relationLoaded("locations")) {
            if ($method == "show") {
                $item["is_active"] = $this->is_active;
                $item["password"] = $this->password;
                $item['locations'] = [];
                $item['locations_with_name'] = [];

                foreach ($this->locations as $location) {
                    $item['locations'][(string)$location->id] = true;
                    $item['locations_with_name'][] = [
                        "id" => $location->id,
                        "name" => $location->name,
                    ];
                }

                $item['locations'] = (object)$item['locations'];
            } else {
                if ($this->locations->count() === 0) {
                    return $item;
                }

                $item['locations'] = $this->locations->map(function ($location) {
                    return [
                        "id" => $location->id,
                        "name" => $location->name,
                    ];
                });
            }
        }

        return $item;
    }
}
