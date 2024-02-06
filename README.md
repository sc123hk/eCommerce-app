## Introduction
An eCommerce application.

## Tech Stack
- Laravel

## Environment
```
php artisan --version
Laravel Framework 10.9.0
php -v
PHP 8.2.9
sqlite3 --version
3.40.0
```

## Setup
```
Clone env example file as .env
- php artisan key:generate
- composer install
- php artisan migrate
- php artisan db:seed --class ListingSeeder
Uncomment the line 15-18 in /routes/auth.php to activate the user registration feature
- php artisan serve
Go to localhost:8000/register to create a new account
```

## Development Log

> Version 1.0
- Shopping cart feature but not dynamic (No JS)
- Category filtering
- Emulated purchase feature

> Version 1.1
- User authentication feature added
- Exclusive shopping cart

> Version 1.2
- Order view feature
- Emulated product refund feature

> Version 1.3
- Dynamic Shopping cart
- GUI improvement

> Version 1.4
- Responsive design for all devices

> Version 1.5
- Admin entry (Still in progress)
- Responsive design improvement
- Seeder provided
- Breadcrumb added
- GUI improvement

> Version 1.6
- Request limitation
- GUI improvement