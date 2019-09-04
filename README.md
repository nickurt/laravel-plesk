## Laravel Plesk Onyx 17.8
[![Latest Stable Version](https://poser.pugx.org/nickurt/laravel-plesk/v/stable?format=flat-square)](https://packagist.org/packages/nickurt/laravel-plesk)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/nickurt/laravel-plesk/master.svg?style=flat-square)](https://travis-ci.org/nickurt/laravel-plesk)
[![Total Downloads](https://img.shields.io/packagist/dt/nickurt/laravel-plesk.svg?style=flat-square)](https://packagist.org/packages/nickurt/laravel-plesk)
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
