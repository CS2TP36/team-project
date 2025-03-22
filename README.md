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
- Fill database with predefined data using `php artisan db:seed` (takes quite a while given the amount of data)
- Done (can serve with `php artisan serve` for testing)

## Re-populating the Database
- Rebuild the database `php artisan migrate:refresh`
- Add the data `php artisan db:seed`
- Done

## References and external projects used
- Larapex Charts (Updated fork) - [marineusde/larapex-charts](https://github.com/marineusde/larapex-charts) - Used for generating the stock report graphs in php.
- Normalize css - [necolas/normalize.css](https://github.com/necolas/normalize.css) - Used to improve cross-browser compatibility.
- PicoCSS - [picocss/pico](https://github.com/picocss/pico) - Used for simple styling on the admin pages.
- Laravel - [laravel/laravel](https://github.com/laravel/laravel) - Used as the main framework for the project.
- Mailgun PHP - [mailgun/mailgun-php](https://github.com/mailgun/mailgun-php) - Used for interacting with the Mailgun API using PHP.
- Potentially others required by Laravel can be found in the [composer.json](https://raw.githubusercontent.com/CS2TP36/team-project/refs/heads/main/composer.json) file.
