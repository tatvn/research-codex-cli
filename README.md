# Laravel Admin Panel

A small admin panel project built with Laravel 8.x, MySQL, and Mazer UI template.

## Features

- **Authentication**: Login/Logout
- **Dashboard**: Overview with statistics
- **Category Management**: CRUD operations for product categories
- **Product Management**: CRUD operations for products with image upload
- **User Management**: CRUD operations for users with role-based access

## Tech Stack

- **Framework**: Laravel 8.x
- **Database**: MySQL
- **UI Template**: [Mazer](https://themewagon.github.io/mazer/) Admin Dashboard

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd research-codex-cli
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file and configure:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_admin
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations and seed:
```bash
php artisan migrate
php artisan db:seed
```

6. Start the development server:
```bash
php artisan serve
```

## Default Admin Account

- **Email**: admin@example.com
- **Password**: password

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── CategoryController.php
│   │       ├── ProductController.php
│   │       └── UserController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── User.php
│   ├── Category.php
│   └── Product.php
resources/views/
├── layouts/
│   ├── admin.blade.php
│   └── sidebar.blade.php
├── auth/
│   └── login.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── categories/
    ├── products/
    └── users/
public/mazer/assets/    # Mazer UI template assets
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
