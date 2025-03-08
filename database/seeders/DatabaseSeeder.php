<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\IndividualOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Shipping;
use App\Models\Transaction;
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
        // Add some random orders (may take some time, comment out if no orders are needed)
        $this->addOrders();
    }

    private function addCategories(): void
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

    private function addProducts(): void
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

            new Product ([
                'name' => 'Velocity Performance T-Shirt',
                'description' =>
                    "The Velocity Performance T-Shirt is engineered for athletes and fitness enthusiasts. Made from breathable, moisture-wicking fabric,
                    it keeps you cool and dry during intense workouts. The sleek, athletic fit enhances movement and flexibility, while the bold red stripe
                     accents add a dynamic and stylish touch.

Care & Material
90% Polyester, 10% Spandex
Machine washable, tumble dry low

",
                'price' => 25.00,
                'colour' => 'black/red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Apex Grid Performance T-Shirt',
                'description' =>
                    "The Apex Grid Performance T-Shirt is designed for athletes seeking both style and functionality. Made with lightweight, moisture-wicking fabric,
                    it enhances airflow to keep you cool and dry during intense training.
                     The geometric grid pattern gives a futuristic and energetic look, while the ergonomic fit allows maximum flexibility and movement.
Care & Material
88% Polyester, 12% Spandex
Machine washable, cold wash recommended


",
                'price' => 28.00,
                'colour' => 'blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Titan Compression Long Sleeve',
                'description' =>
                    "The Titan Compression Long Sleeve is built for performance and endurance. Designed with advanced compression technology, it enhances muscle support
                    and improves circulation, making it perfect for intense training and recovery.The sleek, body-contouring fit provides unrestricted movement, while
                    the breathable, moisture-wicking fabric keeps you cool and dry during workouts.
Care & Material
85% Polyester, 15% Spandex
Machine washable, air dry recommended



",
                'price' => 32.00,
                'colour' => 'grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'NeoStrike Compression T-Shirt',
                'description' =>
                    "The NeoStrike Compression T-Shirt is engineered for maximum performance and agility. Featuring high-stretch, moisture-wicking fabric, it keeps you cool, dry,
                    and comfortable during intense workouts. The ergonomic design enhances mobility, while the bold neon green and black accents create a striking,
                     futuristic look. Perfect for gym sessions, running, and high-intensity training.
Care & Material
88% Polyester, 12% Spandex
Machine washable, cold wash recommended
",
                'price' => 30.00,
                'colour' => 'black/green/white',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Compression Long Sleeve',
                'description' =>
                    "The Inferno Compression Long Sleeve is built for intense workouts and high-performance training. Designed with heat-regulating, moisture-wicking fabric,
                    it keeps you cool and dry while providing optimal muscle support. The sleek gradient red-to-black design gives it a bold, fiery look, while the ergonomic fit
                    allows for unrestricted movement. Ideal for gym training, running, and outdoor activities.
Care & Material
85% Polyester, 15% Spandex
Machine washable, air dry recommended
",
                'price' => 34.00,
                'colour' => 'red/black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Shadowstrike Performance Hoodie',
                'description' =>
                    "The Shadowstrike Performance Hoodie combines style, comfort, and high-performance design. Made from premium moisture-wicking fabric,
                    it keeps you warm yet breathable during workouts or casual wear. The sleek black design with bold red accents adds a modern, athletic look, while the adjustable
                     hood and zip-up front provide versatility.The fitted design ensures maximum flexibility and comfort, making it perfect for training, running, or everyday wear.
Care & Material
65% Polyester, 35% cotton
Machine washable, tumble dry low
",
                'price' => 45.00,
                'colour' => 'red/black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'SkyForge Athletic Hoodie',
                'description' =>
                    "The SkyForge Athletic Hoodie is designed for performance and comfort, perfect for training sessions or casual wear. Made with a lightweight
                    yet insulating fabric, it provides warmth without overheating. The sleek blue design with textured shoulder accents adds a modern touch, while
                    the adjustable hood and full-zip closure offer versatility. The ergonomic fit ensures full range of motion, making it ideal for active and everyday wear.
Care & Material
70% Polyester, 30% cotton
Machine washable, tumble dry low
",
                'price' => 42.00,
                'colour' => 'blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'StormFlex Performance Hoodie',
                'description' =>
                    "The StormFlex Performance Hoodie is built for versatility and comfort, making it ideal for both active and casual wear.
                     Crafted with a premium, stretch-fit fabric, it provides warmth without restricting movement. The sleek grey design with subtle gradient accents
                     offers a modern, athletic look, while the full-zip closure and adjustable hood ensure maximum adaptability and style.
                    Whether you're hitting the gym, going for a run, or just relaxing, this hoodie delivers performance and style in one package.
Care & Material
68% Polyester, 32% cotton
Machine washable, air dry recommended
",
                'price' => 44.00,
                'colour' => 'grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Vortex Edge Pullover Hoodie',
                'description' =>
                    "The Vortex Edge Pullover Hoodie is designed for those who want to stand out while staying comfortable. Featuring a bold geometric design with striking neon green accents,
                     this hoodie offers a modern and futuristic look. The soft fleece lining provides warmth and comfort, while the relaxed fit ensures all-day wearability.
                    The adjustable drawstring hood and ribbed cuffs add extra style and functionality, making it perfect for training, casual wear, or street fashion.
Care & Material
60% Cotton, 40% Polyester
Machine washable, air dry recommended
",
                'price' => 46.00,
                'colour' => 'black/white/green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Flux Zip Hoodie',
                'description' =>
                    "The Inferno Flux Zip Hoodie is built for those who demand style and performance. With a striking red-to-black gradient design, this hoodie makes a bold statement
                    while offering premium comfort. The sleek, athletic fit ensures maximum flexibility, while the soft fleece interior provides warmth without bulk. Featuring a full-zip closure,
                     adjustable hood, and ribbed cuffs, this hoodie is perfect for training, outdoor adventures, or casual wear.
Care & Material
65% Polyester, 35% Cotton
Machine washable, air dry recommended
",
                'price' => 48.00,
                'colour' => 'red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'HyperEdge Running Shoes',
                'description' =>
                    "The HyperEdge Running Shoes are designed for next-level performance with a futuristic aesthetic. Featuring a breathable mesh upper, these shoes ensure
                     maximum airflow and comfort during long runs or high-intensity workouts. The advanced cushioned sole provides shock absorption and superior traction,
                      making it perfect for sports, training, and casual wear.
                    The bold blue, black, and neon green colorway adds a high-energy, modern look that stands out.
Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth

",
                'price' => 75.00,
                'colour' => 'blue/black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Sprint Running Shoes',
                'description' =>
                    "The Inferno Sprint Running Shoes are built for speed, endurance, and style. Designed with a breathable mesh upper, these shoes provide maximum ventilation while
                    maintaining durability. The shock-absorbing cushioned sole ensures optimal traction and comfort for high-intensity training and running.
                    Featuring a bold black and red colorway, these shoes deliver a futuristic, aggressive look that’s perfect for athletes and sneaker enthusiasts alike.
Care & Material
Breathable performance mesh
Wipe clean with a damp cloth

",
                'price' => 78.00,
                'colour' => 'red/black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Eclipse Runner Sneakers',
                'description' =>
                    "The Eclipse Runner Sneakers offer a sleek and minimalist design with high-performance comfort. The breathable mesh upper ensures ventilation
                     and lightweight support, while the cushioned sole provides shock absorption and stability. Designed in a sophisticated white and grey colourway,
                    these sneakers are versatile for sports, running, or casual wear. The streamlined aesthetic makes them a perfect blend of style and functionality.
Care & Material
Lightweight, breathable mesh
Wipe clean with a damp cloth

",
                'price' => 72.00,
                'colour' => 'grey/white',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'BlazeStorm Running Shoes',
                'description' =>
                    "The BlazeStorm Running Shoes are built for speed, agility, and endurance. Featuring a breathable mesh upper, these shoes provide lightweight support
                    and ventilation for maximum performance. The high-traction cushioned outsole ensures superior grip and comfort, making them ideal for running, gym workouts, and casual wear.
                    The black and orange color scheme gives these shoes a bold, fiery aesthetic, perfect for those who want to stand out.
Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth

",
                'price' => 76.00,
                'colour' => 'black/orange',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'TitanFlow Running Shoes',
                'description' =>
                    "The TitanFlow Running Shoes combine style, comfort, and high performance. Featuring a breathable mesh upper,
                    these shoes provide lightweight support and airflow, ensuring maximum comfort during workouts or everyday wear. The cushioned sole
                    absorbs impact for optimal traction and stability, making them ideal for running, training, and long-distance walking.
                    The navy blue and silver color scheme adds a sleek and versatile aesthetic, perfect for any occasion.
Care & Material
Mesh Upper with Rubber Sole
Wipe clean with a damp cloth

",
                'price' => 74.00,
                'colour' => 'blue/black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'ShadowFlex Performance Joggers',
                'description' =>
                    "The ShadowFlex Performance Joggers are crafted for comfort, mobility, and a modern athletic look. Designed with a tapered slim fit,
                    these joggers offer flexibility and style for both workouts and casual wear. The elastic waistband with adjustable drawstrings provides
                    a secure and customizable fit, while the zippered side pockets offer convenience and security for essentials.
                    The lightweight, breathable fabric ensures all-day comfort, making them perfect for training, running, or everyday use.
Care & Material
85% Polyester, 15% Spandex
Machine washable, cold wash recommended

",
                'price' => 50.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Midnight Core Joggers',
                'description' =>
                    "The Midnight Core Joggers are designed for comfort, performance, and a classic athletic look. Featuring a relaxed fit with tapered legs,
                     they offer maximum flexibility for both workouts and everyday wear. The elastic waistband with adjustable drawstrings ensures a secure and
                     customizable fit, while the zippered side pockets provide secure storage for essentials.
                     Crafted from soft, breathable fabric, these joggers deliver all-day comfort with a modern touch.
Care & Material
80% Cotton, 20% Polyester
Machine washable, tumble dry low

",
                'price' => 48.00,
                'colour' => 'navy blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Titan Motion Joggers',
                'description' =>
                    "The Titan Motion Joggers are designed for athletic performance and streetwear appeal. Featuring a slim tapered fit, these
                    joggers provide a modern and stylish look while maintaining maximum comfort. The moisture-wicking fabric ensures breathability and flexibility,
                     making them ideal for gym workouts, running, or casual wear. The black side panel accents add a sleek, sporty touch, while the zippered pockets
                    provide secure storage for essentials.
Care & Material
78% Polyester, 22% Cotton
Machine washable, tumble dry low

",
                'price' => 52.00,
                'colour' => 'dark grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'AeroFlex Utility Joggers',
                'description' =>
                    "The AeroFlex Utility Joggers offer a sleek and functional design, perfect for active and casual lifestyles. Made from soft stretch fabric, these joggers
                    provide unmatched comfort and flexibility. The elastic waistband with adjustable drawstrings ensures a secure fit, while the zippered side pockets and
                    cargo-style detail add practical storage options. With a light grey base and black accents, these joggers bring a modern and versatile aesthetic to any outfit.
Care & Material
75% Polyester, 25% Cotton
Machine washable, cold wash recommended

",
                'price' => 54.00,
                'colour' => 'light grey',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'AeroFlex Utility Joggers',
                'description' =>
                    "The Crimson Velocity Joggers bring together bold style and athletic functionality. Featuring a slim tapered fit, these joggers provide optimal flexibility and comfort.
                    The elastic waistband with drawstrings allows for a custom fit, while the zippered pockets offer secure storage for essentials. Designed with breathable fabric,
                    they ensure all-day comfort, making them ideal for training, running, or casual wear.
                    The deep red with black accents adds a striking and modern aesthetic to any outfit.
Care & Material
80% Polyester, 20% Spandex
Machine washable, air dry recommended

",
                'price' => 54.00,
                'colour' => 'red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Shadow Elite Performance Jacket',
                'description' =>
                    "The Shadow Elite Performance Jacket is designed for athletes and style-conscious individuals. Featuring a slim fit and a high-collar design,
                    this jacket provides a modern and dynamic look while ensuring maximum comfort and mobility. The full-zip front and zippered side pockets offer
                     convenience and functionality, making it ideal for training, outdoor workouts, or casual wear. The lightweight, breathable fabric allows
                     for all-weather adaptability, keeping you comfortable in any setting.
Care & Material
90% Polyester, 10% Spandex
Machine washable, air dry recommended

",
                'price' => 65.00,
                'colour' => 'black',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Midnight Apex Training Jacket',
                'description' =>
                    "The Midnight Apex Training Jacket blends performance and modern style with its sleek, slim-fit design. Crafted from soft and breathable fabric,
                    it provides all-day comfort and flexibility for workouts, outdoor activities, or casual wear. The full-zip front, high collar, and zippered pockets
                     add functionality and convenience,  making it perfect for layering or wearing solo. The navy blue with subtle white accents delivers a classic,
                     versatile aesthetic.
Care & Material
85% Polyester, 15% Spandex
Machine washable, cold wash recommended

",
                'price' => 68.00,
                'colour' => 'black/blue',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Bomber Jacket',
                'description' =>
                    "The Inferno Bomber Jacket combines modern style with functional warmth, making it perfect for training, casual wear, or layering in colder weather.
                    Designed with a relaxed fit, this jacket features a ribbed collar, cuffs, and hem for a snug and comfortable feel. The full-zip front and zippered side
                    pockets offer convenience and practicality, while the insulated fabric ensures warmth without bulk. The deep red and black colour scheme gives a bold,
                     athletic look with a touch of streetwear edge.
Care & Material
85% Polyester, 15% Cotton
Machine washable, tumble dry low

",
                'price' => 75.00,
                'colour' => 'black/red',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'StormGuard Windbreaker Jacket',
                'description' =>
                    "The StormGuard Windbreaker Jacket is built for athletes and outdoor enthusiasts who need lightweight protection from the elements.
                     Made with water-resistant and breathable fabric, this jacket keeps you dry and comfortable in unpredictable weather. The adjustable hood,
                     full-zip front, and zippered side pockets provide functionality and convenience, while the relaxed fit ensures easy movement.
                    The sleek white and black colour scheme gives it a modern and versatile look, perfect for training, running, or casual wear.
Care & Material
100% Polyester (Water-Resistant)
Machine washable, air dry recommended

",
                'price' => 72.00,
                'colour' => 'black/white',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Arctic Shield Puffer Jacket',
                'description' =>
                    "The Arctic Shield Puffer Jacket is built for extreme warmth and modern style. Designed with insulated padding and a quilted design, this jacket provides maximum
                    heat retention while remaining lightweight and comfortable. The high collar and full-zip front offer extra protection against the cold, while the zippered side pockets
                    provide secure storage. Crafted with water-resistant fabric, it ensures protection from wind and light rain, making it perfect for winter wear, outdoor adventures,
                     and everyday use.
Care & Material
100% Polyester (Water-Resistant)
Machine washable, air dry recommended

",
                'price' => 85.00,
                'colour' => 'green',
                'mens' => true,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Velocity Performance T-Shirt',
                'description' =>
                    "The Velocity Women's Performance T-Shirt is designed for active lifestyles, offering breathability, comfort, and a sleek fit.
                    The moisture-wicking fabric keeps you cool and dry, while the slim-fit design with a subtle scoop neckline ensures a flattering, modern silhouette.
                    The curved hem adds style and extra coverage, making this t-shirt perfect for workouts, running, or casual wear.
Care & Material
90% Polyester, 10% Spandex
Machine washable, tumble dry low

",
                'price' => 30.00,
                'colour' => 'black/grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Nova Training T-Shirt',
                'description' =>
                    "The Nova Women's Training T-Shirt is designed for performance and versatility. Featuring moisture-wicking fabric, it keeps you cool and dry during
                    workouts or casual wear. The slim-fit design, scoop neckline, and curved hem create a flattering silhouette, while the lightweight, breathable material allows for
                     maximum comfort and movement. The navy blue with white accents offers a classic and timeless look.
Care & Material
92% Polyester, 8% Spandex
Machine washable, air dry recommended

",
                'price' => 28.00,
                'colour' => 'blue/grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Blaze Active T-Shirt',
                'description' =>
                    "The Blaze Women's Active T-Shirt is designed for high-energy workouts and everyday comfort. Made with moisture-wicking, breathable fabric,
                    it keeps you cool and dry throughout the day. The slim-fit cut, scoop neckline, and curved hem provide a flattering and comfortable fit,
                     while the bold deep red and black accents add a dynamic, stylish touch. Perfect for training, running, or casual wear.
Care & Material
88% Polyester, 12% Spandex
Machine washable, tumble dry low

",
                'price' => 28.00,
                'colour' => 'red/black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Serenity Training T-Shirt',
                'description' =>
                    "The Serenity Women's Training T-Shirt offers a soft and elegant take on activewear. Designed with breathable, moisture-wicking fabric,
                    it keeps you cool and comfortable during workouts or casual outings. The slim-fit silhouette, scoop neckline, and curved hem provide a flattering, feminine look,
                     while the white and pastel pink colour scheme adds a fresh and stylish aesthetic. Perfect for yoga, running, or everyday wear.
Care & Material
88% Polyester, 12% Spandex
Machine washable, tumble dry low

",
                'price' => 27.00,
                'colour' => 'white/pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Titan Crop Top',
                'description' =>
                    "The Titan Women's Crop Top is a bold and sporty choice for those who want style and functionality in their activewear. Made with breathable, moisture-wicking fabric,
                    it keeps you cool and dry during workouts. The slim-fit cut, round neckline, and cropped length create a modern and flattering silhouette, while the dark green and black
                    colour scheme adds a powerful and athletic touch. Perfect for gym sessions, running, or casual streetwear looks.
Care & Material
88% Polyester, 12% Spandex
Machine washable, air dry recommended

",
                'price' => 32.00,
                'colour' => 'black/green',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shirts')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'ShadowFlex Performance Hoodie',
                'description' =>
                    "The ShadowFlex Women's Performance Hoodie is designed for athletes and active lifestyles, offering a sleek, slim fit with breathable comfort.
                    The moisture-wicking fabric keeps you dry and comfortable, while the drawstring hood and curved hem provide a flattering and versatile look.
                    The long sleeves offer extra coverage, making it perfect for workouts, running, or layering for casual wear.
Care & Material
90% Polyester, 10% Spandex
Machine washable, air dry recommended

",
                'price' => 55.00,
                'colour' => 'black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'BlushWave Cropped Hoodie',
                'description' =>
                    "The BlushWave Women's Cropped Hoodie offers a modern and stylish take on casual athletic wear. Designed with a relaxed fit and slightly cropped length, this hoodie provides
                    a trendy and flattering silhouette. The soft, breathable fabric ensures all-day comfort, while the adjustable drawstring hood adds functionality. Perfect for layering, workouts,
                    or everyday casual wear, the pastel pink and white color scheme adds a chic and feminine touch.
Care & Material
80% Cotton, 20% Polyester
Machine washable, cold wash recommended

",
                'price' => 50.00,
                'colour' => 'pink/white',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Nova Zip-Up Hoodie',
                'description' =>
                    "The Nova Women's Zip-Up Hoodie is designed for athletic performance and casual versatility. Featuring a slim fit with a full-zip front, it offers comfort and
                    flexibility for everyday wear. The lightweight, breathable fabric keeps you cool and comfortable, while the zippered side pockets provide secure storage for
                    small essentials.The adjustable drawstring hood ensures extra coverage and protection, making it perfect for layering during workouts or outdoor activities.
                    The navy blue and white color scheme adds a classic and stylish touch.
Care & Material
85% Polyester, 15% Spandex
Machine washable, tumble dry low

",
                'price' => 58.00,
                'colour' => 'blue/white',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'CloudComfort Oversized Hoodie',
                'description' =>
                    "The CloudComfort Oversized Hoodie is perfect for effortless streetwear style and cozy comfort. Featuring a relaxed fit with a large drawstring hood, this hoodie
                     provides a laid-back yet trendy aesthetic. The soft fleece fabric ensures maximum warmth and softness, while the ribbed cuffs and hem offer a secure fit.
                    The front kangaroo pocket adds functionality, making it an ideal choice for lounging, casual wear, or layering in colder weather.
                    The light grey with subtle black accents delivers a minimalist, versatile look.
Care & Material
85% Polyester, 15% Spandex
Machine washable, tumble dry low

",
                'price' => 60.00,
                'colour' => 'grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Pullover Hoodie',
                'description' =>
                    "The Inferno Women's Pullover Hoodie is built for athletic performance and everyday wear, offering a sleek, slim fit with a high-collar hood for extra protection.
                    Made with stretchable, breathable fabric, it ensures flexibility and comfort, whether you're training or lounging. The ribbed cuffs and hem provide a secure fit,
                    while the front kangaroo pocket offers functionality and warmth. The deep red and black color scheme gives it a bold and sporty look, making it a must-have for
                     active and casual wardrobes.
Care & Material
85% Polyester, 15% Spandex
Machine washable, tumble dry low

",
                'price' => 58.00,
                'colour' => 'red/black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Hoodies')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'NovaStride Running Trainers',
                'description' =>
                    "The NovaStride Women's Running Trainers combine performance, comfort, and modern design. Featuring a breathable mesh upper, these trainers keep your feet cool and ventilated,
                    while the cushioned sole offers shock absorption and superior support for running and training. The lightweight yet durable construction ensures all-day comfort, making them
                    perfect for workouts,jogging, or everyday wear. The black and white color scheme delivers a sleek and versatile aesthetic.
Care & Material
Breathable mesh with reinforced overlays
Wipe clean with a damp cloth

",
                'price' => 75.00,
                'colour' => 'black/white',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'BlushStride  Running Trainers',
                'description' =>
                    "The BlushStride Women's Running Trainers blend performance and feminine style, making them perfect for both fitness and casual wear. Featuring a breathable mesh upper,
                     these trainers keep your feet cool and fresh during workouts. The cushioned sole provides shock absorption and support, ensuring all-day comfort. With a sleek, lightweight build,
                      they are ideal for running, gym sessions, or everyday walking. The pastel pink and white colour scheme adds a soft yet trendy aesthetic.
Care & Material
Breathable mesh with reinforced overlays
Wipe clean with a damp cloth

",
                'price' => 72.00,
                'colour' => 'pink/white',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Sprint Trainers',
                'description' =>
                    "The Inferno Sprint Women's Trainers are designed for high-performance workouts and bold style. With a breathable mesh upper, they keep your feet cool and ventilated even
                    during intense sessions. The cushioned sole absorbs impact, providing superior comfort and support for running, gym training, or all-day wear.
                    The deep red and black color scheme adds a striking, athletic edge, making them a standout choice for any active wardrobe.
Care & Material
Breathable mesh with reinforced overlays
Wipe clean with a damp cloth

",
                'price' => 78.00,
                'colour' => 'red/black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'TitanFlow Running Trainers',
                'description' =>
                    "The TitanFlow Women's Running Trainers offer a sleek, high-performance design for comfort and durability. Featuring a breathable mesh upper, these trainers ensure maximum
                    ventilation while keeping your feet supported and comfortable. The cushioned sole absorbs impact, making them perfect for running, gym workouts, or all-day wear.
                    The navy blue and silver color scheme adds a modern, stylish edge, perfect for both sports and casual outfits.
Care & Material
Breathable mesh with reinforced overlays
Wipe clean with a damp cloth

",
                'price' => 76.00,
                'colour' => 'blue/white',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),


            new Product ([
                'name' => 'CloudFlex Casual Sneakers',
                'description' =>
                    "The CloudFlex Women's Casual Sneakers offer a versatile, trendy design that’s perfect for everyday wear. With a sleek, low-top silhouette, these sneakers feature a
                    breathable knit upper that provides lightweight comfort and flexibility. The cushioned sole ensures all-day support, making them ideal for long walks, casual outings,
                     or daily activities. The white and light grey colour scheme adds a minimalist and modern touch, making them easy to pair with any outfit.
Care & Material
Breathable knit fabric
Wipe clean with a damp cloth

",
                'price' => 70.00,
                'colour' => 'grey/white',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Shoes')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'LunaFlex High-Waisted Joggers',
                'description' =>
                    "The LunaFlex Women's High-Waisted Joggers offer comfort, performance, and a feminine edge. Designed with a slim, tapered fit, these joggers contour the body while
                    providing freedom of movement. The high-waisted elastic waistband with drawstrings ensures a secure and flattering fit, while the zippered side pockets add functionality.
                    Crafted from lightweight, breathable fabric, they are perfect for workouts, running, or casual wear.The black base with subtle pink accents adds a sleek yet stylish touch.
Care & Material
80% Polyester, 20% Spandex
Machine washable, cold wash recommended

",
                'price' => 54.00,
                'colour' => 'black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'RoseWave Joggers',
                'description' =>
                    "The RoseWave Women's Joggers offer a chic and feminine twist on classic athletic wear. Designed with a high-waisted fit and slim, tapered legs, these joggers provide both comfort
                    and style. The soft, breathable fabric ensures all-day wearability, while the zippered side pockets add functionality without bulk. The pastel pink and white color scheme brings a
                    trendy, modern aesthetic, making these joggers perfect for gym sessions, casual outings, or lounging in style.
Care & Material
85% Cotton, 15% Polyester
Machine washable, cold wash recommended

",
                'price' => 50.00,
                'colour' => 'pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'SkyFlow Flared Pants',
                'description' =>
                    "The SkyFlow Women's Flared Pants bring together comfort, flexibility, and a stylish silhouette. Designed with a high-waisted fit and flared leg design, these pants create a modern,
                     flattering look while providing ease of movement. The soft, stretchable fabric ensures all-day comfort, making them perfect for yoga, lounging, or casual wear.
                     The navy blue and white colour combination offers a timeless and versatile aesthetic.
Care & Material
80% Polyester, 20% Spandex
Machine washable, cold wash recommended

",
                'price' => 50.00,
                'colour' => 'blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),


            new Product ([
                'name' => 'CloudEase Wide-Leg Pants',
                'description' =>
                    "The CloudEase Women's Wide-Leg Pants offer a relaxed yet stylish design, perfect for both active and casual wear. Featuring a high-waisted fit with an elastic
                    waistband and drawstrings, these pants provide a secure and adjustable fit. The soft, breathable fabric ensures all-day comfort, while the wide-leg cut adds a modern
                    and effortless touch. The light grey with subtle black accents creates a minimalist, versatile look, making them ideal for lounging, yoga, or everyday styling.
Care & Material
85% Cotton, 15% Polyester
Machine washable, cold wash recommended

",
                'price' => 53.00,
                'colour' => 'grey',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Eclipse Performance Jacket',
                'description' =>
                    "The Eclipse Women's Performance Jacket is designed for athletic performance and sleek casual wear. Featuring a slim-fit silhouette, high collar, and full-zip front,
                    this jacket delivers a modern and versatile look. Made with lightweight, breathable fabric, it ensures all-day comfort and flexibility, whether you're training, traveling,
                    or layering for cooler weather. The zippered side pockets add secure storage for small essentials, while the black and gray color scheme keeps it stylish and timeless.
Care & Material
85% Cotton, 15% Spandex
Machine washable, tumble dry low

",
                'price' => 65.00,
                'colour' => 'black',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'BlushCore Cropped Puffer Jacket',
                'description' =>
                    "The BlushCore Women's Cropped Puffer Jacket offers fashion-forward warmth, perfect for layering in colder weather. Designed with a cropped fit, high collar, and full-zip front,
                    this jacket keeps you cozy while maintaining a sleek, trendy look. The elasticized cuffs provide a snug fit, while the lightweight insulated fabric ensures warmth without bulk.
                    The pastel pink and white color scheme adds a chic, modern touch, making it ideal for everyday styling.
Care & Material
100% Polyester (Insulated)
Machine washable, air dry recommended

",
                'price' => 78.00,
                'colour' => 'pink',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'StormRush Windbreaker',
                'description' =>
                    "The StormRush Women's Windbreaker is built for performance and everyday versatility. Made from lightweight, water-resistant fabric, this jacket provides protection against wind
                    and light rain while maintaining breathability. The zip-up front, high collar, and adjustable hood offer customized coverage, while the zippered side pockets ensure secure storage
                     for essentials. The navy blue and white colour combination adds a bold, athletic touch, making it perfect for outdoor workouts, running, or casual wear.
Care & Material
100% Polyester (Insulated)
Machine washable, air dry recommended

",
                'price' => 68.00,
                'colour' => 'blue',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Inferno Fleece Jacket',
                'description' =>
                    "The Inferno Women's Fleece Jacket is designed for athletes and adventurers who need warmth and performance in one sleek package. Featuring a slim fit with a full-zip front and
                    high collar, this jacket provides insulation while remaining breathable. The soft fleece-lined fabric ensures cozy comfort in colder temperatures, while the zippered side pockets
                     offer secure storage for essentials. The deep red and black color scheme adds a bold and sporty aesthetic, perfect for training, outdoor activities, or casual wear.
Care & Material
85% Polyester, 15% Fleece-Lined Cotton
Machine washable, tumble dry low

",
                'price' => 72.00,
                'colour' => 'black/red',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'Terra Quilted Jacket',
                'description' =>
                    "The Terra Women's Quilted Jacket is designed for style, warmth, and everyday versatility. Featuring a fitted silhouette with a high collar, this jacket provides a chic and modern
                    look while ensuring lightweight warmth. The snap-button front closure offers easy layering, while the zippered side pockets provide secure storage for essentials.
                     The insulated quilted fabric delivers cozy comfort without bulk, making it ideal for cool-weather outings, casual wear, or layering over activewear.
                     The olive green with subtle black accents adds a stylish and nature-inspired touch.
Care & Material
100% Polyester (Quilted Insulation)
Machine washable, air dry recommended

",
                'price' => 80.00,
                'colour' => 'green',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Jackets')->first()->id,
                'stock' => rand(1, 50)
            ]),

            new Product ([
                'name' => 'TerraFlex Cargo Joggers',
                'description' =>
                    "The TerraFlex Women's Cargo Joggers combine functionality, comfort, and effortless style. Designed with a high-waisted fit and relaxed silhouette, these joggers provide ultimate
                     comfort for both active and casual wear. The elastic waistband with drawstrings ensures a customizable fit, while the multiple cargo pockets offer practical storage for small
                     essentials. The soft, breathable fabric makes them perfect for lounging, workouts, or streetwear-inspired outfits. The beige with subtle brown accents delivers a versatile and modern aesthetic.
Care & Material
80% Cotton, 20% Polyester
Machine washable, cold wash recommended

",
                'price' => 80.00,
                'colour' => 'beige',
                'mens' => false,
                'category_id' => Category::all()->where('name', 'Trousers')->first()->id,
                'stock' => rand(1, 50)
            ])
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
            ]),
            new ProductImage([
                'product_id' => 51,
                'image_name' => '6ff10a96-b0f7-48e7-8d00-945fff5bf96d.jpg'
            ]),
            new ProductImage([
                'product_id' => 52,
                'image_name' => '33f96b0a-3b53-422e-8bfe-06f0ec1b813e.jpg'
            ]),
            new ProductImage([
                'product_id' => 53,
                'image_name' => '6dd49b17-380c-4990-95ad-99b46479ded2.jpg'
            ]),
            new ProductImage([
                'product_id' => 54,
                'image_name' => '326050fd-1dd4-4e2c-b19b-e318c621346d.jpg'
            ]),
            new ProductImage([
                'product_id' => 55,
                'image_name' => '1aed8946-d205-452f-93d7-6f7fc3e58911.jpg'
            ]),
            new ProductImage([
                'product_id' => 56,
                'image_name' => '460e954a-bc4f-4572-a4fd-6c91216d57d4.jpg'
            ]),
            new ProductImage([
                'product_id' => 57,
                'image_name' => 'f205856d-b511-478d-9966-ea2448ecabe7.jpg'
            ]),
            new ProductImage([
                'product_id' => 58,
                'image_name' => '5a142be6-ff15-429d-b891-7cf6cf774078.jpg'
            ]),
            new ProductImage([
                'product_id' => 59,
                'image_name' => '4ef51ed4-22a8-478b-94f4-9487c0e8077d.jpg'
            ]),
            new ProductImage([
                'product_id' => 60,
                'image_name' => '625ebf56-118f-4c60-9031-4571094c02c7.jpg'
            ]),
            new ProductImage([
                'product_id' => 61,
                'image_name' => 'f7121676-c500-4832-abea-8c11d1c23c75.jpg'
            ]),
            new ProductImage([
                'product_id' => 62,
                'image_name' => 'a8c2e3f6-7bfb-4b73-ab83-88912a164dd4.jpg'
            ]),
            new ProductImage([
                'product_id' => 63,
                'image_name' => 'b854f2c9-b697-4685-9ff1-f02bf1425536.jpg'
            ]),
            new ProductImage([
                'product_id' => 64,
                'image_name' => '9527967f-f35a-4493-8081-31450f574dc0.jpg'
            ]),
            new ProductImage([
                'product_id' => 65,
                'image_name' => '76de743e-7b10-4862-a72b-cbeabfddb8c3.jpg'
            ]),
            new ProductImage([
                'product_id' => 66,
                'image_name' => '08ad6b70-26dd-44c4-a0ec-81d183fa4c99.jpg'
            ]),
            new ProductImage([
                'product_id' => 67,
                'image_name' => 'e6d7198c-b092-434a-bd21-8aaba3b93288.jpg'
            ]),
            new ProductImage([
                'product_id' => 68,
                'image_name' => 'f4eecb51-8af5-469b-a20d-fdc38b32f8cf.jpg'
            ]),
            new ProductImage([
                'product_id' => 69,
                'image_name' => 'f5552fd6-f10e-4c35-848a-a2ec6edc12ba.jpg'
            ]),
            new ProductImage([
                'product_id' => 70,
                'image_name' => 'e524be92-f73e-444c-b1b6-e01f16ca99ff.jpg'
            ]),
            new ProductImage([
                'product_id' => 71,
                'image_name' => 'd948015b-3912-4efe-9134-36c4f64670c3.jpg'
            ]),
            new ProductImage([
                'product_id' => 72,
                'image_name' => 'd871a3cb-0bc3-47d9-b257-501df2ca6c46.jpg'
            ]),
            new ProductImage([
                'product_id' => 73,
                'image_name' => '61773a18-03ba-4a3d-8575-d977fbfdd902.jpg'
            ]),
            new ProductImage([
                'product_id' => 74,
                'image_name' => '31e35f98-2166-4821-927b-ed16a3d116a0.jpg'
            ]),
            new ProductImage([
                'product_id' => 75,
                'image_name' => 'a94351fe-7ed5-41d9-8bb0-129020c4285e.jpg'
            ]),
            new ProductImage([
                'product_id' => 76,
                'image_name' => '2300f6bc-5370-405f-afe2-0c485bf8a7fd.jpg'
            ]),
            new ProductImage([
                'product_id' => 77,
                'image_name' => '24e355c0-9d39-4961-9816-6002c0ce83bf.jpg'
            ]),
            new ProductImage([
                'product_id' => 78,
                'image_name' => '1b09408b-2d80-421a-9ad0-a56ebb0178db.jpg'
            ]),
            new ProductImage([
                'product_id' => 79,
                'image_name' => '737380c3-d934-4213-84c7-260586ba779b.jpg'
            ]),
            new ProductImage([
                'product_id' => 80,
                'image_name' => 'c6a6dbc7-8012-4faa-af63-0cc52bf417f6.jpg'
            ]),
            new ProductImage([
                'product_id' => 81,
                'image_name' => '68d3ea47-87c0-49de-8bd6-97d67db4cb32.jpg'
            ]),
            new ProductImage([
                'product_id' => 82,
                'image_name' => '3e0552be-fe22-4f07-8708-67523a8a6eda.jpg'
            ]),
            new ProductImage([
                'product_id' => 83,
                'image_name' => '65448570-ac98-4dcb-96d5-e71dbcaecf20.jpg'
            ]),
            new ProductImage([
                'product_id' => 84,
                'image_name' => '37047713-0d20-4c22-8f1e-1d2a69c75b27.jpg'
            ]),
            new ProductImage([
                'product_id' => 85,
                'image_name' => 'e243083a-c841-47eb-b24e-1be5b0e8285c.jpg'
            ]),
            new ProductImage([
                'product_id' => 86,
                'image_name' => 'b0b67d6b-41b6-44ae-9708-9f7f856ee55c.jpg'
            ]),
            new ProductImage([
                'product_id' => 87,
                'image_name' => '94b089a0-04e4-4409-9a3f-91899017e45b.jpg'
            ]),
            new ProductImage([
                'product_id' => 88,
                'image_name' => '78dd974d-7dd2-438a-a320-918e13a37dff.jpg'
            ]),
            new ProductImage([
                'product_id' => 89,
                'image_name' => '90454c20-27c8-49b4-83d7-3e14a7222c06.jpg'
            ]),
            new ProductImage([
                'product_id' => 90,
                'image_name' => '265e626c-8258-4199-8451-a836b0647019.jpg'
            ]),
            new ProductImage([
                'product_id' => 91,
                'image_name' => '70c120c8-22cd-4b57-ba0c-58cd0aa5e8a8.jpg'
            ]),
            new ProductImage([
                'product_id' => 92,
                'image_name' => 'fb84940a-8c12-4592-8066-3551491daff8.jpg'
            ]),
            new ProductImage([
                'product_id' => 93,
                'image_name' => '284483d3-fd49-40fc-9adc-d9c6b5d733ad.jpg'
            ]),
            new ProductImage([
                'product_id' => 94,
                'image_name' => '66100771-1481-4f0b-9288-91ec5c2ddbb5.jpg'
            ]),
            new ProductImage([
                'product_id' => 95,
                'image_name' => '59b34289-dc1d-46ba-a719-67df9d3eca83.jpg'
            ]),
            new ProductImage([
                'product_id' => 96,
                'image_name' => 'd9661941-0dd0-4497-9158-f6db61c96b43.jpg'
            ]),
            new ProductImage([
                'product_id' => 97,
                'image_name' => 'f71c53dc-efff-41bd-8c94-6ca8c8b0a40a.jpg'
            ]),
            new ProductImage([
                'product_id' => 98,
                'image_name' => '41ec2749-a8af-4982-ae30-22ac7805fb25.jpg'
            ]),
            new ProductImage([
                'product_id' => 99,
                'image_name' => 'e9be203e-3655-49d4-a2fb-b1245704c2dc.jpg'
            ]),
            new ProductImage([
                'product_id' => 100,
                'image_name' => '49320394-0994-4ad4-ba39-11677c40549c.jpg'
            ])
        ];
        foreach ($images as $image) {
            $image->save();
        }
    }

    // Create a test account
    private function testAccount(): void
    {
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'test@account.com',
            'password' => Hash::make('password'),
            'phone_number' => '+447111111111',
            'home_address' => 'Test home address',
            'postcode' => '',
            'role' => 'admin'
        ]);
        $user->save();
    }

    // this makes a load of random orders for each product over the recent period (might take a while to run)
    private function addOrders(): void
    {
        // get all the products
        $products = Product::all();
        // get a user to assign to the orders
        $user = User::all()->first();
        // iterate through all the products
        foreach ($products as $product) {
            // create orders for each day for the last few days
            for ($day = now(); $day->gt(now()->subDays(16)); $day->subDays(1)) {
                $quantity = rand(0, 3);
                // prevent the creation of zero orders
                if ($quantity == 0) {
                    continue;
                }
                // create the shipping item
                $shipping = Shipping::create([
                    'shipping_date' => now(),
                    'delivery_date' => null,
                    'home_address' => "test address",
                    'tracking_number' => rand(100000, 999999),
                ]);
                $shipping['created_at'] = $day;
                $shipping->save();
                // create a transaction for the order
                $transaction = Transaction::create([
                    'transaction_amount' => $product->price * $quantity,
                    'transaction_info' => 'purchase',
                    'transaction_status' => 'completed',
                ]);
                $transaction['created_at'] = $day;
                $transaction->save();
                $order = new Order([
                    'user_id' => $user->id,
                    'order_total_price' => $product->price * $quantity,
                    'created_at' => $day,
                    'order_status' => 'completed',
                    'shipping_id' => $shipping->id,
                    'transaction_id' => $transaction->id
                ]);
                $order['created_at'] = $day;
                $order->save();
                $individualOrder = new IndividualOrder([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'size' => 'M',
                    'price' => $product->price
                ]);
                $individualOrder['created_at'] = $day;
                $individualOrder->save();
            }
        }
    }
}
