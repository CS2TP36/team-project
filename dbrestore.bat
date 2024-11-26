:: A batch file to automate the process of deleting the database, rebuilding it, and then populating it with the predefined data in the seeder.
@ECHO OFF
ECHO Deleting the db file
IF EXIST ".\database\database.sqlite" del ".\database\database.sqlite"
ECHO Reconstructing the database
php artisan migrate --force
ECHO Adding data
php artisan db:seed
