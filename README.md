# Laravel Sail-7.x

Laravel sail for Laravel 5,6 or 7 apps.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install package.

```bash
composer install lucenarenato/sail-7.x --dev
```
## Usage

```php
php artisan sail:install
php artisan sail:publish

alias sail='bash vendor/bin/sail'

sail up
sail up -d
sail down

sail php --version
sail artisan tinker
sail composer require
sail npm run dev

sail share // ngrok tunnel url

sail build --no-cache
```

## Introduction

Sail provides a Docker powered local development experience for Laravel that is compatible with macOS, Windows (WSL2), and Linux. Other than Docker, no software or libraries are required to be installed on your local computer before using Sail. Sail's simple CLI means you can start building your Laravel application without any previous Docker experience.

## Official Documentation

Documentation for Sail can be found on the [Laravel website](https://laravel.com/docs/sail).

## License

Laravel Sail is open-sourced software licensed under the [MIT license](LICENSE.md).

- Renato Lucena [developer](https://renatolucena.net/) 