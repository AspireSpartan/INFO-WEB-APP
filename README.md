# INFO-WEB-APP
Setup Commands

    REQUIRED to Install after Cloning (REQUIRED to install during production/coding)
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. change the DB properties in the .env file
5. then  last php artisan migrate
6. mkdir -p public/storage/news
7. composer require fakerphp/faker --dev
8. php artisan db:seed --class=NewsfeedSeeder
9. php artisan storage:link
10. Put these into your .env (This is for the Contact Us Screen)
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=2f5902e3625e5b
MAIL_PASSWORD=5322e9ee422a65
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

after that you can now RUN the app at your localhost
1. php artisan serve

(if images are not rendering or loaded try this command)
1. rmdir public\storage
2. php artisan storage:link


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
