# Campus ERP System

Campus ERP System is a modular college management ERP platform built using Laravel.

The project is designed with scalable architecture, clean separation of concerns, and collaborative development workflow.

# Tech Stack

- Laravel
- PHP
- MySQL
- Blade
- Tailwind CSS

# Project Setup

## Clone Repository

```bash
git clone <repo-url>
```

## Move Into Project Directory

```bash
cd campus-erp-system
```

## Install Dependencies

```bash
composer install
npm install
```

## Configure Environment

Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

## Database Setup

Create a MySQL database named:

```text
campus_erp
```

## Run Migrations

```bash
php artisan migrate
```

## Start Development Server

```bash
php artisan serve
```

## Run Frontend Build

```bash
npm run dev
```

# Development Workflow

- Create separate feature branches before development
- Pull latest changes from main branch before starting work
- Use meaningful commit messages
- Avoid direct pushes to main branch

# Contribution Guidelines

Please read:

[CONTRIBUTING.md](CONTRIBUTING.md)


before contributing to the project.
