<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
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
        // Adds some products
        $this->addProducts();
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
        // A list of products
        // Copied from document provided by Muhammad Khan on Trello
        $products = [
            // Mens
            //   Hoodies
            new Product([
                'name' => 'Athletic Pro Hoodie',
                'description' => "Staying comfortable during workouts is possible with the Athletic Pro Hoodie. Made from soft fabric and sweat resistant technology, this hoodie is perfect for gym sessions or casual outings keeping you athletic wherever you are.",
                'price' => 25.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name','Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Trailblazer Pullover Hoodie',
                'description' => "The Trailblazer Pullover Hoodie is crafted for adventure with Its soft fleece lining keeps you warm during hikes or chilly mornings and the relaxed fit ensuring all-day comfort you can’t go wrong picking this choice.",
                'price' => 30.00,
                'colour' => 'Grey',
                'mens' => true,
                'category_id' => Category::all()->where('name','Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Urban Style Zip-Up Hoodie',
                'description' => "Elevate your street style with the Urban Style Zip-Up Hoodie. Designed with durable fabric, this hoodie combines fashion and functionality for your active lifestyle whether that be sports or something a little bit more relaxed this hoodie has got you covered.",
                'price' => 35.50,
                'colour' => 'Red',
                'mens' => true,
                'category_id' => Category::all()->where('name','Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'EcoFit Hoodie',
                'description' => "The EcoFit Hoodie is perfect for eco-conscious fitness enthusiasts. Breathable and lightweight, it’s ideal for jogging, yoga, or casual wear an all round good option.",
                'price' => 28.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name','Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //   Shoes
            new Product([
                'name' => 'Velocity Running Shoes',
                'description' => "Push past your limits with the Velocity Running Shoes. Designed for ultimate performance, these shoes feature breathable material and enhanced grip for various terrains letting you above and beyond.",
                'price' => 35.00,
                'colour' => 'Green / Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

        ];
        foreach ($products as $product) {
            $product->save();
        }
    }
}
