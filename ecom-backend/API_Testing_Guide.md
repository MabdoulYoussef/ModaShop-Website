# ModaShop API Testing Guide

## Overview
This guide provides comprehensive testing instructions for the ModaShop e-commerce API using Postman.

## Setup Instructions

### 1. Import Postman Collection
1. Open Postman
2. Click "Import" button
3. Select the `ModaShop_API_Postman_Collection.json` file
4. The collection will be imported with all endpoints organized by category

### 2. Configure Environment Variables
Set up the following variables in your Postman environment:

- `base_url`: `http://localhost:8000` (or your Laravel server URL)
- `auth_token`: Will be set after login (for regular user)
- `admin_token`: Will be set after admin login (for admin operations)

## API Endpoints Testing

### Authentication Endpoints

#### 1. Register User
- **Method**: POST
- **URL**: `{{base_url}}/api/register`
- **Body**:
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
- **Expected Response**: 201 Created with user data and token

#### 2. Login User
- **Method**: POST
- **URL**: `{{base_url}}/api/login`
- **Body**:
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```
- **Expected Response**: 200 OK with user data and token
- **Action**: Copy the token from response and set it as `auth_token` variable

#### 3. Logout User
- **Method**: POST
- **URL**: `{{base_url}}/api/logout`
- **Headers**: `Authorization: Bearer {{auth_token}}`
- **Expected Response**: 200 OK with logout message

### Public Endpoints (No Authentication Required)

#### 4. Get All Products
- **Method**: GET
- **URL**: `{{base_url}}/api/products`
- **Expected Response**: 200 OK with array of products

#### 5. Get Single Product
- **Method**: GET
- **URL**: `{{base_url}}/api/products/{id}`
- **Expected Response**: 200 OK with product data or 404 Not Found

#### 6. Get All Categories
- **Method**: GET
- **URL**: `{{base_url}}/api/categories`
- **Expected Response**: 200 OK with array of categories

#### 7. Get Single Category
- **Method**: GET
- **URL**: `{{base_url}}/api/categories/{id}`
- **Expected Response**: 200 OK with category data and products or 404 Not Found

### Authenticated Endpoints (Require Login)

#### 8. Create Order
- **Method**: POST
- **URL**: `{{base_url}}/api/orders`
- **Headers**: `Authorization: Bearer {{auth_token}}`
- **Body**:
```json
{
    "items": [
        {
            "product_id": 1,
            "quantity": 2
        },
        {
            "product_id": 2,
            "quantity": 1
        }
    ]
}
```
- **Expected Response**: 201 Created with order data and items

#### 9. Get User Orders
- **Method**: GET
- **URL**: `{{base_url}}/api/orders`
- **Headers**: `Authorization: Bearer {{auth_token}}`
- **Expected Response**: 200 OK with array of user's orders

### Admin Endpoints (Require Admin Role)

#### 10. Create Product (Admin)
- **Method**: POST
- **URL**: `{{base_url}}/api/products`
- **Headers**: `Authorization: Bearer {{admin_token}}`
- **Body**:
```json
{
    "name": "Nike Air Max",
    "description": "Comfortable running shoes",
    "price": 129.99,
    "image": "https://example.com/nike-air-max.jpg",
    "category_id": 1,
    "size": "42",
    "stock": 50
}
```
- **Expected Response**: 201 Created with product data

#### 11. Update Product (Admin)
- **Method**: PUT
- **URL**: `{{base_url}}/api/products/{id}`
- **Headers**: `Authorization: Bearer {{admin_token}}`
- **Body**:
```json
{
    "name": "Nike Air Max Updated",
    "price": 139.99,
    "stock": 45
}
```
- **Expected Response**: 200 OK with updated product data

#### 12. Delete Product (Admin)
- **Method**: DELETE
- **URL**: `{{base_url}}/api/products/{id}`
- **Headers**: `Authorization: Bearer {{admin_token}}`
- **Expected Response**: 200 OK with deletion message

## Testing Workflow

### Step 1: Setup Database
```bash
cd ecom-backend
php artisan migrate
php artisan db:seed
```

### Step 2: Start Laravel Server
```bash
php artisan serve
```

### Step 3: Test Authentication
1. Register a new user
2. Login with the user credentials
3. Copy the token from login response
4. Set the token as `auth_token` variable in Postman

### Step 4: Test Public Endpoints
1. Test getting all products
2. Test getting all categories
3. Test getting individual products/categories

### Step 5: Test Authenticated Endpoints
1. Create an order (requires valid products in database)
2. Get user orders

### Step 6: Test Admin Endpoints
1. Create an admin user (modify database or create admin user)
2. Login as admin
3. Set admin token as `admin_token` variable
4. Test product CRUD operations

## Expected Response Formats

### Success Response (200/201)
```json
{
    "data": {...},
    "message": "Success message"
}
```

### Error Response (400/401/403/404)
```json
{
    "message": "Error message",
    "errors": {
        "field": ["Validation error message"]
    }
}
```

### Authentication Response
```json
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "user"
    },
    "token": "1|abc123..."
}
```

## Common Testing Scenarios

### 1. User Registration Flow
1. Register with valid data → Should return 201
2. Register with existing email → Should return 422 validation error
3. Register with invalid password confirmation → Should return 422

### 2. User Login Flow
1. Login with valid credentials → Should return 200 with token
2. Login with invalid credentials → Should return 422 validation error

### 3. Product Management Flow
1. Get all products (public) → Should return 200
2. Create product (admin only) → Should return 201
3. Update product (admin only) → Should return 200
4. Delete product (admin only) → Should return 200

### 4. Order Management Flow
1. Create order (authenticated) → Should return 201
2. Get user orders (authenticated) → Should return 200
3. Create order without authentication → Should return 401

## Troubleshooting

### Common Issues

1. **401 Unauthorized**: Check if token is valid and properly set
2. **403 Forbidden**: Check if user has admin role for admin endpoints
3. **404 Not Found**: Check if the resource ID exists in database
4. **422 Validation Error**: Check request body format and required fields

### Database Setup
If you encounter database-related errors:
```bash
php artisan migrate:fresh --seed
```

### Token Management
- Always copy the token from login response
- Set tokens as environment variables
- Tokens expire, so re-login if you get 401 errors

## Security Testing

### Test Cases to Verify
1. **Unauthorized Access**: Try accessing protected endpoints without token
2. **Invalid Token**: Use expired or invalid token
3. **Role-based Access**: Try admin endpoints with regular user token
4. **Input Validation**: Test with invalid/malicious input data

## Performance Testing

### Load Testing Scenarios
1. **Concurrent Users**: Test with multiple simultaneous requests
2. **Large Data Sets**: Test with many products/categories
3. **Response Times**: Monitor API response times

## Environment Variables Reference

| Variable | Description | Example Value |
|----------|-------------|---------------|
| `base_url` | API base URL | `http://localhost:8000` |
| `auth_token` | Regular user authentication token | `1|abc123...` |
| `admin_token` | Admin user authentication token | `2|def456...` |

## Additional Notes

- All timestamps are in UTC
- IDs are auto-incrementing integers
- Images are stored as URLs (not file uploads in this version)
- Stock quantities cannot be negative
- Order totals are calculated automatically
- User roles are: 'user' and 'admin' 
