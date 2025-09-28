<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register theme service
        $this->app->singleton('theme', function ($app) {
            return new \App\Services\ThemeService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share theme data with all views
        View::composer('*', function ($view) {
            $view->with('currentTheme', app('theme')->getCurrentTheme());
            $view->with('isDarkMode', app('theme')->isDarkMode());
        });

        // Register Blade directives for theme
        Blade::directive('theme', function ($expression) {
            return "<?php echo app('theme')->getThemeClass($expression); ?>";
        });

        Blade::directive('darkmode', function () {
            return "<?php echo app('theme')->isDarkMode() ? 'dark' : ''; ?>";
        });

        // Register theme component namespace
        Blade::componentNamespace('App\\View\\Components\\Theme', 'theme');
    }
}
