# ModaShop E-commerce Platform

A comprehensive e-commerce application built with Laravel 12, featuring a modern web interface with Arabic language support and responsive design.

## 🚀 Project Overview

ModaShop is a full-featured e-commerce platform designed for Arabic-speaking markets, offering a complete shopping experience with admin management capabilities.

## 📁 Project Structure

```
ModaShop-Website/
├── ecom-backend/          # Laravel Backend Application
│   ├── app/               # Application logic
│   │   ├── Http/Controllers/  # Web controllers
│   │   ├── Models/        # Eloquent models
│   │   └── Providers/     # Service providers
│   ├── database/          # Migrations, seeders, and SQLite DB
│   ├── resources/views/   # Blade templates
│   ├── routes/            # Web routes
│   └── public/            # Public assets and storage
└── README.md              # This file
```

## ✨ Features

### 🛍️ **Customer Features**
- **Product Catalog**: Browse products with categories and search
- **Shopping Cart**: Session-based cart management
- **Guest Checkout**: Complete orders without registration
- **Order Tracking**: Track orders using phone number
- **Responsive Design**: Mobile-first responsive layout
- **Arabic Language Support**: Full RTL (Right-to-Left) support

### 👨‍💼 **Admin Features**
- **Dashboard**: Sales analytics with charts and reports
- **Product Management**: Create, edit, and manage products
- **Category Management**: Organize products by categories
- **Order Management**: Process and track customer orders
- **Customer Management**: View customer information
- **Sales Reports**: Export sales data and analytics
- **Low Stock Alerts**: Monitor inventory levels

### 🔧 **Technical Features**
- **Laravel 12**: Latest Laravel framework
- **SQLite Database**: Lightweight database solution
- **Session-based Cart**: No authentication required for shopping
- **Image Management**: Product image upload and storage
- **Caching**: Performance optimization with caching
- **Security**: Admin authentication and CSRF protection

## 🛠️ Technologies Used

- **Backend**: Laravel 12, PHP 8.2+
- **Database**: SQLite
- **Frontend**: Blade templates with Bootstrap
- **Authentication**: Laravel's built-in authentication
- **Styling**: Custom CSS with responsive design
- **Charts**: Chart.js for analytics
- **Icons**: Font Awesome

## 🚀 Getting Started

### Prerequisites
- PHP 8.2 or higher
- Composer
- Web server (Apache/Nginx) or Laravel's built-in server

### Installation

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd ModaShop-Website/ecom-backend
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**:
   ```bash
   # SQLite database is already created
   php artisan migrate --seed
   ```

5. **Start the development server**:
   ```bash
   php artisan serve
   ```

6. **Access the application**:
   - **Customer Site**: http://localhost:8000
   - **Admin Panel**: http://localhost:8000/admin/login

### Default Admin Credentials
- **Email**: admin@modashop.com
- **Password**: password

## 📱 Pages & Routes

### Customer Pages
- `/` - Homepage with featured products
- `/products` - Product catalog
- `/products/{id}` - Product details
- `/categories` - Category listing
- `/cart` - Shopping cart
- `/checkout` - Order checkout
- `/orders` - Order history
- `/tracking` - Order tracking
- `/about` - About page
- `/contact` - Contact page

### Admin Pages
- `/admin/dashboard` - Admin dashboard
- `/admin/products` - Product management
- `/admin/categories` - Category management
- `/admin/orders` - Order management
- `/admin/customers` - Customer management
- `/admin/sales` - Sales analytics

## 🗄️ Database Schema

### Core Models
- **Products**: Product information with images and pricing
- **Categories**: Product categorization
- **Orders**: Customer orders with status tracking
- **OrderItems**: Individual items within orders
- **Customers**: Customer information (created during checkout)
- **Carts**: Session-based shopping carts
- **CartItems**: Items in shopping cart
- **Admins**: Admin user accounts

## 🎨 Design Features

- **Responsive Design**: Works on all screen sizes
- **Arabic RTL Support**: Proper right-to-left text direction
- **Modern UI**: Clean, professional design
- **Mobile-First**: Optimized for mobile devices
- **Golden Theme**: Elegant golden color scheme
- **Interactive Elements**: Hover effects and animations

## 📊 Admin Analytics

The admin panel includes comprehensive analytics:
- **Sales Reports**: Revenue tracking with charts
- **Order Statistics**: Order volume and trends
- **Product Performance**: Best-selling products
- **Category Analysis**: Sales by category
- **Customer Insights**: Customer behavior data

## 🔧 Development

### Key Files
- `routes/web.php` - All application routes
- `app/Http/Controllers/` - Business logic
- `resources/views/` - Blade templates
- `database/migrations/` - Database schema
- `public/assets/` - CSS, JS, and images

### Adding New Features
1. Create migration for database changes
2. Update models with new relationships
3. Add controller methods
4. Create/update views
5. Add routes
6. Test functionality

## 📝 API Testing

A Postman collection is included for API testing:
- `ModaShop_API_Postman_Collection.json`

## 🚀 Deployment

For production deployment:
1. Set up a web server (Apache/Nginx)
2. Configure PHP and Laravel
3. Set up SSL certificate
4. Configure environment variables
5. Run migrations and seeders
6. Set proper file permissions

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 📞 Support

For support or questions, please contact the development team.

---

**ModaShop** - Modern E-commerce Made Simple 🛍️