<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // Adds required categories
        $this->addCategories();
    }
    private function addCategories()
    {
        //shoes, trousers, hoodies, jackets, shirts
        //creates a load of categories to add to the database.
        $categories = [
            new Category([
                'name' => 'Shoes',
                'description' => 'A selection of shoes'
            ]),
            new Category([
                'name' => 'Trousers',
                'description' => 'A selection of trousers'
            ]),
            new Category([
                'name' => 'Hoodies',
                'description' => 'A selection of hoodies'
            ]),
            new Category([
                'name' => 'Jackets',
                'description' => 'A selection of jackets'
            ]),
            new Category([
                'name' => 'Shirts',
                'description' => 'A selection of shirts'
            ])
        ];
        // individually saves each category.
        foreach ($categories as $category) {
            $category->save();
        }
    }
    private function addProducts() {

    }
}
