<?php

namespace Lucenarenato\Sail;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class SailServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->configurePublishing();
        }
    }

    /**
     * Register the console commands for the package.
     *
     * @return void
     */
    protected function registerCommands()
    {
        Artisan::command('sail:install', function () {
            copy(__DIR__.'/../stubs/docker-compose.yml', base_path('docker-compose.yml'));

            $environment = file_get_contents(base_path('.env'));

            $environment = str_replace('DB_HOST=127.0.0.1', 'DB_HOST=mysql', $environment);
            $environment = str_replace('MEMCACHED_HOST=127.0.0.1', 'MEMCACHED_HOST=redis', $environment);
            $environment = str_replace('REDIS_HOST=127.0.0.1', 'REDIS_HOST=redis', $environment);

            file_put_contents(base_path('.env'), $environment);
        });

        Artisan::command('sail:publish', function () {
            $this->call('vendor:publish', ['--tag' => 'sail']);

            file_put_contents(base_path('docker-compose.yml'), str_replace(
                './vendor/laravel/sail/runtimes/7.2',
                './docker/7.2',
                file_get_contents(base_path('docker-compose.yml'))
            ));
        });
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        $this->publishes([
            __DIR__.'/../runtimes' => base_path('docker'),
        ], 'sail');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'sail.install-command',
            'sail.publish-command',
        ];
    }
}
