# INFO-WEB-APP
INTERNSHIP TASK

    REQUIRED to Install after Cloning
1. cp .env.example .env
2. php artisan key:generate
3. change the DB properties in the .env file
4. then  last php artisan migrate

RUN
1. php artisan serve

    REQUIRED to install during production/coding
1. composer require fakerphp/faker --dev
2. php artisan db:seed --class=NewsfeedSeeder
3. php artisan storage:link
