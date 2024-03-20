<p align="center">Hajj Management System</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Hajj Management System

The Hajj Management System is an advanced and efficient solution that streamlines the organization and management of the Hajj experience with ease and smoothness. Blending modern technology with dedication to service, the system facilitates the efficient management of accommodations, camps, transportation, and staff. With its comprehensive functionalities, the system enables the management of gift distribution, meal allocation, as well as printing pilgrim cards and barcodes, enhancing the pilgrims' experience and making it an unforgettable journey.

## Learning Laravel


We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).


## Installation
1. Clone the repository

```bash
    git clone https://github.com/lamoud/hajj-management.git
```

2. Navigate into the project directory

```bash
    cd hajj-management
```

3. Install dependencies

```bash
    composer install
```

4. Install noude modules

```bash
    npm install
```

5. Create a copy of the .env.example file and rename it to .env

```bash
    cp .env.example .env
```
6. Creating a New Database & Set up your database connection in the `.env` file.

Create a new database within the installed database system. This can be done using the database management interface or by using appropriate SQL commands.

Configuring the Environment File (.env): Specify the connection information for the new database in the application's environment file (.env). Set the database name, username, password, and host to correct values.

7. Generate application key

```bash
    php artisan key:generate
```

8. Run the database migrations && seeders

```bash
    php artisan migrate --seed
```

## Usage

1. Start the development server

```bash
    php artisan serve
```
2. Open your web browser and go to [http://localhost:8000](http://localhost:8000).

3. Log in using the following credentials:
 - Username: betalamoud@gmail.com
 - Password: Admin_123@#

4. You will be redirected to the system's dashboard.



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
