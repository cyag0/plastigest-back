<?php

namespace App\Http\Controllers;

use App\Models\Products\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    protected function storeValidationRules(): array
    {
        return [
            /*             'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'category_id' => 'required|exists:categories,id', */];
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

    protected function updateValidationRules(): array
    {
        return [
            /*             'name' => 'string',
            'description' => 'string',
            'price' => 'numeric',
            'is_active' => 'boolean',
            'category_id' => 'exists:categories,id', */];
    }

    public function store(Request $request)
    {
        $item = parent::store($request);

        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        /** @var Product */
        $item = parent::update($request, $id);

        return response()->json($item);
    }
}
