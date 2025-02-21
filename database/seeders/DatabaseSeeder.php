<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        // Add test user
        $this->testAccount();
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
                'description' =>
                    "Stay comfortable and focused with the Athletic Pro Hoodie, designed for gym sessions
and casual outings. Made with ultra-soft, breathable fabric and sweat-resistant technology,
this hoodie keeps you looking and feeling athletic wherever you are. It features an adjustable hood, ribbed cuffs, and a front kangaroo pocket for convenience.

Care & Material
100% Polyester
Machine washable
",
                'price' => 25.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Trailblazer Pullover Hoodie',
                'description' =>
                    "The Trailblazer Pullover Hoodie is built for adventure and comfort. Featuring a soft
fleece lining, this hoodie provides warmth on chilly mornings and hikes. Its relaxed
fit ensures all-day comfort, while the bold mountain graphic highlights your adventurous spirit.

Care & Material
60% Cotton, 40% Polyester
Machine washable
",
                'price' => 30.00,
                'colour' => 'Grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Urban Style Zip-Up Hoodie',
                'description' =>
                    "Elevate your streetwear game with the Urban Style Zip-Up Hoodie. Made from durable
fabric, it features a full zip closure, an adjustable hood, and sleek black accents for a
bold, modern look. Ideal for sports or relaxed casual outings.

Care & Material
100% Polyester
Machine washable
",
                'price' => 35.50,
                'colour' => 'Red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'EcoFit Hoodie',
                'description' =>
                    "Stay sustainable and stylish with the EcoFit Hoodie, made from eco-friendly materials.
Its breathable, lightweight fabric is perfect for jogging, yoga, or casual wear, offering both comfort
and versatility for your everyday routine.

