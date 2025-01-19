
# Penjadwalan GMS

## Prerequisites

-   PHP 8.2
-   Composer
-   Node.js
-   MySQL

## Installation

1. Clone the repository

```bash
git clone https://github.com/hanselsantoso/PenjadwalanGMS
```

2. Navigate to the project directory

```bash
cd PenjadwalanGMS
```

3. Install dependencies

```bash
composer install
```

* If you encounter issue when running composer install do these steps
    1. Open composer.json file and remove this line
        ```bash
        "maatwebsite/excel": "^3.1"
        ```

    2. Run this command
        ```bash
        composer require maatwebsite/excel
        ```

    3. Check the composer.json file if the maatwebsite/excel is with "*" or "1.1", change it to "^3.1"
        ```bash
        "maatwebsite/excel": "^3.1", 
        ```

    4. Open your `php.ini` file in your PHP file and add or uncomment this line
        ```bash
        extension=gd
        ```

    5. Finally run this command
        ```bash
        composer update
        ```

4. Copy .env.example and create .env file

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure database

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jadwal_gms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run the latest sql file on the `/database/sqls` folder

7. Run the laravel server

```bash
php artisan serve
```

8. Run the frontend server

```bash
npm run dev
```
