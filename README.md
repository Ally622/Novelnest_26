# NovelNest & Stationery Hub

## Project Title and Description
**NovelNest & Stationery Hub** is a dynamic e-commerce platform designed for selling books and stationery. It provides a user-friendly interface for browsing products, managing a shopping cart, placing orders, and includes an administrative panel for managing users, products, categories, and orders.

## Features

-   **User Authentication:** Secure user registration, login, and logout.
-   **Product Catalog:** Browse products by categories and subcategories.
-   **Product Search:** Search for products by name or description.
-   **Shopping Cart:** Add, update, and remove items from the cart.
-   **Order Placement:** Place orders with specified shipping addresses and payment methods.
-   **Order History:** View personal order history and details.
-   **Admin Dashboard:**
    *   User Management (Edit roles, delete users).
    *   Product Management (Add, edit, delete products).
    *   Category Management (Add, edit, delete categories).
    *   Order Management (View and update order statuses).
    *   Site Overview statistics.
-   **Consistent UI:** Standardized header and styling across the main frontend and admin panel.
-   **Responsive Design:** Basic responsiveness for various screen sizes.

## Technologies Used

-   **Backend:** PHP (with MySQLi for database interaction)
-   **Database:** MySQL (or any compatible SQL database)
-   **Frontend:** HTML, CSS, JavaScript
-   **Web Server:** PHP's built-in development server (for local development)

## Installation and Setup

Follow these steps to get the NovelNest & Stationery Hub running on your local machine.

### Prerequisites

-   **PHP:** Version 7.4 or higher (with `mysqli` extension enabled).
-   **MySQL:** Database server.
-   **Web Browser:** Modern web browser (Chrome, Firefox, Edge, Safari).

### 1. Clone the Repository

First, clone the project repository to your local machine:

```bash
git clone <repository_url>
cd novelnest
```
*(Replace `<repository_url>` with the actual URL of your repository.)*

### 2. Database Setup

1.  **Create a MySQL Database:**
    Open your MySQL client (e.g., phpMyAdmin, MySQL Workbench, or command line) and create a new database for the project.
    ```sql
    CREATE DATABASE novelnest_db;
    ```
2.  **Import Schema and Data:**
    Import the provided `novelnest.sql` file to create the necessary tables.
    ```bash
    mysql -u your_username -p novelnest_db < novelnest.sql
    ```
    *(Replace `your_username` with your MySQL username. You will be prompted for your password.)*

3.  **Populate Products Table:**
    Execute the `populate_products.sql` file to add sample product data.
    ```bash
    mysql -u your_username -p novelnest_db < populate_products.sql
    ```
    *(If you haven't created it yet, generate the `populate_products.sql` from the project's products.php array as instructed by the Gemini CLI agent. Or copy the content into a new file and run it.)*

### 3. Configure Database Connection

Open `novelnest_frontend/config/db.php` and update the database connection details:

```php
<?php
// novelnest_frontend/config/db.php
$db_host = 'localhost';
$db_user = 'your_mysql_username'; // e.g., 'root'
$db_pass = 'your_mysql_password'; // e.g., '' (empty for XAMPP/MAMP root)
$db_name = 'novelnest_db';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
*(Replace `your_mysql_username` and `your_mysql_password` with your actual MySQL credentials.)*

### 4. Run the Development Server

Navigate to the `novelnest_frontend` directory (which is the merged root of the project) in your terminal and start the PHP built-in development server:

```bash
cd novelnest_frontend
php -S localhost:8000
```

### 5. Access the Application

Open your web browser and go to:

-   **Frontend:** `http://localhost:8000/`
-   **Admin Panel:** `http://localhost:8000/admin/admin_panel.php`

## Usage

### Frontend
-   Browse products from the homepage or products page.
-   Use the "Add to Cart" buttons to add items.
-   View and manage your cart from the "Cart" link.
-   Proceed to "Place Order" from the cart page.
-   View your order history from "My Orders".
-   Register and login to access personalized features.

