<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ThemeService;

class ThemeController extends Controller
{
    protected $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    /**
     * Toggle between light and dark theme
     */
    public function toggle(Request $request): JsonResponse
    {
        try {
            $newTheme = $this->themeService->toggleTheme();

            return response()->json([
                'success' => true,
                'theme' => $newTheme,
                'isDarkMode' => $this->themeService->isDarkMode(),
                'message' => "Theme switched to {$newTheme} mode"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle theme',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Set specific theme
     */
    public function setTheme(Request $request): JsonResponse
    {
        $request->validate([
            'theme' => 'required|in:light,dark'
        ]);

        try {
            $this->themeService->setTheme($request->theme);

            return response()->json([
                'success' => true,
                'theme' => $request->theme,
                'isDarkMode' => $this->themeService->isDarkMode(),
                'message' => "Theme set to {$request->theme} mode"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to set theme',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get current theme information
     */
    public function getCurrentTheme(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'config' => $this->themeService->getThemeConfig()
        ]);
    }
}