Care & Material
Sustainably Sourced Cotton Blend
Machine washable
",
                'price' => 28.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            //  Mens Shoes
            new Product([
                'name' => 'Velocity Running Shoes',
                'description' =>
                    "The Velocity Running Shoes are engineered for performance and comfort. With
breathable mesh, enhanced grip soles, and lightweight construction, these shoes are
perfect for running on various terrains, helping you go the extra mile.

Care & Material
Synthetic Upper with Rubber Sole
Wipe clean with a damp cloth

",
                'price' => 35.00,
                'colour' => 'Green / Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Apex Trainers',
                'description' =>
                    "The Apex Trainers combine comfort and style, making them ideal for workouts or
casual wear. Featuring advanced cushioning, lightweight materials, and a bold design,
these trainers deliver excellent support for all-day activity.

Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth

",
                'price' => 32.50,
                'colour' => 'Red / Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Trail Master Hiking Shoes',
                'description' =>
                    "Tackle any terrain with the Trail Master Hiking Shoes. Built with high-grip soles, shock
absorption, and water-resistant materials, these durable shoes provide comfort and
stability for all your outdoor adventures.

Care & Material
Water-Resistant Synthetic Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 35.99,
                'colour' => 'Brown/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Flex Court Sneakers',
                'description' =>
                    "Stay agile and stylish with the FlexCourt Sneakers, perfect for indoor sports and
streetwear. These lightweight sneakers feature breathable uppers, cushioned support,
and a modern design for maximum versatility.

Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 29.99,
                'colour' => 'red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            // Mens Trousers
            new Product ([
                'name' => 'Dynamic Fit Joggers',
                'description' =>
                    "The Dynamic Fit Joggers are made for movement and style. Crafted with stretchable,
moisture-wicking fabric, these joggers offer a tapered fit and adjustable waistband for
maximum comfort during workouts or casual wear.

Care & Material
95% Polyester, 5% Elastane
Machine washable
",
                'price' => 20.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Terrain Cargo Pants',
                'description' =>
                    "Gear up for adventure with the Terrain Cargo Pants, designed for durability and
practicality. Featuring adjustable cuffs and multiple pockets, these lightweight pants
offer maximum versatility for outdoor activities.

Care & Material
65% Cotton, 35% Polyester
Machine washable
",
                'price' => 32.99,
                'colour' => 'beige',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)


            ]),
            new Product ([
                'name' => 'Comfort Active Trousers',
                'description' =>
                    "The Comfort Active Trousers offer unmatched softness and flexibility for training,
lounging, or daily routines. With a streamlined fit and secure pockets, these trousers
balance functionality and style.

Care & Material
90% Cotton, 10% Elastane
Machine washable
",
                'price' => 25.50,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Core Fit Track Pants',
                'description' =>
                    "Elevate your performance with the CoreFit Track Pants, designed for athletes who
demand comfort and style. Crafted from breathable material, these track pants ensure
you stay cool and focused during any activity. Featuring a secure drawstring waistband
and tapered fit, they deliver peak functionality and mobility for training or casual wear.

Care & Material
100% Polyester
Machine washable
",
                'price' => 27.00,
                'colour' => 'blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            //Mens Shirts
            new Product ([
                'name' => 'Performance Tee',
                'description' =>
                    "Maximize your performance with the Performance Tee, a sleek and versatile addition to your wardrobe. Designed for gym sessions or casual outings, this tee features lightweight, breathable fabric that keeps you cool and comfortable. The streamlined fit ensures effortless movement and a modern, athletic look.

Care & Material
100% Polyester
Machine washable
",
                'price' => 20.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Horizon Polo Shirt',
                'description' =>
                    "Stay elegant and comfortable with the Horizon Polo Shirt, a perfect blend of style and
functionality. Featuring breathable fabric and a modern gradient design, this polo is
ideal for sports or smart-casual occasions. The classic collar and tailored fit provide a
polished look while ensuring all-day comfort.

Care & Material
100% Polyester
Machine washable
",
                'price' => 28.99,
                'colour' => 'White/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ProCool Compression Shirt',
                'description' =>
                    "Take your workouts to the next level with the ProCool Compression Shirt, designed to
enhance performance and support recovery. Made with stretchy, moisture-wicking
fabric, this shirt provides a snug fit that reduces muscle fatigue and maximizes gains
from every session. Its sleek design and breathable material keep you comfortable
during intense training.

Care & Material
90% Polyester, 10% Elastane
Machine washable
",
                'price' => 22.99,
                'colour' => 'Black/Blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ActiveWear Long Sleeve',
                'description' =>
                    "Stay warm without sacrificing mobility with the ActiveWear Long Sleeve. Perfect for
cool-weather activities, this lightweight shirt provides insulation while maintaining
flexibility. Its moisture-wicking fabric ensures comfort, keeping you dry and focused
during your workout or outdoor adventures.

Care & Material
100% Polyester
Machine washable
",
                'price' => 25.99,
                'colour' => 'Black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            //Mens Jackets
            new Product ([
                'name' => 'All-Weather Sports Jacket',
                'description' =>
                    "Train without limits with the All-Weather Sports Jacket, engineered to withstand all
conditions. This windproof and waterproof jacket keeps you protected during outdoor
training sessions, ensuring you stay comfortable and focused no matter the weather.
Featuring a lightweight design, adjustable hood, and secure zippered pockets, it's the
ultimate companion for your active lifestyle.

Care & Material
100% Polyester
Machine washable
",
                'price' => 35.00,
                'colour' => 'Black/White',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Trailblazer Puffer Coat',
                'description' =>
                    "Stay warm and mobile with the Trailblazer Puffer Coat, a lightweight yet insulated
outerwear solution. Designed to keep you cozy without restricting movement, this coat
is perfect for winter sports or outdoor adventures. Featuring a water-resistant finish,
detachable faux fur-lined hood, and multiple secure pockets, it combines functionality
with style for cold-weather wear.

Care & Material
Outer: 100% Polyester
Insulation: Synthetic Fill
Machine washable
",
                'price' => 48.99,
                'colour' => 'Green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Summit Windbreaker',
                'description' =>
                    "The Summit Windbreaker is the ultimate choice for outdoor enthusiasts and runners
seeking lightweight and breathable protection. Designed to shield against wind and light
rain, this windbreaker ensures you stay comfortable during your adventures. Featuring
an adjustable hood, zippered pockets, and a sleek fit, it’s perfect for active pursuits or casual outdoor wear.

 Care & Material
100% Nylon
Machine washable
",
                'price' => 35.99,
                'colour' => 'Black/Grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ArticPro Training Coat',
                'description' =>
                    "Face the cold with confidence in the ArcticPro Training Coat, designed to keep you
warm without compromising on comfort or style. Featuring premium insulation and an
ergonomic design, this coat ensures you stay focused on your outdoor activities, no
matter the weather. With multiple secure pockets, a water-resistant finish, and a
windproof hood, it’s built for performance and functionality in extreme conditions.

Care & Material
Outer: 100% Polyester
Insulation: Synthetic Fill
Machine washable
",
                'price' => 40.00,
                'colour' => 'Black/Red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            // Womens Hoodies
            new Product ([
                'name' => 'Luxe Fleece Hoodie',
                'description' =>
                    "Elevate your casual style with the Luxe Fleece Hoodie, designed for ultimate comfort
and sophistication. Featuring a plush interior and stylish drawstrings, this hoodie
provides a cozy feel while maintaining a fashionable look. Perfect for lounging or casual
outings, it’s a versatile addition to your wardrobe.

Care & Material
60% Cotton, 40% Polyester
Machine washable
",
                'price' => 19.99,
                'colour' => 'Pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'TechStretch Hoodie',
                'description' =>
                    "Stay active and comfortable with the FlexMove Hoodie, designed for flexibility and
optimal movement. Made with moisture-wicking fabric, this hoodie keeps you dry and
focused during workouts or casual wear. Its stretchy construction ensures a perfect fit
and unrestricted motion, making it a must-have for your active wardrobe.

Care & Material
90% Polyester, 10% Elastane
Machine washable
",
                'price' => 24.50,
                'colour' => 'Green',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Performance Zip-Up Hoodie',
                'description' =>
                    "The Performance Zip-Up Hoodie is your ideal companion for layering during warm-ups
or chilly workouts. Lightweight and versatile, it features breathable fabric and a sleek fit,
ensuring you stay comfortable and focused. Perfect for active sessions or casual wear,
this hoodie combines functionality and style effortlessly.

Care & Material
88% Polyester, 12% Spandex
Machine washable
",
                'price' => 29.99,
                'colour' => 'Grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'All-Weather Training Hoodie',
                'description' =>
                    "Conquer the elements with the All-Weather Training Hoodie, designed for outdoor
performance in any condition. Featuring water-resistant fabric and a fitted hood, this
hoodie keeps you dry and comfortable during intense training sessions. Reflective
accents add visibility in low-light conditions, making it perfect for early morning
or evening workouts.

Care & Material
95% Polyester, 5% Spandex
Machine washable
",
                'price' => 45.00,
                'colour' => 'Light Blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //Womens Shoes
            new Product ([
                'name' => 'SwiftRun Trainers',
                'description' =>
                    "Take your workouts to the next level with the SwiftRun Trainers, designed for speed
and comfort. These trainers feature advanced cushioning and support to keep you light
on your feet during intense runs or training sessions. With a breathable upper and a
responsive sole, they ensure optimal performance and style for your active lifestyle.

Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 25.99,
                'colour' => 'Pink/Blue/Yellow/White',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ActiveGrip Sneakers',
                'description' =>
                    "Stay supported and steady with the ActiveGrip Sneakers, perfect for gym sessions and
outdoor sports. These sneakers feature superior grip and enhanced arch support,
ensuring all-day comfort and stability. With a modern design and durable construction,
they seamlessly combine performance with style for any activity.

Care & Material
Textile Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 48.50,
                'colour' => 'Black/White',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'FlexStep Running Shoes',
                'description' =>
                    "Experience comfort and performance with the FlexStep Running Shoes, designed for
runners who demand the best. Featuring a breathable mesh upper for enhanced airflow
and a shock-absorbing sole for smooth strides, these shoes keep you light and
supported during every run. Perfect for training sessions or casual walks, they combine
functionality with stylish design.

Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 32.00,
                'colour' => 'Blue/Pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Endurance Pro Running Shoes',
                'description' =>
                    "Push your limits with the Endurance Pro Running Shoes, engineered for durability
and peak performance. Featuring a reinforced arch for superior support and shock-absorbing
soles for reduced impact, these shoes are perfect for long-distance runs
or high-intensity training. With a breathable mesh upper, they ensure comfort and airflow
throughout your workout.

Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 32.00,
                'colour' => 'Black/Red',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //Womens trousers
            new Product ([
                'name' => 'HighRise Compression Leggings',
                'description' =>
                    "Take your workouts to the next level with the HighRise Compression Leggings,
designed for both performance and style. Featuring a high-rise fit for a flattering
silhouette and muscle support for enhanced endurance, these leggings are perfect for
training sessions or everyday wear. The moisture-wicking fabric keeps you dry and
comfortable throughout your activities.

Care & Material
88% Polyester, 12% Spandex
Machine washable
",
                'price' => 39.99,
                'colour' => 'Black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ThermaJog Joggers',
                'description' =>
                    "Stay cozy and stylish with the ThermaJog Joggers, perfect for cool-weather activities.
Designed with thermal insulation and a soft fleece interior, these joggers provide
exceptional warmth and comfort. The sleek fit and adjustable drawstring waistband
ensure a secure and flattering look, making them ideal for outdoor adventures or
lounging.

Care & Material
60% Cotton, 40% Polyester
Machine washable
 ",
                'price' => 28.50,
                'colour' => 'Dark-Grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'SportLuxe Sweatpants',
                'description' =>
                    "Elevate your casual wardrobe with the SportLuxe Sweatpants, where style meets
comfort. Crafted from ultra-soft fabric, these sweatpants offer a relaxed fit for ultimate
ease while maintaining a chic, laid-back look. Perfect for lounging or casual outings,
they feature an adjustable drawstring waistband and spacious side pockets for added
functionality.

Care & Material
70% Cotton, 30% Polyester
Machine washable
",
                'price' => 35.00,
                'colour' => 'Grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'ActiveTrail Hiking Trousers',
                'description' =>
                    "Tackle the great outdoors with the ActiveTrail Hiking Trousers, built for durability and
comfort. Designed with breathable, water-repellent fabric, these trousers keep you dry
and comfortable during hikes or outdoor adventures. Featuring multiple secure pockets
and a flexible fit, they provide practicality and freedom of movement for any trail.

Care & Material
65% Nylon, 35% Spandex
Machine washable
",
                'price' => 29.00,
                'colour' => 'Blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            //Womens shirts
            new Product ([
                'name' => 'FitPro Tank Top',
                'description' =>
                    "Stay cool and comfortable with the FitPro Tank Top, designed for optimal airflow and
freedom of movement. Featuring lightweight fabric and a racerback design, this tank top
is perfect for workouts, yoga, or casual wear. Its sleek and breathable style keeps you
feeling fresh, no matter how intense your activity.

Care & Material
100% Polyester
Machine washable
",
                'price' => 24.99,
                'colour' => 'Black/Pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'CoreActive T-Shirt',
                'description' =>
                    "Enhance your performance with the CoreActive T-Shirt, designed to keep you cool and
dry during workouts. Made with sweat-wicking fabric, this t-shirt ensures maximum
comfort and breathability for any activity. Its lightweight construction and classic fit
make it perfect for gym sessions or casual wear.


Care & Material
100% Polyester
Machine washable
",
                'price' => 29.50,
                'colour' => 'Black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product([
                'name' => 'Elevate Long Sleeve Top',
                'description' =>
                    "Stay comfortable and protected during outdoor activities with the Elevate Long Sleeve
Top. Designed with breathable fabric and built-in sun protection, this top keeps you
cool and safe under the sun. Its lightweight and versatile style makes it ideal for hikes,
 runs, or casual outings.

Care & Material
85% Polyester, 15% Cotton
Machine washable
",
                'price' => 16.99,
                'colour' => 'pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Balance Crop Tee',
                'description' =>
                    "Achieve effortless style and comfort with the Balance Crop Tee, perfect for workouts or
casual wear. Featuring a flattering cropped fit and breathable fabric, this tee ensures
unrestricted movement and a modern look. Its vibrant graphic design adds a bold
touch, making it a standout piece for your active wardrobe.

Care & Material
92% Polyester, 8% Spandex
Machine washable
",
                'price' => 28.00,
                'colour' => 'blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)

            ]),
            // coats women
            new Product ([
                'name' => 'MotionFlex Parka',
                'description' =>
                    "Stay chic and cozy with the MotionFlex Parka, designed for ultimate style and
functionality. Featuring a removable faux fur-lined hood and multiple secure pockets,
this parka offers practicality without compromising elegance. Its insulated design keeps
you warm in cold weather, making it a perfect choice for both urban and outdoor adventures.

Care & Material
Outer: 100% Polyester
Insulation: Synthetic Fill

Machine washable
",
                'price' => 45.99,
                'colour' => 'black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'ThermalFit Jacket',
                'description' =>
                    "Stay cozy without the bulk in the ThermalFit Jacket, designed with advanced thermal
insulation for warmth and comfort. Its tailored fit provides a sleek, modern silhouette,
while the lightweight construction ensures ease of movement. Perfect for cold-weather
 outings, this jacket offers a refined look while keeping you protected from the elements.

Care & Material
Outer: 100% Polyester
Insulation: Synthetic Fill
Machine washable
",
                'price' => 45.00,
                'colour' => 'beige',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'ActiveShield Rain Coat',
                'description' =>
                    "Brave the rain in style with the ActiveShield Rain Coat, designed for rainy runs and
outdoor activities. Made with breathable and waterproof material, this coat keeps you
dry and comfortable while ensuring unrestricted movement. Featuring an adjustable
hood, secure pockets, and a cinched waist for a flattering fit, it’s the perfect companion
 for wet-weather adventures.

Care & Material
100% Polyester
Machine washable
",
                'price' => 38.50,
                'colour' => 'orange',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'AllSeason Windbreaker',
                'description' =>
                    "Stay protected in any weather with the AllSeason Windbreaker, designed to shield you
from wind and light rain. Featuring water-repellent fabric and adjustable cuffs, this
windbreaker provides a secure and comfortable fit. With a lightweight design and
vibrant accents, it’s perfect for outdoor activities and everyday wear.

Care & Material
100% Nylon
Machine washable
",
                'price' => 29.99,
                'colour' => 'beige/pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            // The new ones
            new Product ([
                'name' => 'Performance Tech Hoodie',
                'description' =>
                    "Designed for active lifestyles, the Performance Tech Hoodie offers lightweight,
breathable comfort. Featuring moisture-wicking fabric and an athletic fit, it’s perfect for
workouts or casual wear, ensuring style and performance wherever you go.

Care & Material
100% Polyester
Machine washable
",
                'price' => 20.00,
                'colour' => 'blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Trail Runner Pro Shoes',
                'description' =>
                    "Take your outdoor adventures to the next level with the Trail Runner Pro Shoes.
Designed with durable construction, high-grip soles, and shock-absorbing technology,
these shoes deliver exceptional comfort and stability on any terrain. A water-resistant
finish ensures your feet stay dry, even in challenging conditions.

Care & Material
Synthetic Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 30.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'FlexFit Training Joggers',
                'description' =>
                    "Push your limits with the FlexFit Training Joggers, designed for high-impact
sports and intense gym sessions. These joggers feature stretchable, sweat-proof
fabric for maximum comfort and durability. Zippered pockets keep your
essentials secure, while reinforced knees provide extra protection and longevity
during tough workouts.

Care & Material
90% Polyester, 10% Elastane
Machine washable
",
                'price' => 30.00,
                'colour' => 'grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'ActiveCool Compression Shirt',
                'description' =>
                    "Stay fresh and supported during intense workouts with the Quick-Dry Compression
Shirt. Featuring advanced quick-dry and anti-odor technology, this shirt keeps you
comfortable and odor-free. The snug compression fit provides excellent muscle
support, reducing fatigue and enhancing performance. Ideal for high-intensity training
sessions or outdoor activities.

Care & Material
88% Polyester, 12% Elastane
Machine washable
",
                'price' => 20.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'ThermoShield Sports Jacket',
                'description' =>
                    "Stay warm and protected in the ThermoShield Sports Jacket, designed for outdoor
activities in cold and challenging weather. This insulated, windproof, and waterproof
jacket ensures maximum warmth while keeping you shielded from the elements. With
its adjustable hood, secure zippered pockets, and durable construction, it’s perfect for
hiking, training, or any cold-weather adventure.

Care & Material
Outer: 100% Polyester
Insulation: Synthetic Fill
Machine washable
",
                'price' => 25.00,
                'colour' => 'yellow',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Energy Flow Zip Hoodie',
                'description' =>
                    "The Energy Flow Zip Hoodie combines style and functionality, making it perfect for
 workouts or athleisure. Featuring quick-dry fabric, breathable mesh panels, and
thumbholes for added comfort, this sleek and fitted hoodie ensures unrestricted
movement while keeping you cool and dry. Ideal for active days or casual outings, it’s a
versatile essential for your wardrobe.

Care & Material
92% Polyester, 8% Spandex
Machine washable
",
                'price' => 20.00,
                'colour' => 'blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'Pulse Track Running Shoes',
                'description' =>
                    "Achieve peak performance with the Pulse Track Running Shoes, designed for comfort
and style. These lightweight running shoes feature cushioned soles for smooth strides,
reinforced arch support for stability, and a modern design that keeps you looking sharp.
Perfect for both training sessions and casual wear, they combine functionality with flair.

Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth
",
                'price' => 25.00,
                'colour' => 'black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'PowerFlex Workout Leggings',
                'description' =>
                    "The PowerFlex Workout Leggings are designed for active lifestyles, combining
functionality and comfort. Featuring a high-waisted fit for support and a flattering
 silhouette, these leggings are made with four-way stretch and moisture-wicking fabric
to keep you moving comfortably. A hidden pocket adds convenience, making them
perfect for workouts or casual wear.

Care & Material
87% Nylon, 13% Spandex
Machine washable
",
                'price' => 20.00,
                'colour' => 'purple',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),
            new Product ([
                'name' => 'Performance Fit Tee',
                'description' =>
                    "Experience unmatched comfort with the Performance Fit Tee, crafted for active
lifestyles. Featuring sweat-wicking technology and a breathable, soft fabric, this tee
keeps you cool and dry during workouts. Its flattering fit ensures effortless style while
enhancing movement, making it a perfect addition to your fitness wardrobe.

Care & Material
95% Polyester, 5% Elastane
Machine washable
",
                'price' => 20.00,
                'colour' => ' grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)

            ]),
            new Product ([
                'name' => 'All-Weather Performance Jacket',
                'description' =>
                    "Conquer the outdoors with the All-Weather Performance Jacket, crafted for
lightweight protection and style. Featuring water-resistant fabric, reflective details for
 visibility, and an adjustable hood, this jacket is perfect for outdoor sports and
adventures. Its feminine fit ensures both comfort and elegance, making it a versatile
choice for any activity.

Care & Material
100% Polyester
Machine washable
",
                'price' => 20.00,
                'colour' => 'black/pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),


        ];
        foreach ($products as $product) {
            $product->save();
        }


        // set the created_at date to 30 days ago
        foreach ($products as $product) {
        $product['created_at'] = now()->subDays(30);
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
            ]),
            new ProductImage([
                'product_id' => 41,
                'image_name' => 'd06f30ef-8629-43be-9118-24850641bc69.jpg'
            ]),
            new ProductImage([
                'product_id' => 42,
                'image_name' => '1aff6d07-c83f-4882-959a-b4fa2ed5a19a.jpg'
            ]),
            new ProductImage([
                'product_id' => 43,
                'image_name' => '5cdacfef-3345-4f60-a86e-000aad07f190.jpg'
            ]),
            new ProductImage([
                'product_id' => 44,
                'image_name' => 'eb911df8-a8b8-4f66-86f7-dc6eec271139.jpg'
            ]),
            new ProductImage([
                'product_id' => 45,
                'image_name' => 'aa7b194c-99d9-4b16-872a-fb240eb8b095.jpg'
            ]),
            new ProductImage([
                'product_id' => 46,
                'image_name' => 'e6342a03-7a66-4f5d-af11-fd6136ebab02.jpg'
            ]),
            new ProductImage([
                'product_id' => 47,
                'image_name' => '8573ac4b-e2c8-4ea3-8909-f60126839a3c.jpg'
            ]),
            new ProductImage([
                'product_id' => 48,
                'image_name' => '61e944f1-5fbe-4b44-aaee-fa5b60190a82.jpg'
            ]),
            new ProductImage([
                'product_id' => 49,
                'image_name' => '084f1eba-31c6-47d6-aaee-b07d0a003649.jpg'
            ]),
            new ProductImage([
                'product_id' => 50,
                'image_name' => 'e10299f4-3a87-40e5-bece-498c95630579.jpg'
            ])
        ];
        foreach ($images as $image) {
            $image->save();
        }
    }
    // Create a test account
    function testAccount()
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@account.com',
            'password' => Hash::make('password'),
            'phone_number' => '+447111111111',
            'home_address' => 'Test home address',
            'postcode' => '',
            'role' => 'user'
        ]);
        $user->save();
    }
}
