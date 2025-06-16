# INFO-WEB-APP
INTERNSHIP TASK

    REQUIRED to Install after Cloning (REQUIRED to install during production/coding)
1. cp .env.example .env
2. php artisan key:generate
3. change the DB properties in the .env file
4. then  last php artisan migrate
5. mkdir -p public/storage/news
6. composer require fakerphp/faker --dev
7. php artisan db:seed --class=NewsfeedSeeder
8. php artisan storage:link


*Configuring the ini file*
(Use this command on the CMD to find your .ini file)
1. php --ini

(Use these command on the CMD - this is to identify the upload and post max file size)
1. php -i | findstr upload_max_filesize
2. php -i | findstr post_max_size

(Paste these implementation on the .ini file - this is to set the max file size for the uploadn and post including memory limit)
1. upload_max_filesize = 50M
2. post_max_size = 50M
3. memory_limit = 128M

RUN
1. php artisan serve
