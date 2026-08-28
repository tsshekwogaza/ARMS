# RentReceipt 

> **Automated Rent Receipt Management System for Landlords in Abuja, Nigeria**

RentReceipt is a tailored property management tool designed for landlords and property managers operating in Abuja (Gwarinpa, Maitama, Wuse, Jabi, etc.). It automates the generation of legally valid, digitally signed PDF receipts and dispatches them directly to tenants via WhatsApp in one click.

---

## Key Features

* **Custom Authentication System**: Built completely from scratch without heavy starter kits for full control and optimization.
* **Property & Unit Management**: Organize properties by location, track occupied vs. vacant units, and maintain lease timelines.
* **1-Click WhatsApp Receipt Dispatch**: Direct PDF receipt delivery to tenant WhatsApp numbers.
* **Digital Landlord Signature Stamp**: Upload an official signature stamp once and automatically apply it to generated PDF receipts.
* **Automated Expiry Alerts**: Background tracking for upcoming rent renewals with tenant notifications.
* **Audit Trail**: Full history of generated receipts, download status, and payment logs.

---

## Tech Stack & Architecture

* **Framework**: [Laravel 13](https://laravel.com/)
* **Language**: PHP 8.3
* **Frontend Template**: Blade Engine, Tailwind CSS (Vite)
* **Database**: MySQL / PostgreSQL
* **PDF Generation**: `barryvdh/laravel-dompdf`
* **Queue / Background Jobs**: Database / Redis queue for PDF processing & dispatch tracking

---

## Database Schema Overview

The core database relationship model consists of five main tables:

[Users / Landlords]
│
├───> [Properties]
│         │
│         └───> [Units] ───> [Tenants]
│                               │
└───────────────────────────────┴───> [Receipts]

* **`users`**: Stores landlord profile data, company name, and encrypted signature stamp path.
* **`properties`**: Physical estates/buildings with Abuja district tags (e.g., *Gwarinpa Estate*).
* **`units`**: Individual flats/apartments tied to a property with base rent fees.
* **`tenants`**: Active tenant profiles including WhatsApp phone numbers formatted for international routing (`+234...`).
* **`receipts`**: Issued receipt history containing unique receipt numbers, payment methods, dates, and generated PDF file paths.

---

## Getting Started

### Prerequisites

Ensure your development environment meets the following requirements:

* **PHP** >= 8.3 with PDO, OpenSSL, and Mbstring extensions.
* **Composer** >= 2.x
* **MySQL** >= 8.0 or **PostgreSQL**
* **Node.js** & **NPM** (Optional, if compiling custom asset builds)

---

### Installation & Setup

1. **Clone the repository**
  ```bash
  git clone [https://github.com/tsshekwogaza/ARMS.git](https://github.com/tsshekwogaza/ARMS.git)
  cd rent-receipt-ng
   
2. **Install PHP Dependencies**
  ```bash
  composer install

3. **Configure Environment File**
  ```bash
  cp .env.example .env
  php artisan key:generate

3. **Setup Database Connection**
  Open **.env** and set your local database credentials:

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=rentreceipt_db
  DB_USERNAME=root
  DB_PASSWORD=

4. **Run Migrations & Seeders**
  ```bash
  php artisan migrate --seed

5. **Create Storage Symlink**
  (Required for serving tenant receipt PDFs and landlord signature stamps)
  ```bash
  php artisan storage:link
      
6. **Start Local Development Server**
  ```bash
  php artisan serve
  Access the app at http://127.0.0.1:8000.
