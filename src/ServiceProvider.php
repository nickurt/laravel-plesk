<?php

namespace nickurt\Plesk;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('nickurt\Plesk\Plesk', function ($app) {
            $plesk = new Plesk($app);
            $plesk->server($plesk->getDefaultServer());

            return $plesk;
        });

        $this->app->alias('nickurt\Plesk\Plesk', 'Plesk');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/plesk.php' => config_path('plesk.php')
        ], 'config');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['nickurt\Plesk\Plesk', 'Plesk'];
    }
}
