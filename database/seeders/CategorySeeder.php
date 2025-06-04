<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {

        Category::create(['name' => 'Merchandising', 'slug' => 'merchandising']);
        Category::create(['name' => 'Entradas', 'slug' => 'tickets']);
        Category::create(['name' => 'Clothing', 'slug' => 'clothing']);

    }
}
