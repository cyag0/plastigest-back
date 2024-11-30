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
        return $request->validate([

            'name' => ['required','string','max:255'], 
            'email' => ['required','string','email','max:255','unique:users,email,'.$request->route('user')],
            'email_verfied_at' =>['required','string'],
            'password' => ['required','string','min:8','confirmed'],
            'last_name' => ['required','string'],
            'phone_number' => ['required','string'],
            'address' => ['required','string'],
            'image'=> ['nullable'],
            'is_active'=> ['boolean'],
            'role_id' => ['required','numeric'],


        ]);
    }

    protected function updateValidationRules(Request $request): array
    {
        return $this->storeValidationRules($request);
    }

    public function store(Request $request)
    {
        $data = $this->storeValidationRules($request); // recibe los datos del formulario validados

        /** @var User $user*/
        $user = $this->create($data); // crea un nuevo usuario y despues manejas la relacion de sucursales

        //codigo para manejar la relacion sucursal(location)...

        return new $this->resource($user); // retorna el usuario creado
    }
}
