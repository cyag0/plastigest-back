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
                "route" => "(dashboard)",
                "icon" => "view-dashboard",
                "category" => null
            ],
            [
                "id" => 2,
                "name" => "Usuarios",
                "description" => "Gestion de los usuarios y asignacion de roles",
                "resource" => "users",
                "route" => "(users)",
                "icon" => "account",
                "category" => "admin"
            ],
            [
                "id" => 3,
                "name" => "Productos",
                "description" => "Administra los productos de la tienda",
                "resource" => "products",
                "route" => "(productos)",
                "icon" => "package",
                "category" => "inventory"
            ],
            [
                "id" => 4,
                "name" => "Proveedores",
                "description" => "Gestion de los proveedores",
                "resource" => "suppliers",
                "route" => "(proveedores)",
                "icon" => "truck",
                "category" => "inventory"
            ],
            [
                "id" => 5,
                "name" => "Roles y Permisos",
                "description" => "Roles y permisos que tendran los usuarios para acceder a los recursos",
                "resource" => "roles",
                "route" => "(rolesPermisos)",
                "icon" => "shield-account",
                "category" => "admin"
            ],
            [
                "id" => 6,
                "name" => "Sucursales",
                "description" => "Roles y permisos que tendran los usuarios para acceder a los recursos",
                "resource" => "roles",
                "route" => "(locations)",
                "icon" => "store-settings",
                "category" => "inventory"
            ],
            [
                "id" => 7,
                "name" => "Paquetes",
                "description" => "Administra los paquetes de la tienda",
                "resource" => "packages",
                "route" => "(packages)",
                "icon" => "package-variant",
                "category" => "inventory"
            ],
        ]);
    }
}
