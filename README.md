<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Composer Requires
```sh
composer require kyslik/column-sortable
```
```sh
composer require doctrine/dbal
```
```sh
php artisan migrate
```
```sh
php artisan db:seed
```

## First Installation
Given below are the steps you need to follow, to install the frest-laravel-admin-template on your system:

**Step 1**: Open the terminal in your root directory(frest-laravel-admin-template) & to install the composer packages run the following command:
```sh
composer install
```

**Step 2**: In the root directory, you will find a file named .env.example, rename the given file name to .env and run the following command to generate the key (and you can also edit your database credentials here).
```sh
php artisan key:generate
```

**Step 3**: By running the following command, you will be able to get all the dependencies in your node_modules folder:
```sh
npm install
```

**Step 4**: To run the project, you need to run following command in the project directory. It will compile the php files & all the other project files. If you are making any changes in any of the .php file then you need to run the given command again.
```sh
npm run dev
```

**Step 5**: To serve the application you need to run the following command in the project directory. (This will give you an address with port number 8000.) Now navigate to the given address you will see your application is running.
```sh
php artisan serve
```

**Watching for changes**: If you want to watch all the changes you make in the application then run the following command in the root directory.
```sh
npm run watch
```

**Building for Production**: If you want to run the project and make the build in the production mode then run the following command in the root directory, otherwise the project will continue to run in the development mode.
```sh
npm run prod
```

**Required Permissions**: If you are facing any issues regarding the permissions, then you need to run the following command in your project directory:
```sh
sudo chmod -R o+rw bootstrap/cache
```
```sh
sudo chmod -R o+rw storage
```

## Laravel ACL
### Installation
This package can be used with Laravel 5.8 or higher.

1. Consult the Prerequisites page for important considerations regarding your User models!

2. This package publishes a `config/permission.php` file. If you already have a file by that name, you must rename or remove it.

3. You can install the package via composer:
```sh
composer require spatie/laravel-permission
```
4. Optional: The service provider will automatically get registered. Or you may manually add the service provider in your `config/app.php` file:
```php
'providers' => [
// ...
Spatie\Permission\PermissionServiceProvider::class,
];
```
5. You should publish the migration and the `config/permission.php` config file with:
```sh
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```
6. NOTE: If you are using UUIDs, see the Advanced section of the docs on UUID steps, before you continue. It explains some changes you may want to make to the migrations and config file before continuing. It also mentions important considerations after extending this package’s models for UUID capability.

7. Run the migrations: After the config and migration have been published and configured, you can create the tables for this package by running:
```sh
php artisan migrate
```
8. Add the necessary trait to your User model: Consult the Basic Usage section of the docs for how to get started using the features of this package.