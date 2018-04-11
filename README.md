## Laravel Plesk Onyx 17.8

### Installation
Install this package with composer:
```
composer require nickurt/laravel-plesk:1.*
```

Add the provider to config/app.php file

```php
'nickurt\Plesk\ServiceProvider',
```

and the facade in the file

```php
'Plesk' => 'nickurt\Plesk\Facade',
```

Copy the config files for the Plesk-plugin

```
php artisan vendor:publish --provider="nickurt\Plesk\ServiceProvider" --tag="config"
```
### Tests
```sh
phpunit
```
- - - 