### Admin Panel
1.  Log in with an admin account.
2.  Navigate to `http://localhost:8000/admin/admin_panel.php`.
3.  Use the links to manage users, products, categories, and orders.

## Admin Credentials

To access the admin panel, you need a user with the `role` set to 'admin' in the `users` table.

**To create an admin user (if you don't have one):**

1.  Register a new user through the application's registration page (`http://localhost:8000/register.php`).
2.  Open your MySQL client and run the following query to update the role of the newly registered user:
    ```sql
    UPDATE users
    SET role = 'admin'
    WHERE email = 'the_email_you_registered_with'; -- Replace with the actual email
    ```
3.  Now, log in with this updated user's credentials to access the admin panel.

## File Structure

```
novelnest/
├── novelnest.sql                   # Database schema and initial data
├── populate_products.sql           # SQL for populating product data
└── novelnest_frontend/             # Project's unified root (frontend + backend)
    ├── admin/                      # Admin-related pages and functionalities
    │   ├── admin_categories_edit.php
    │   ├── admin_categories.php
    │   ├── admin_orders.php
    │   ├── admin_panel.php         # Admin dashboard main page
    │   ├── admin_products_add.php
    │   ├── admin_products_edit.php
    │   ├── admin_products.php
    │   ├── admin_users_edit.php
    │   └── admin_users.php
    ├── auth/                       # User authentication (login, register, logout, password reset)
    │   ├── forgot_password.php
    │   ├── login.php
    │   ├── logout.php
    │   ├── register.php
    │   ├── reset_password_confirm.php
    │   ├── reset_password.php
    │   └── update_password.php
    ├── cart/                       # Shopping cart functionalities
    │   ├── add_to_cart.php
    │   ├── cart_fetch.php
    │   ├── remove_from_cart.php
    │   ├── update_cart.php
    │   └── view_cart.php
    ├── config/                     # Configuration files
    │   ├── db.php                  # Database connection
    │   └── init.php                # Initialization script
    ├── includes/                   # Reusable components
    │   ├── html_head.php           # Standard HTML <head> section
    │   ├── header.php              # Main frontend header
    │   ├── footer.php              # Main frontend footer
    │   └── functions.php           # Generic helper functions
    ├── orders/                     # Order processing and management
    │   ├── functions.php           # Order-related backend functions
    │   ├── order_details.php       # Backend script for fetching order details
    │   └── submit_order.php        # Backend script for submitting new orders
    ├── images/                     # Product and other images
    │   └── ...
    ├── style.css                   # Main stylesheet
    ├── script.js                   # Main JavaScript file (currently unused by most frontend pages)
    ├── index.php                   # Homepage (formerly dashboard.php)
    ├── products.php                # Product listing page
    ├── cart.php                    # Shopping cart display page
    ├── orders.php                  # User's order history display page
    ├── order_details.php           # Specific order details display page
    ├── profile.php                 # User profile page
    ├── confirmation.php            # Order confirmation page
    ├── thankyou.php                # Order thank you page
    ├── category.php                # Category-specific product listing
    ├── subcategory.php             # Subcategory-specific product listing
    ├── search.php                  # Search results page
    ├── 404.php                     # Not Found error page
    ├── error.php                   # General error page
    └── ... (other files)
```

## Future Enhancements

-   **Image Uploads:** Implement proper image upload functionality for products instead of manual path entry.
-   **Payment Gateway Integration:** Integrate with real payment gateways (e.g., M-Pesa, PayPal) instead of placeholders.
-   **User Roles & Permissions:** More granular control over user roles and what they can access.
-   **Frontend Framework:** Consider using a modern JavaScript framework (React, Vue, Angular) for a more interactive frontend.
-   **Admin Product/Category Editing:** Full CRUD operations for products and categories in the admin panel.
-   **Responsive Design:** Enhance mobile responsiveness and user experience.
-   **Session Management:** Implement more robust session management and security.
-   **Error Handling:** More sophisticated error logging and display.
-   **Wishlist:** Add a wishlist feature for users.

## License

*(Specify your project's license here, e.g., MIT, GPL, etc.)*
