<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ThemeService;

class ThemeMiddleware
{
    protected $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Initialize theme for this request
        $theme = $this->themeService->getCurrentTheme();

        // Share theme data with views
        view()->share([
            'currentTheme' => $theme,
            'isDarkMode' => $this->themeService->isDarkMode(),
            'themeConfig' => $this->themeService->getThemeConfig()
        ]);

        return $next($request);
    }
}
