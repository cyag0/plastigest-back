<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionsResource;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Resource::class, PermissionsResource::class);
    }

    protected function indexRelations(): array
    {
        return [];
    }

    protected function showRelations(): array
    {
        return [];
    }

    protected function editRelations(): array
    {
        return [];
    }

    protected function storeValidationRules(Request $request): array
    {
        return $request->validate([]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }
}
