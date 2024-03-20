<p align="center">Hajj Management System</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Hajj Management System

The Hajj Management System is an advanced and efficient solution that streamlines the organization and management of the Hajj experience with ease and smoothness. Blending modern technology with dedication to service, the system facilitates the efficient management of accommodations, camps, transportation, and staff. With its comprehensive functionalities, the system enables the management of gift distribution, meal allocation, as well as printing pilgrim cards and barcodes, enhancing the pilgrims' experience and making it an unforgettable journey.

## Installation
### Clone the repository

```bash
git clone https://github.com/lamoud/hajj-management.git
```

### Navigate into the project directory

```bash
cd hajj-management
```

### Install dependencies

```bash
composer install
```

### Install noude modules

```bash
npm install
```

### Build the frontend assets:
```bash
npm run build
```

### Create a copy of the .env.example file and rename it to .env

```bash
cp .env.example .env
```
### Creating a New Database & Set up your database connection in the `.env` file.

Create a new database within the installed database system. This can be done using the database management interface or by using appropriate SQL commands.

Configuring the Environment File (.env): Specify the connection information for the new database in the application's environment file (.env). Set the database name, username, password, and host to correct values.

### Generate application key

```bash
php artisan key:generate
```

### Run the database migrations && seeders

```bash
php artisan migrate --seed
```

## Usage

### Start the development server

```bash
php artisan serve
```
### Open your web browser and go to [http://localhost:8000](http://localhost:8000).

### Log in using the following credentials:
 - Username: betalamoud@gmail.com
 - Password: Admin_123@#

### You will be redirected to the system's dashboard.



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
