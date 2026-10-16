# Medical Store Inventory Management

Web-based system for managing a medical store: stock tracking, billing, and supplier management, backed by a MySQL database.

Built as an academic group project at NMIMS MPSTME. Mayur led the group and wrote the core code skeleton.

## Features

- **Inventory management** - add, update and delete medicines; track stock levels with low-stock alerts
- **Billing** - generate bills and manage transactions
- **Supplier management** - supplier records linked to inventory and purchase orders
- **Search and filtering** - locate medicines quickly
- **Dashboard** - stock overview with charts

## Tech stack

PHP, MySQL, HTML/CSS, JavaScript (Chart.js)

## Setup

1. Import `mym.sql` into MySQL (creates the `mym` database with sample data).
2. Copy `config.example.php` to `config.php` and fill in your local MySQL credentials. `config.php` is gitignored - never commit real credentials.
3. Serve the folder with Apache/Nginx (e.g. XAMPP) and open `01.userlogin.html`.

## Docs

- `01 - ER Diagram.pdf` - entity-relationship diagram
- `02 - Schema - 2024 0403.pdf` - database schema
- Full project report: `Group 12 - F005, F030, F034 - Final Report - Project.docx`
