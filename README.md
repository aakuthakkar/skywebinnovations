# Sky Web Innovations

Business website and marketing platform for **Sky Web Innovations** — a web design and development company.

Built with [Laravel](https://laravel.com), this project powers the public marketing site, a built-in admin dashboard, and a set of free SEO tools.

## What's inside

- **Public site** — services, projects, blog, and a CMS-backed page system
- **Admin dashboard** — manage pages, services, projects, blog posts, inquiries, and settings
- **SEO toolkit** (under `/admin/seo`)
  - Keyword & ranking tracker
  - Backlink monitor with an automated health checker (`/admin/seo/backlinks`)
  - Redirect manager
  - Technical SEO audits
- **Free public tools** (link magnets)
  - Website Cost Calculator — `/website-cost-calculator`
  - Backlink Checker — `/backlink-checker`

## Requirements

- PHP 8.2+
- Composer
- Node.js + npm
- MySQL (or any Laravel-supported database)

## Local setup

```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Then visit `http://127.0.0.1:8000`.

> **Note:** `.env` holds your real credentials and is git-ignored — never commit it. For the optional Backlink Checker's external data, set `SERANKING_API_KEY` in `.env`.

## License

Proprietary — © Sky Web Innovations. All rights reserved.
