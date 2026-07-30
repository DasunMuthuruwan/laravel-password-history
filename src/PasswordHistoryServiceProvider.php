<?php

namespace DevDasun\PasswordHistory;

use Illuminate\Support\ServiceProvider;

class PasswordHistoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/password-history.php', 'password-history');
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'password-history');

        $this->publishes([
            __DIR__ . '/../config/password-history.php' => config_path('password-history.php'),
        ], 'password-history-config');

        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'password-history-migrations');

        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/password-history'),
        ], 'password-history-lang');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \DevDasun\PasswordHistory\Console\Commands\PrunePasswordHistory::class,
            ]);
        }
    }
}
