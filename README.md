# Car Dealer Website

A modern car dealership website built with Laravel, featuring car listings, bidding system, and admin panel.

## Features

- Car listings with detailed views
- Admin panel for managing cars
- User authentication
- Bidding system
- Responsive design
- Image gallery for cars

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## Installation

1. Clone the repository
```bash
git clone [your-repository-url]
cd car_dealer
```

2. Install PHP dependencies
```bash
composer install
```

3. Install and compile frontend dependencies
```bash
npm install
npm run dev
```

4. Setup environment file
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_dealer
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations and seeders
```bash
php artisan migrate --seed
```

## Admin Access

Default admin credentials:
- Email: admin@example.com
- Password: password

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
