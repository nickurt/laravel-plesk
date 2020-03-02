## Laravel Plesk Onyx 17.8
[![Build Status](https://github.com/nickurt/laravel-plesk/workflows/tests/badge.svg)](https://github.com/nickurt/laravel-plesk/actions)
[![Total Downloads](https://poser.pugx.org/nickurt/laravel-plesk/d/total.svg)](https://packagist.org/packages/nickurt/laravel-plesk)
[![Latest Stable Version](https://poser.pugx.org/nickurt/laravel-plesk/v/stable.svg)](https://packagist.org/packages/nickurt/laravel-plesk)
[![MIT Licensed](https://poser.pugx.org/nickurt/laravel-plesk/license.svg)](LICENSE.md)

### Installation
Install this package with composer:
```
composer require nickurt/laravel-plesk
```
Copy the config files for the Plesk-plugin
```
php artisan vendor:publish --provider="nickurt\Plesk\ServiceProvider" --tag="config"
```
### Tests
```sh
composer test
```
- - - 
