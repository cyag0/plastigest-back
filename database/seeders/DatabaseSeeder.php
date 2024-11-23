<?php

namespace Database\Seeders;

use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Supplier;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $category1 = Category::create([
            'name' => 'Category 1',
        ]);

        $supplier = Supplier::create([
            'name' => 'Supplier 1'
        ]);

        $category2 = Category::create([
            'name' => 'Category 2',
        ]);

        // Crear productos y asignarlos a las categorías
        Product::create([
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'price' => 100.00,
            'supplier_id' => $supplier->id,
            'category_id' => $category1->id, // Asignar a Category 1
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Description of product 2',
            'price' => 200.00,
            'supplier_id' => $supplier->id,
            'category_id' => $category2->id, // Asignar a Category 2
        ]);
    }
}
