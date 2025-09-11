# ModaShop E-commerce Platform

A full-stack e-commerce application built with Laravel API backend and Vue.js frontend.

## Project Structure

```
ModaShop-Website/
├── ecom-backend/          # Laravel API Backend
│   ├── app/               # Application logic
│   ├── database/          # Migrations and seeders
│   ├── routes/            # API routes
│   └── public/            # Public assets
└── frontend/              # Vue.js Frontend (to be created)
```

## Features

- **Backend (Laravel)**:
  - RESTful API with Laravel 12
  - SQLite database
  - Product management
  - Order processing
  - User authentication
  - Admin panel
  - Cart management

- **Frontend (Vue.js)**:
  - Modern Vue.js 3 application
  - Responsive design
  - Product catalog
  - Shopping cart
  - User authentication
  - Admin dashboard

## Getting Started

### Backend Setup

1. Navigate to the backend directory:
   ```bash
   cd ecom-backend
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations:
   ```bash
   php artisan migrate --seed
   ```

5. Start the server:
   ```bash
   php artisan serve
   ```

### Frontend Setup (Coming Soon)

The Vue.js frontend will be set up to integrate with the Laravel API.

## API Documentation

See `ecom-backend/API_Testing_Guide.md` for complete API documentation and testing instructions.

## Technologies Used

- **Backend**: Laravel 12, PHP 8.2, SQLite
- **Frontend**: Vue.js 3 (planned)
- **Authentication**: Laravel Sanctum
- **API Testing**: Postman Collection included
