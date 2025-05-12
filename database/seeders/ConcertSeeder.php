<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Concert;
use Carbon\Carbon;


class ConcertSeeder extends Seeder
{
    public function run()
    {
        // Crear productos primero si no están creados
        $product1 = Product::create([
            'name' => 'Entrada Concierto de Rock',
            'description' => 'Entrada para el concierto de Rock en el Estadio Central.',
            'price' => 50.00,
            'stock' => 200,
            'category' => 'Conciertos',
            'is_featured' => true,
            'is_active' => true,

        ]);

        $product2 = Product::create([
            'name' => 'Entrada Concierto de Jazz',
            'description' => 'Entrada para el concierto de Jazz en el Teatro Nacional.',
            'price' => 40.00,
            'stock' => 150,
            'category' => 'Conciertos',
            'is_featured' => false,
            'is_active' => true,
        ]);

        $product3 = Product::create([
            'name' => 'Entrada Festival Electrónico',
            'description' => 'Entrada para el Festival Electrónico en el Club XYZ.',
            'price' => 60.00,
            'stock' => 300,
            'category' => 'Conciertos',
            'is_featured' => true,
            'is_active' => true,
        ]);

        // Crear conciertos asociando correctamente los productos
        Concert::create([
            'title' => 'Concierto de Rock',
            'date' => Carbon::parse('2025-06-01 20:00:00'),
            'location' => 'Estadio Central',
            'product_id' => $product1->id,  // Relacionamos el producto creado
        ]);

        Concert::create([
            'title' => 'Concierto de Jazz',
            'date' => Carbon::parse('2025-07-15 19:30:00'),
            'location' => 'Teatro Nacional',
            'product_id' => $product2->id,  // Relacionamos el producto creado
        ]);

        Concert::create([
            'title' => 'Festival Electrónico',
            'date' => Carbon::parse('2025-08-10 23:00:00'),
            'location' => 'Club XYZ',
            'product_id' => $product3->id,  // Relacionamos el producto creado
        ]);
    }
}
