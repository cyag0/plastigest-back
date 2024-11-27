<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Role::class, RoleResource::class);
    }

    protected function indexRelations(): array
    {
        return [];
    }

    protected function showRelations(): array
    {
        return ['permissions'];
    }

    protected function editRelations(): array
    {
        return ['permissions'];
    }

    protected function storeValidationRules(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'permissions' => 'nullable',
        ]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }

    public function store(Request $request)
    {
        $data = $this->storeValidationRules($request);
        $item = $this->create($data);

        $transformedPermissions = [];
        if (isset($data['permissions'])) {
            foreach ($data['permissions'] as $key => $value) {
                $id = explode('_', $key)[0];
                $transformedPermissions[$id] = $value;
            }

            $item->permissions()->sync($transformedPermissions);
        }

        return new RoleResource($item);
    }

    public function update(Request $request, $id)
    {
        $data = $this->updateValidationRules($request);
        $item = $this->updateItem($id, $data);

        $transformedPermissions = [];
        if (isset($data['permissions'])) {
            foreach ($data['permissions'] as $key => $value) {
                $id = explode('_', $key)[0];
                $transformedPermissions[$id] = $value;
            }

            $item->permissions()->sync($transformedPermissions);
        }

        return new RoleResource($item);
    }
}
