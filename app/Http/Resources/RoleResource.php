<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'description' => $this->description,
        ];

        /** @var \App\Models\Role $role */
        $role = $this;
        if ($role->relationLoaded('permissions')) {
            $permissions = [];
            foreach ($role->permissions as $permission) {
                $permissions[$permission->id . "_" . $permission->resource] = [
                    'create' => $permission->pivot->create,
                    'edit' => $permission->pivot->edit,
                    'delete' => $permission->pivot->delete,
                ];
            }
            $item['permissions'] = $permissions;
        }

        return $item;
    }
}
