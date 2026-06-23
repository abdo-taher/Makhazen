# Makhazen

Makhazen is a Laravel 10 based multi-vendor commerce platform with web storefront, admin dashboard, vendor panel, and REST APIs for customer and seller mobile apps.

## Highlights

- Multi-role architecture: Admin, Vendor/Seller, Customer, Delivery Man.
- Multi-vendor product and order lifecycle with status tracking and refund flows.
- Built-in POS for Admin and Vendor.
- Wallet, loyalty, coupons, flash deals, featured deals, and most-demanded products.
- Real-time/chat workflows between customer and seller.
- Digital product delivery and OTP verification flow.
- Large payment ecosystem: Stripe, PayPal, Razorpay, SSLCommerz, Flutterwave, Paystack, Paytm, MercadoPago, and more.
- Export/report support (Excel, PDF), barcode generation, and sitemap support.

## Tech Stack

- Backend: PHP 8.1+, Laravel 10
- Auth/API: Laravel Passport, Sanctum
- Frontend tooling: Laravel Mix, Webpack, Vue 2, Bootstrap 4, jQuery
- Data/Storage: MySQL, Redis (optional), S3-compatible storage (optional)
- Important packages: `maatwebsite/excel`, `barryvdh/laravel-dompdf`, `intervention/image`, `spatie/laravel-sitemap`

## Core Capabilities by Layer

### Web (Storefront)

Implemented under `routes/web/routes.php`:

- Product listing, search, filters, compare, reviews, wishlist.
- Cart and checkout stages (details, shipping, payment, review, completion).
- Customer profile, addresses, support tickets, wallet, loyalty, order tracking.
- Shop pages, follow/unfollow seller, seller chat.

### Admin Panel

Implemented under `routes/admin/routes.php`:

- Dashboard and business analytics.
- Product, category, brand, attribute, inventory, and stock limit workflows.
- Orders, refunds, transaction reports, product reports, vendor reports.
- Vendor onboarding/configuration and payout management.
- Promotions: banners, coupons, flash deals, deal-of-the-day, featured deals.
- Settings: payment, mail, SMS, social login, recaptcha, environment, themes.

### Vendor Panel

Implemented under `routes/vendor/routes.php`:

- Vendor authentication and registration.
- Product CRUD, bulk imports, stock updates, barcode views.
- Order management, delivery assignment, invoices, refund handling.
- Vendor-side POS, coupons, shipping methods, and customer communication.

### REST APIs

- Customer-facing API: `routes/rest_api/v1/api.php` (+ v2 variants)
- Seller mobile API: `routes/rest_api/v3/seller.php`

Includes auth flows, product/catalog APIs, cart, checkout/order operations, seller operations, shipping, wallet-related operations, and notifications.

## Project Structure

- `app/` Domain logic (services, repositories, listeners, events, jobs, utils).
- `routes/` Route partitions by surface (`admin`, `vendor`, `web`, `rest_api`).
- `config/` Payment, mail, cache, queue, storage, modules, and platform settings.
- `resources/` Blade views, theme assets, translations.
- `public/` Compiled/static assets and entrypoint.
- `database/` Migrations, seeders, factories.

## Requirements

- PHP 8.1+
- Composer 2+
- Node.js 16+ and npm
- MySQL 8+ (or compatible)
- Extensions: `curl`, `intl`, `json`, `mysqli`, `openssl`, `zip`

## Quick Start (Local)

```bash
git clone <your-repository-url> makhazen
cd makhazen

cp .env.example .env
composer install
npm install

php artisan key:generate
```

1. Update `.env` values (DB, mail, cache, queue, payment keys).
2. Set app name:

```dotenv
APP_NAME="Makhazen"
```

3. Run migrations and seeders (if your deployment requires seed data):

```bash
php artisan migrate --seed
```

4. Build frontend assets:

```bash
npm run dev
# or
npm run prod
```

5. Start the app:

```bash
php artisan serve
```

## Environment Notes

- Default sample values are defined in `.env.example`.
- `config/app.php` uses `APP_NAME` with fallback `Makhazen`.
- Payment provider configs exist in `config/` (`paypal.php`, `sslcommerz.php`, `razor.php`, `paytm.php`, `flutterwave.php`, etc.).

## Build, Test, and Quality

```bash
php artisan test
./vendor/bin/phpunit
./vendor/bin/pint
```

Use the command set that matches your CI/CD standards.

## Deployment Checklist

- Set production-safe `.env` values (`APP_ENV=production`, `APP_DEBUG=false`).
- Configure queue, cache, and session drivers appropriately.
- Configure storage and run `php artisan storage:link` if needed.
- Run migrations on deployment and clear/rebuild caches:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Security

- Never commit real credentials in `.env`.
- Rotate API/payment secrets before production cutover.
- Keep dependencies updated and monitor package advisories.

## 📬 Contact
For any questions or concerns, please contact us at [abdotaher093@gmail.com](mailto:abdotaher093@gmail.com).

## Developed by [عبدالرحمن طاهر](https://abdotaher.me/) — Laravel & Database Developer.

## License

This project is licensed under the MIT License unless your organization policy defines a different license for this repository.
