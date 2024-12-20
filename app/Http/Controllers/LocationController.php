<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    public function __construct()
    {
        //primero es el modelo
        parent::__construct(Location::class, LocationResource::class);
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
        return $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'in_charge' => 'required|string',
        ]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }
}
