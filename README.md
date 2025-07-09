🚀 Getting Started
Follow these steps to get your INFO-WEB-APP project up and running on your local development environment.

Prerequisites
Before you begin, ensure you have the following installed:

*****[USE THE !!OBERVER!! Branch to clone our project. do not use main the Branch.]*****

PHP: Version 8.1 or higher (as required by Laravel 10/11)

Composer: For PHP dependency management.

Node.js & npm: If you plan to compile frontend assets (though Tailwind CSS is used via CDN in provided examples).

Database: MySQL, PostgreSQL, SQLite, or SQL Server.
____________________________________________________________________________________________________________________
Installation Steps
1. Install PHP Dependencies:
composer install

2. Copy Environment File:
cp .env.example .env

3. Generate Application Key:
php artisan key:generate

4. Configure Database: [.env]
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user  # or 'root' for local development
DB_PASSWORD=your_database_password # leave empty if DB_USERNAME is 'root' and no password is set

5. Run Database Migrations:
php artisan migrate

6. Setup Storage Link:
php artisan storage:link

7. Create Storage Directories (if not automatically created by upload):
mkdir -p public/storage/news_images

📧 Email Configuration (Contact Us Screen)

8. For the "Contact Us" screen to send emails, you'll need to configure your [.env ]
file with SMTP settings. Here's an example using Mailtrap (a common tool for local email testing):

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=2f5902e3625e5b
MAIL_PASSWORD=5322e9ee422a65
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

🧪 Seed Database

9. Install Faker (if not already installed via composer install):
composer require fakerphp/faker --dev

10. Run the Seeder:
php artisan db:seed


▶️ !Running the Application! input this command on your terminal
1. php artisan serve

____________________________________________________________________________________________________________________

*************************************************************************

⚠️ Troubleshooting Storage/Image Issues
If images are not rendering or loading correctly after setup, try these steps:

1. Remove Existing Storage Symlink:
rmdir public\storage

**
(For Git Bash / Linux / macOS)
rm public/storage
**

2. Recreate the Storage Symlink:
php artisan storage:link

⚙️ Configuring PHP.ini (for file uploads)
For larger image uploads, you might need to adjust your PHP configuration (php.ini).

1. Find Your php.ini File:
(Run this command in your terminal to locate the php.ini file that your PHP CLI is using:)
php --ini

2. Check Current Upload Limits:
php -i | findstr upload_max_filesize
php -i | findstr post_max_size

3. Edit php.ini:
Open the identified php.ini file in a text editor and add/modify the following lines to set increased limits (e.g., 50MB for uploads and posts, 128MB for memory):
upload_max_filesize = 50M
post_max_size = 50M
memory_limit = 128M

## clear cached commands
php artisan cache:clear          # Clear application cache
php artisan config:clear         # Clear configuration cache
php artisan route:clear          # Clear route cache
php artisan view:clear           # Clear compiled view files
php artisan optimize:clear       # Clear all caches (config, route, view)
php artisan optimize             # Cache config and routes for optimization

*************************************************************************

▶️ Running the Application
1. php artisan serve

