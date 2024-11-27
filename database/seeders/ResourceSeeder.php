<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resources')->delete();
        DB::table('resources')->insert([
            [
                "id" => 1,
                "name" => "Inicio",
                "description" => "Accessos rapidos y reportes",
                "resource" => "dashboardd",
                "route" => "dashboard",
                "icon" => "view-dashboard",
            ],
            [
                "id" => 2,
                "name" => "Usuarios",
                "description" => "Gestion de los usuarios y asignacion de roles",
                "resource" => "users",
                "route" => "users",
                "icon" => "package",
            ],
            [
                "id" => 3,
                "name" => "Productos",
                "description" => "Gestion de los productos",
                "resource" => "products",
                "route" => "products",
                "icon" => "account",
            ],
            [
                "id" => 4,
                "name" => "Proveedores",
                "description" => "Gestion de los proveedores",
                "resource" => "suppliers",
                "route" => "suppliers",
                "icon" => "truck",
            ],
            [
                "id" => 5,
                "name" => "Roles y Permisos",
                "description" => "Roles y permisos que tendran los usuarios para acceder a los recursos",
                "resource" => "roles",
                "route" => "roles",
                "icon" => "shield-account",
            ],
        ]);
    }
}
