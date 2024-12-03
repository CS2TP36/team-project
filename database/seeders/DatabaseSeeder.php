<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
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
        // Add images
        $this->addImages();
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

    private function addProducts()
    {
        // A list of products
        // Copied from document provided by Muhammad Khan on Trello
        $products = [
            // Mens Hoodies
            new Product([
                'name' => 'Athletic Pro Hoodie',
                'description' => "Staying comfortable during workouts is possible with the Athletic Pro Hoodie. Made from soft fabric and sweat resistant technology, this hoodie is perfect for gym sessions or casual outings keeping you athletic wherever you are.",
                'price' => 25.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Trailblazer Pullover Hoodie',
                'description' => "The Trailblazer Pullover Hoodie is crafted for adventure with Its soft fleece lining keeps you warm during hikes or chilly mornings and the relaxed fit ensuring all-day comfort you can’t go wrong picking this choice.",
                'price' => 30.00,
                'colour' => 'Grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Urban Style Zip-Up Hoodie',
                'description' => "Elevate your street style with the Urban Style Zip-Up Hoodie. Designed with durable fabric, this hoodie combines fashion and functionality for your active lifestyle whether that be sports or something a little bit more relaxed this hoodie has got you covered.",
                'price' => 35.50,
                'colour' => 'Red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'EcoFit Hoodie',
                'description' => "The EcoFit Hoodie is perfect for eco-conscious fitness enthusiasts. Breathable and lightweight, it’s ideal for jogging, yoga, or casual wear an all round good option.",
                'price' => 28.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            //  Mens Shoes
            new Product([
                'name' => 'Velocity Running Shoes',
                'description' => "Push past your limits with the Velocity Running Shoes. Designed for ultimate performance, these shoes feature breathable material and enhanced grip for various terrains letting you above and beyond.",
                'price' => 35.00,
                'colour' => 'Green / Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Apex Trainers',
                'description' => " To stay at the top you'll need the Apex Trainers. They deliver comfort and style.Ideal for both workouts and casual wear providing excellent support for all-day activity and helping you stay on top.",
                'price' => 32.50,
                'colour' => 'Red / Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Trail Master Hiking Shoes',
                'description' => " The Trail Master Hiking Shoes are designed for durability and comfort,they provide excellent traction on uneven surfaces making them perferct for hiking.",
                'price' => 35.99,
                'colour' => 'Brown/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Flex Court Sneakers',
                'description' => " The Flex Court Sneakers are versatile and stylish , perfect for both indoor sports and streetwear.Their lightweight design ensures agility and comfort",
                'price' => 29.99,
                'colour' => 'red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            // Mens Trousers
            new Product ([
                'name' => 'Dynamic Fit Joggers',
                'description' => "The Dynamic Fit Joggers are made from stretchable fabric , offering maximum mobility and comfort during workouts while keeping you looking in style making it great for performance and looking good",
                'price' => 20.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Terrain Cargo Pants',
                'description' => "Are you an outdoor enthusiast? Then the Terrain Cargo Pants are perfect for you.They feature adjustable cuffs for a tailored fit keeping them durable but lightweight",
                'price' => 32.99,
                'colour' => 'beige',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)


            ]),
            new Product ([
                'name' => 'Comfort Active Trousers',
                'description' => "Whether you're lounging or training.The Comfort Active Trousers provide unmatched softness and flexibility for your daily routine.",
                'price' => 25.50,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Core Fit Track Pants',
                'description' => "A peak athlete needs clothes that can match their peak performance. The Core Fit Track pants are built for athletes.Their breathable material and secure fit ensure peak performance in any activity.",
                'price' => 27.00,
                'colour' => 'blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            //Mens Shirts
            new Product ([
                'name' => 'Performance Tee',
                'description' => "Maximize your performance with this sleek Performance Tee which allows it to be Ideal for gym sessions or casual outings. ",
                'price' => 20.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Horizon Polo Shirt',
                'description' => "If you want both elegance and comfort we got your back with the Horizon Polo Shirt. Don’t compromises on either as Its breathable fabric makes it perfect for sports or smart-casual wear. ",
                'price' => 28.99,
                'colour' => 'White/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ProCool Compression Shirt',
                'description' => "Enhance your workouts with the ProCool Compression Shirt with Its stretchy material its able to provides support and reduces muscle fatigue so you can squeeze out every gain from your hardwork. ",
                'price' => 22.99,
                'colour' => 'Black/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ActiveWear Long Sleeve',
                'description' => "Staying warm doesn’t always mean more layers. Maintain your flexibility with the ActiveWear Long Sleeve. Ideal for cool weather activities, this shirt ensures maximum comfort and mobility as well as ensuring you don’t get cold. ",
                'price' => 25.99,
                'colour' => 'Black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            //Mens Jackets
            new Product ([
                'name' => 'All-Weather Sports Jacket',
                'description' => "The All-Weather Sports Jacket is a windproof and waterproof jacket designed for outdoor training sessions which as its name suggests , can withstand all types of weather. ",
                'price' => 35.00,
                'colour' => 'Black/White',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Trailblazer Puffer Coat',
                'description' => "The Trailblazer Puffer Coat is lightweight yet insulated puffer coat which allows the wearer to keep warm without compromising mobility which makes it perfect for winter sports. ",
                'price' => 48.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Summit Windbreaker',
                'description' => "If you want a lightweight and breathable windbreaker, the summit windbreaker is ideal, it provides protection against wind and light rain making the best option for runners or anyone who enjoys the outdoors. ",
                'price' => 35.99,
                'colour' => 'Black/Grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ArticPro Training Coat',
                'description' => "Don’t let cold weather stop your plans with our ArcticPro Training Coat. Its premium insulation and ergonomic design ensure maximum comfort and style but most importantly keeping you warm so you can focus on what really matters. ",
                'price' => 40.00,
                'colour' => 'Black/Red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            // Womens Hoodies
            new Product ([
                'name' => 'Luxe Fleece Hoodie',
                'description' => "Upgrade your wardrobe with our Luxe Fleece Hoodie. Features a plush interior and stylish drawstrings for ultimate comfort. ",
                'price' => 19.99,
                'colour' => 'Pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'TechStretch Hoodie',
                'description' => "Made with moisture-wicking fabric, this hoodie offers stretch for flexibility and optimal movement. ",
                'price' => 24.50,
                'colour' => 'Green',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Performance Zip-Up Hoodie',
                'description' => "Lightweight and versatile, this hoodie is perfect for layering during warm-ups or chilly workouts. ",
                'price' => 29.99,
                'colour' => 'Grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'All-Weather Training Hoodie',
                'description' => "Built for performance, the All-Weather Training Hoodie offers water-resistant fabric and a fitted hood for outdoor training. ",
                'price' => 45.00,
                'colour' => 'Light Blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //Womens Shoes
            new Product ([
                'name' => 'SwiftRun Trainers',
                'description' => "Run faster and feel lighter with SwiftRun Trainers, engineered for support and cushioning during intense workouts. ",
                'price' => 25.99,
                'colour' => 'Pink/Blue/Yellow/White',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ActiveGrip Sneakers',
                'description' => "Perfect for gym and outdoor sports, the ActiveGrip Sneakers provide superior grip and arch support for all-day wear. ",
                'price' => 48.50,
                'colour' => 'Black/White',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'FlexStep Running Shoes',
                'description' => "Experience unmatched comfort with FlexStep Running Shoes, featuring breathable mesh and a shock-absorbing sole. ",
                'price' => 32.00,
                'colour' => 'Blue/Pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Endurance Pro Running Shoes',
                'description' => "Push your limits with Endurance Pro Running Shoes, featuring a reinforced arch and shock-absorbing soles. ",
                'price' => 32.00,
                'colour' => 'Black/Red',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //Womens trousers
            new Product ([
                'name' => 'HighRise Compression Leggings',
                'description' => "Designed for performance, these leggings provide muscle support and a flattering high-rise fit. ",
                'price' => 39.99,
                'colour' => 'Black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ThermaJog Joggers',
                'description' => "Perfect for cool weather, these joggers feature thermal insulation and a soft fleece interior. ",
                'price' => 28.50,
                'colour' => 'Dark-Grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'SportLuxe Sweatpants',
                'description' => "Feel luxurious in SportLuxe Sweatpants, combining style and comfort for a laid-back yet chic look. ",
                'price' => 35.00,
                'colour' => 'Grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ActiveTrail Hiking Trousers',
                'description' => "Durable and breathable, these trousers are made for hiking and outdoor activities, with water-repellent fabric. ",
                'price' => 29.00,
                'colour' => 'Blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //Womens shirts
            new Product ([
                'name' => 'FitPro Tank Top',
                'description' => "Beat the heat with the FitPro Tank Top, featuring lightweight fabric and a racerback design for maximum airflow. ",
                'price' => 24.99,
                'colour' => 'Black/Pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'CoreActive T-Shirt',
                'description' => "Stay cool and dry during workouts with CoreActive T-Shirt, made from sweat-wicking fabric for enhanced performance. ",
                'price' => 29.50,
                'colour' => 'Black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Elevate long sleeve top',
                'description' => "The Elevate long sleeve top offers sun protection and breathability,perfect for outdoor activities.",
                'price' => 16.99,
                'colour' => 'pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Balance crop tee',
                'description' => "acheive effortless style with Balance crop tee,designied for a flattering fit and unrestricted movement.",
                'price' => 28.00,
                'colour' => 'blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)

            ]),
            // coats women
            new Product ([
                'name' => 'Motion flex parka',
                'description' => "look chill and stay protected with Motion flex parka , offering a removable hood and multiple pockets.",
                'price' => 45.99,
                'colour' => 'black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Thermal fit jacket ',
                'description' => "stay warm without bulk with the Thermal fit jacket , designed with thermal insulation and a tailored fit",
                'price' => 45.00,
                'colour' => 'beige',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Active sheild rain coat',
                'description' => "keep dry during rainy runs with the Active sheild rain coat ,craffted with breathable and waterproof material.",
                'price' => 38.50,
                'colour' => 'orange',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'All season windbreaker',
                'description' => "sheild yourself from the elements with the All seaon wind breaker , featuring water-repellent fabric and adjustable cuffs.",
                'price' => 29.99,
                'colour' => 'beige/pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new product ([
                'name' => 'performance tech hoodie',
                'description'=> "A lightweight, breathable hoodie with moisture-wicking fabric and an athletic fit, perfect for workouts or casual wear.",
                'price'=> 20.00,
                'color'=> 'blue',
                'mens'=> true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock'=> rand (1,50)

            ]),
            new produt ([
                'name'=>'trail runner pro shoes',
                'description'=> "Durable trail running shoes with high-grip soles, shock absorption, and water resistance for all-terrain adventures.",
                'price'=> 30.00,
                'color'=> 'black',
                'mens'=> true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock'=> rand (1,50)

            ]),
            new product ([
                'name'=> 'flexfit training joggers',
                'description'=>"Stretchable, sweat-proof joggers with zippered pockets and reinforced knees, designed for high-impact sports or gym sessions.",
                'price'=>30.00,
                'color'=> 'grey',
                'mens'=> true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock'=> rand (1,50)

            ]),
            new product ([
                'name'=> 'active cool compression shirt',
                'description'=> "A quick-dry, anti-odor compression shirt that provides muscle support and keeps you comfortable during intense workouts",
                'price'=>20.00,
                'color'=> 'black',
                'mens'=> true ,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock'=> rand (1,50)
                
            ]),
            new product ([
                'name'=> 'thermosheild sports jacket',
                'description'=> "An insulated, windproof, and waterproof sports jacket that offers warmth and protection for outdoor activities in cold weather.",
                'price'=> 25.00,
                'color'=> 'yellow',
                'mens'=> true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock'=> rand (1,50)

            ]),
            new product ([
                'name'=> 'energy flow zip hoodie',
                'description'=> "A sleek, fitted hoodie with thumbholes, breathable mesh panels, and quick-dry fabric for workouts or athleisure.",
                'price'=> 20.00,
                'color'=>'blue',
                'mens'=> false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock'=> rand (1,50)

            ]),
            new product ([
                'name'=> 'pulse track running shoes',
                'description'=> "Lightweight running shoes with cushioned soles, arch support, and stylish design for optimal performance and comfort.",
                'price'=> 25.00,
                'color'=> 'black',
                'mens'=> false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock'=> rand (1,50)
            ]),
            new product ([
                'name'=> 'powerflex workout leggings',
                'description'=> "High-waisted leggings with four-way stretch, moisture-wicking fabric, and a hidden pocket for active lifestyles.",
                'price'=> 20.00,
                'color'=> 'purple',
                'mens'=> false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock'=> rand (1,50)
            ]),
            new product ([
                'name'=> 'breathe fit sports tee',
                'description'=> "A breathable, soft tee with sweat-wicking technology and a flattering fit to enhance performance and comfort.",
                'price'=> 20.00,
                'color'=> ' grey',
                'mens'=> false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock'=> rand (1,50)

            ]),
            new product ([
                'name'=> 'All weather performance jacket',
                'description'=> "A lightweight, water-resistant jacket with reflective details, adjustable hood, and a feminine fit for outdoor sports.",
                'price'=> 20.00,
                'color'=>'black/pink',
                'mens'=>false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock'=> rand (1,50)

            ]),



        ];
        foreach ($products as $product) {
            $product->save();
        }
    }

    private function addImages(): void
    {
        // image names generated using uuid v4
        $images = [

            //mens hoodies

            new ProductImage([
                'product_id' => 1,
                'image_name' => 'e962817a-cc88-4939-b985-29d8c6709dbc.jpg'
            ]),
            new ProductImage([
                'product_id' => 2,
                'image_name' => 'b227d00e-7254-4502-9f0c-0b2384797932.jpg'
            ]),
            new ProductImage([
                'product_id' => 3,
                'image_name' => 'c20ab3a3-b904-4450-8292-2bd5036757ec.jpg'
            ]),
            new ProductImage([
                'product_id' => 4,
                'image_name' => '7db446c4-8537-41b6-a1ee-e7068bfb8bc8.jpg'
            ]),

            //mens shoes
            new ProductImage([
                'product_id' => 5,
                'image_name' => '68313941-69f1-4bf9-bb02-de3a64caa29f.jpg'
            ]),
            new ProductImage([
                'product_id' => 6,
                'image_name' => '52e26d0e-de3d-4c3f-b1ee-2dfc6be84fd1.jpg'
            ]),
            new ProductImage([
                'product_id' => 7,
                'image_name' => '62aaf67e-8e3a-41b0-9eeb-79ccb3c193c8.jpg'
            ]),
            new ProductImage([
                'product_id' => 8,
                'image_name' => '36872fff-bb0e-40e7-ae3a-7b176b5190cc.jpg'

                //Mens trousers
            ]),
            new ProductImage([
                'product_id' => 9,
                'image_name' => 'a5f65a82-00c8-4ece-8b87-0b89052cd11b.jpg'
            ]),
            new ProductImage([
                'product_id' => 10,
                'image_name' => '84604438-69cf-4d03-ae92-4b25ebc66f26.jpg'
            ]),
            new ProductImage([
                'product_id' => 11,
                'image_name' => '5a708f52-ff68-4d53-8c15-a5506420c4d7.jpg'
            ]),
            new ProductImage([
                'product_id' => 12,
                'image_name' => 'a95f0f34-8173-48d7-b5ba-c5e5b3c0d3a9.jpg'
            ]),

            //men shirts
            new ProductImage([
                'product_id' => 13,
                'image_name' => '3fc06f19-2ec2-4dec-9e1e-ae809bfb1fba.jpg'
            ]),
            new ProductImage([
                'product_id' => 14,
                'image_name' => '87d1e39e-f346-496b-8c07-c20acfda991e.jpg'
            ]),
            new ProductImage([
                'product_id' => 15,
                'image_name' => 'a8666449-d191-459e-82c3-4d7a861924a7.jpg'
            ]),
            new ProductImage([
                'product_id' => 16,
                'image_name' => 'ed603ff9-c1d2-4db5-be02-54708a0c8f7b.jpg'
            ]),

            //men jackets
            new ProductImage([
                'product_id' => 17,
                'image_name' => 'd7609c18-ec0e-4b3d-995e-3f146918ac5c.jpg'
            ]),
            new ProductImage([
                'product_id' => 18,
                'image_name' => 'f49faaf0-8dae-45da-ba13-119428361c97.jpg'
            ]),
            new ProductImage([
                'product_id' => 19,
                'image_name' => '5f281151-52d7-4b11-9101-acb04b590662.jpg'
            ]),
            new ProductImage([
                'product_id' => 20,
                'image_name' => '76c5447f-d930-4764-a47e-9d5d397a94af.jpg'
            ]),

            //women hoodies
            new ProductImage([
                'product_id' => 21,
                'image_name' => '555bd9f0-bd75-488d-80b6-55dc783448c5.jpg'
            ]),
            new ProductImage([
                'product_id' => 22,
                'image_name' => '7e2ffadb-6442-475a-a8ce-ef9f7fb6374d.jpg'
            ]),
            new ProductImage([
                'product_id' => 23,
                'image_name' => '375fd25a-384b-436a-85d1-0db9842c740f.jpg'
            ]),
            new ProductImage([
                'product_id' => 24,
                'image_name' => 'fff8e702-fc7b-41ae-be5e-7d293b5aaffb.jpg'
            ]),

            //womens shoes
            new ProductImage([
                'product_id' => 25,
                'image_name' => 'ae5fb361-7240-4670-b242-1f57c23db89a.jpg'
            ]),
            new ProductImage([
                'product_id' => 26,
                'image_name' => '09ebcc7d-8037-4021-8652-4e65e25b006d.jpg'
            ]),
            new ProductImage([
                'product_id' => 27,
                'image_name' => 'e8863339-57a2-4e0e-abb8-8296fbe8b750.jpg'
            ]),
            new ProductImage([
                'product_id' => 28,
                'image_name' => '5f75e511-4e5d-43cb-9716-afa55cdbc48e.jpg'
            ]),

            //womens trousers
            new ProductImage([
                'product_id' => 29,
                'image_name' => 'a5056cf7-30f2-49f8-a08d-c0f511e614b3.jpg'
            ]),
            new ProductImage([
                'product_id' => 30,
                'image_name' => 'e9ff5aa5-97aa-4af3-9b19-157c50d51e1b.jpg'
            ]),
            new ProductImage([
                'product_id' => 31,
                'image_name' => 'edea456e-eb22-49de-9731-6ab4ece4d7d9.jpg'
            ]),
            new ProductImage([
                'product_id' => 32,
                'image_name' => '237476b3-e816-4331-8920-3ea2cb636924.jpg'
            ]),

            //womens shirts
            new ProductImage([
                'product_id' => 33,
                'image_name' => 'c5e578ab-6199-4762-b30e-7c0a1887f34b.jpg'
            ]),
            new ProductImage([
                'product_id' => 34,
                'image_name' => '77b5bdfa-75e1-4aff-a027-47bb32a7f48e.jpg'
            ]),
            new ProductImage([
                'product_id' => 35,
                'image_name' => '9aa2e9c7-96fb-40d3-8ca0-3a494e4fb534.jpg'
            ]),
            new ProductImage([
                'product_id' => 36,
                'image_name' => 'c788c441-5b74-4fc1-a003-ddfd3eee5e44.jpg'
            ]),

            //womens jackets
            new ProductImage([
                'product_id' => 37,
                'image_name' => '2f2b7296-07ea-4624-83cc-8710f3a0e9f7.jpg'
            ]),
            new ProductImage([
                'product_id' => 38,
                'image_name' => '5e16aace-64bb-4906-9567-619c205d7b7a.jpg'
            ]),
            new ProductImage([
                'product_id' => 39,
                'image_name' => '634c7a24-99bd-4849-8f5e-5ae1033f07d8.jpg'
            ]),
            new ProductImage([
                'product_id' => 40,
                'image_name' => 'cc302463-ad88-4423-8959-f7b486db2d22.jpg'
            ])

        ];
        foreach ($images as $image) {
            $image->save();
        }
    }
}
