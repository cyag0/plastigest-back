<?php

namespace App\Http\Controllers;

use App\Http\Resources\Products\productResource;
use App\Models\Products\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    public function __construct()
    {
        parent::__construct(Product::class, productResource::class);
    }

    protected function indexRelations(): array
    {
        return ['supplier'];
    }

    protected function showRelations(): array
    {
        return ['supplier'];
    }

    protected function editRelations(): array
    {
        return ['supplier'];
    }

    protected function storeValidationRules(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'supplier_id' => 'required',
        ]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }
}
