<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct(User::class, UserResource::class);
    }

    protected function indexRelations(): array
    {
        return [
            "role",
            "locations"
        ];
    }

    protected function showRelations(): array
    {
        return [
            "role",
            "locations"
        ];
    }

    protected function editRelations(): array
    {
        return [
            "role",
            "locations"
        ];
    }

    protected function storeValidationRules(Request $request): array
    {
        return $request->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->route('user')],
            'password' => ['required', 'string',],
            'last_name' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'image' => ['nullable'],
            'is_active' => ['boolean'],
            'role_id' => ['required', 'numeric'],
            'locations' => ['required', 'array'],
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
        $user->locations()->sync(
            array_keys($data['locations'])
        ); // agrega las sucursales al usuario

        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $data = $this->updateValidationRules($request); // recibe los datos del formulario validados

        /** @var User $user */
        $user = User::find($id); // busca el usuario a actualizar

        $user->update($data); // actualiza los datos del usuario

        $user->locations()->sync(
            array_keys($data['locations'])
        );

        return new UserResource($user);
    }
}
