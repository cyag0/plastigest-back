<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(User::class, UserController::class);
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
