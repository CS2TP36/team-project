:: A batch file to automate the process of deleting the database, rebuilding it, and then populating it with the predefined data in the seeder.
@ECHO OFF
ECHO Reconstructing the database
php artisan migrate:refresh
ECHO Adding data
php artisan db:seed
