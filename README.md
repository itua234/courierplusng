# Multi-Tenant Blog System (Laravel)

## Overview

This project is a multi-tenant blog system built using Laravel. It allows multiple independent blogs (tenants) to exist within a single application instance. The system features user registration with admin approval, tenant-specific blog post management (CRUD operations), and a global view of all posts for administrators. API authentication using Laravel Sanctum is implemented for tenant access.

This project aims to demonstrate the implementation of multi-tenancy, robust authentication mechanisms, API development, and adherence to SOLID principles and Laravel best practices.

## Features

* **User Registration:** Users can register for an account.
* **Pending Approval:** Newly registered accounts require administrator approval before becoming active tenants.
* **Admin Approval & Tenant Creation:** Administrators can approve pending accounts, which creates a new tenant within the system.
* **Tenant Login:** Approved tenants can log in to their dedicated blog environment.
* **Tenant Blog Post Management (CRUD):** Authenticated tenants can create, read, update, and delete their own blog posts via both web and API interfaces.
* **Admin Global Post View:** Administrators have the ability to view all blog posts created by all tenants.
* **API Authentication (Laravel Sanctum):** Tenants authenticate via API using Laravel Sanctum for secure access to their blog post management endpoints.
* **Web Interface:** A user-friendly web interface for both administrators and tenants.
* **SOLID Principles:** The codebase is designed with adherence to SOLID principles for maintainability and scalability.
* **Laravel Best Practices:** The project follows established Laravel best practices for code structure, security, and performance.

## Technologies Used

* Laravel Framework
* PHP
* MySQL (or your preferred database)
* Laravel Sanctum (for API Authentication)
* Blade Templating Engine (for web interface)
* Composer (for dependency management)
* Artisan CLI (for Laravel commands)

## Setup Instructions

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd multi-tenant-blog
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file to `.env` and configure your database connection:**
    ```bash
    cp .env.example .env
    # Edit the .env file with your database credentials
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations:**
    ```bash
    php artisan migrate --seed # Use --seed to include initial data (e.g., an admin user)
    ```

6.  **Serve the application:**
    ```bash
    composer run dev
    ```

    The application will be accessible at `http://127.0.0.1:8000`.

## Database Setup

Ensure you have a database configured in your `.env` file. The migrations will create the necessary tables for users, tenants, blog posts, and Sanctum personal access tokens.