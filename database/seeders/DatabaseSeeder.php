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
            new Product ([
                'name' => 'Apex Trainers',
                'description' => " To stay at the top you'll need the Apex Trainers. They deliver comfort and style.Ideal for both workouts and casual wear providing excellent support for all-day activity and helping you stay on top.",
                'price' => 32.50,
                'color' => 'Red / Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand(1,50)
            ]),
            new Product ([
                'name' => 'Trail Master Hiking Shoes',
                'description' => " The Trail Master Hiking Shoes are designed for durability and comfort,they provide excellent traction on uneven surfaces making them perferct for hiking.",
                'price' => 35.99,
                'color' => 'Brown/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand(1,50)
                
            ]),
            new Product ([
                'name' => 'Flex Court Sneakers',
                'description'=> " The Flex Court Sneakers are versatile and stylish , perfect for both indoor sports and streetwear.Their lightweight design ensures agility and comfort",
                'price' => 29.99,
                'color' => 'red',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand(1,50)
            ]),
            // Trousers
            new Product ([
                'name' => 'Dynamic Fit Joggers',
                'description' => "The Dynamic Fit Joggers are made from stretchable fabric , offering maximum mobility and comfort during workouts while keeping you looking in style making it great for performance and looking good",
                'price' => 20.00,
                'color' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand(1,50)

            ]),
            new Product ([
                'name' => 'Terrain Cargo Pants',
                'description' => "Are you an outdoor enthusiast? Then the Terrain Cargo Pants are perfect for you.They feature adjustable cuffs for a tailored fit keeping them durable but lightweight",
                'price' => 32.99,
                'color' =>'beige',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand(1,50)
            

            ]),
            new Product ([
                'name' => 'Comfort Active Trousers',
                'description' => "Whether you're lounging or training.The Comfort Active Trousers provide unmatched softness and flexibility for your daily routine.",
                'price' => 25.50,
                'color' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name','Shoes')->first()->id,
                'stock' => rand (1,50)
            ]),
            new Product ([
                'name' => 'Core Fit Track Pants',
                'description' => "A peak athlete needs clothes that can match their peak performance. The Core Fit Track pants are built for athletes.Their breathable material and secure fit ensure peak performance in any activity.",
                
            ])

        ];
        foreach ($products as $product) {
            $product->save();
        }
    }
}
