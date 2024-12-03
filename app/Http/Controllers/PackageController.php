<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use Illuminate\Http\Request;

class PackageController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        parent::__construct(Package::class, PackageResource::class);
    }

    protected function indexRelations(): array
    {
        return ['product'];
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
            'product_id' => 'required',
            'label' => 'nullable|string',
            'code' => 'nullable|string',
            'quantity' => 'required|numeric',
        ]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }
}
