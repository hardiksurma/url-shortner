# URL Shortener

A URL Shortener application built with **Laravel 12**, **PHP 8.3**, **MySQL 8**.

## Requirements

Make sure the following software is installed:

- PHP 8.3 or higher
- Composer
- MySQL 8
- Node.js and NPM
- Git

## Local Installation

Follow these steps to run the project locally.

### 1. Clone the Repository

```bash
git clone <YOUR_REPOSITORY_URL>
cd <PROJECT_DIRECTORY>
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the example environment file:

```bash
cp .env.example .env
```

On Windows Command Prompt, you can use:

```cmd
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure Database

Create a new MySQL database and update the following values in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 5. Configure SMTP

Update the following SMTP settings in your `.env` file with your email provider's credentials:

```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=your_smtp_port
MAIL_USERNAME=your_smtp_username
MAIL_PASSWORD=your_smtp_password
```

Make sure the SMTP credentials are valid for sending invitation emails.

### 6. Install Frontend Dependencies

```bash
npm install
```

Build the frontend assets:

```bash
npm run build
```

### 7. Run Database Migrations and Seeders

Run the following command:

```bash
php artisan migrate --seed
```

This command will:

- Create all required database tables.
- Create roles and permissions.
- Create the default SuperAdmin account.

### 8. Start the Development Server

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Default SuperAdmin Credentials

After successfully running the database seeders, use the following credentials to log in:

| Field | Value |
|---|---|
| Email | admin@urlshortner.com |
| Password | Admin@123456 |
| Role | super_admin |

## Tech Stack

- **Backend:** Laravel 12, PHP 8.3
- **Frontend:** Blade, Laravel Breeze, HTML, CSS, JavaScript
- **Database:** MySQL 8
- **Authentication:** Laravel Breeze
- **Role & Permission Management:** Spatie Laravel Permission