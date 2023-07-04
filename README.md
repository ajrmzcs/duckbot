Duckbot

Demo App

System Requirement:

Docker
Local PHP 8 and Composer
Installation Steps:

Clone this repository
Create .env file: cp .env.example .env
Install dependencies: composer install
Generate key: php artisan key:generate
Install laravel sail: php artisan sail:install and enter 0 to install mysql
Create development environment: vendor/bin/sail up -d
Run migrations and seeders: vendor/bin/sail artisan migrate
Run command: vendor/bin/sail duck:manage
