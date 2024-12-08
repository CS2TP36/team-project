# CS2TP Team Project
### Team number:  36
Site currently available at https://thesportswear.website/
## About
Team members:
- [Hamad Afzal](https://github.com/LOKI-HGR)
- [Ashfaq Choudhury](https://github.com/AshfaqC)
- [Adeeb Javid](https://github.com/adeeb2024)
- [Muhammad Khan](https://github.com/K3YC0D3)
- [Kacper Krajewski](https://github.com/Kacper69pl)
- [Gautam Mahesh](https://github.com/gm488)
- [Rikesh Patel](https://github.com/rikeshpatel19)
- [Matthew Speake](https://github.com/mspeake161)
- [Shasank Thapa](https://github.com/ShasankThapa)

## Installation
- Install PHP and composer (or use a package like Herd)
- Clone this to a place locally (and know where)
- Copy .env.example to .env to initialise env (don't just rename it that breaks it for everyone else when you push)
- Open a terminal in the root of the cloned folder
- Install required files with `composer install`
- Construct the database with `php artisan migrate` (have to agree to create a database if using sqlite)
- Generate a key with `php artisan key:generate`
- Fill database with predefined data using `php artisan db:seed`
- Done (can serve with `php artisan serve` for testing)

## Re-populating the Database
- Rebuild the database `php artisan migrate:refresh`
- Add the data `php artisan db:seed`
- Done
