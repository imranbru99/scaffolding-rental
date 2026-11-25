# PeakFrame Scaffold Rentals — Scaffolding Rental ERP + AI

Production-ready Laravel 13 + Filament 3 website, ERP, and AI suite for a US scaffolding rental, delivery, and erect SME (Denver / Front Range, CO).

**SEO repo description suggestion:** `Laravel 13 + Filament 3 scaffolding rental ERP with public site, fleet inventory, scheduling, invoices, knowledge base, and AI chatbot for frame and system scaffolds.`

## Features
- 🏗️ Premium public marketing site (hero, services, about, contact, WhatsApp)
- 🧱 Service detail pages for frame, system, rolling, swing stage, shoring, erect
- 📰 Blog / journal with seeded posts
- 📚 Knowledge base (issues, guides, admin manual, troubleshooting)
- 🧾 Filament ERP: customers, jobs, inventory, invoices, payments, appointments
- 👥 Roles: Admin, Manager, Staff
- 📊 Reports dashboard with stats + charts
- ⚙️ Settings page for company profile
- 🤖 Public AI chatbot + admin AI Studio (content, automation, troubleshooting)
- 🌱 Realistic demo seeders and SQLite-ready local demo

## Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js + Tailwind (Filament)
- MySQL or SQLite
- Spatie Laravel Permission
- OpenAI HTTP API with Gemini fallback keys

## Installation
```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Admin panel: `http://localhost:8000/admin`
Public site: `http://localhost:8000`

### Default admin
- Email: `admin@example.com`
- Password: `password`

Optional AI keys in `.env`:
```
OPENAI_API_KEY=
GEMINI_API_KEY=
```

## Screenshots / Visual Dashboard
![Construction scaffolding on site](https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80)

![Workers on elevated structure](https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1200&q=80)

![Steel framing and access systems](https://images.unsplash.com/photo-1590644365607-1c5ac295ecdc?auto=format&fit=crop&w=1200&q=80)

## Live Demo
Placeholder — deploy to your host and update this section with the production URL.

## Brand
**PeakFrame Scaffold Rentals** — steel ink + crane orange + bolt teal palette, Teko + Manrope typography, Denver-based scaffolding rental and erect services.

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |
