# Admin Panel E-Commerce - Laravel 10

Hệ thống quản trị E-Commerce xây dựng trên Laravel 10 với giao diện theo phong cách [Mazer Template](https://themewagon.github.io/mazer/index.html).

## Tính năng

- **Dashboard**: Thống kê tổng quan (danh mục, sản phẩm, đơn hàng, khách hàng, doanh thu)
- **Quản lý Loại sản phẩm (Categories)**: CRUD đầy đủ
- **Quản lý Sản phẩm (Products)**: CRUD với phân trang, Eager Loading
- **Quản lý Đơn hàng (Orders)**: CRUD với chi tiết đơn hàng (Order Items)
- **Quản lý Khách hàng (Customers)**: CRUD với lịch sử đơn hàng

## Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js >= 16

## Cài đặt

### 1. Clone repository

```bash
git clone <repository-url>
cd research-codex-cli
```

### 2. Cài đặt dependencies

```bash
composer install
```

### 3. Cấu hình môi trường

```bash
cp .env.example .env
php artisan key:generate
```

Cập nhật thông tin database trong file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_admin
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Chạy Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

Dữ liệu mẫu bao gồm:
- 1 Admin (admin@example.com / password)
- 10 Customers
- 5 Categories
- 20 Products
- 15 Orders với Order Items

### 5. Chạy ứng dụng

```bash
php artisan serve
```

Truy cập admin panel: `http://localhost:8000/admin`

## Cấu trúc dự án

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── CategoryController.php
│   │   │       ├── ProductController.php
│   │   │       ├── OrderController.php
│   │   │       └── CustomerController.php
│   │   └── Requests/
│   │       ├── CategoryRequest.php
│   │       ├── ProductRequest.php
│   │       └── OrderRequest.php
│   └── Models/
│       ├── Category.php
│       ├── Product.php
│       ├── Order.php
│       ├── OrderItem.php
│       └── User.php
├── database/
│   ├── factories/
│   │   ├── CategoryFactory.php
│   │   ├── ProductFactory.php
│   │   ├── OrderFactory.php
│   │   ├── OrderItemFactory.php
│   │   └── UserFactory.php
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_categories_table.php
│   │   ├── 2024_01_01_000002_create_products_table.php
│   │   ├── 2024_01_01_000003_add_columns_to_users_table.php
│   │   ├── 2024_01_01_000004_create_orders_table.php
│   │   └── 2024_01_01_000005_create_order_items_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       └── admin/
│           ├── layouts/
│           │   └── app.blade.php
│           ├── dashboard/
│           │   └── index.blade.php
│           ├── categories/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   ├── edit.blade.php
│           │   └── show.blade.php
│           ├── products/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   ├── edit.blade.php
│           │   └── show.blade.php
│           ├── orders/
│           │   ├── index.blade.php
│           │   ├── create.blade.php
│           │   ├── edit.blade.php
│           │   └── show.blade.php
│           └── customers/
│               ├── index.blade.php
│               ├── create.blade.php
│               ├── edit.blade.php
│               └── show.blade.php
└── routes/
    └── web.php
```

## Routes

Tất cả routes admin sử dụng prefix `/admin`:

| Method | URI | Action |
|--------|-----|--------|
| GET | /admin | Dashboard |
| GET | /admin/categories | Danh sách loại SP |
| GET | /admin/categories/create | Form thêm loại SP |
| POST | /admin/categories | Lưu loại SP |
| GET | /admin/categories/{id} | Chi tiết loại SP |
| GET | /admin/categories/{id}/edit | Form sửa loại SP |
| PUT | /admin/categories/{id} | Cập nhật loại SP |
| DELETE | /admin/categories/{id} | Xóa loại SP |
| GET | /admin/products | Danh sách sản phẩm |
| GET | /admin/orders | Danh sách đơn hàng |
| GET | /admin/customers | Danh sách khách hàng |

## Kỹ thuật

- **Eager Loading**: `Product::with('category')`, `Order::with('user')` để tránh N+1 Query
- **Pagination**: `paginate(10)` cho tất cả danh sách
- **Form Requests**: `CategoryRequest`, `ProductRequest`, `OrderRequest` để validate dữ liệu
- **DB Transactions**: Sử dụng `DB::transaction()` khi tạo Order với Order Items
- **PSR-12**: Code tuân thủ chuẩn PSR-12
- **Clean Code**: Phân chia rõ ràng Controllers, Models, Views, Form Requests
