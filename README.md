
# Penjadwalan GMS

## Prerequisites

- PHP 8.2
- Composer
- Node.js
- MySQL

## Installation

```bash
git clone https://github.com/hanselsantoso/PenjadwalanGMS
cd PenjadwalanGMS
```

## Laravel Server Setup

### 1. Install Backend Dependencies

```bash
composer install
```

*If you encounter issues with `composer install`, follow these steps:*
1. Open `composer.json` and remove this line:
    ```json
    "maatwebsite/excel": "^3.1"
    ```
2. Run:
    ```bash
    composer require maatwebsite/excel
    ```
3. If `maatwebsite/excel` appears as `"*"` or `"1.1"` in `composer.json`, change it to:
    ```json
    "maatwebsite/excel": "^3.1"
    ```
4. In your `php.ini`, add or uncomment:
    ```ini
    extension=gd
    extension=zip
    ```
5. Run:
    ```bash
    composer update
    ```

### 2. Environment Configuration

Copy the example environment file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure Database

Edit your `.env` file and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jadwal_gms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Import Database Schema & Data

- Open your database tool (e.g., phpMyAdmin, MySQL CLI).
- Import the latest `.sql` file from `database/sqls/`.

**phpMyAdmin instructions:**
- Go to `http://localhost/phpmyadmin`.
- Select your database.
- Go to the **Import** tab.
- Upload the latest `.sql` file.
- Click **Go**.

### 5. Run the Laravel Server

```bash
php artisan serve
```

## Frontend Server Setup

### 1. Install Frontend Dependencies

Open a new terminal window, then run:
```bash
npm i
```

### 2. Start the Frontend Server

```bash
npm run dev
```

## Accessing the Application

- Open [http://localhost:8000](http://localhost:8000) in your browser to access the application (frontend and backend are served from this address).

## Default Super Admin Credentials

- **Email:** super@super.com
- **Password:** super123

## Troubleshooting

- Ensure all prerequisites are installed and available in your PATH.
- If you encounter issues, check the error messages for missing extensions or misconfigurations.
- For further help, consult the [Laravel documentation](https://laravel.com/docs/) or open an issue in this repository.
