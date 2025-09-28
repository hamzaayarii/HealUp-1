<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class ThemeService
{
    const LIGHT_THEME = 'light';
    const DARK_THEME = 'dark';
    const COOKIE_NAME = 'healup_theme';
    const SESSION_KEY = 'theme';

    /**
     * Get the current theme preference
     */
    public function getCurrentTheme(): string
    {
        // Check session first (user's current session preference)
        if (Session::has(self::SESSION_KEY)) {
            return Session::get(self::SESSION_KEY);
        }

        // Check cookie (persistent preference)
        if (Cookie::has(self::COOKIE_NAME)) {
            $theme = Cookie::get(self::COOKIE_NAME);
            if (in_array($theme, [self::LIGHT_THEME, self::DARK_THEME])) {
                Session::put(self::SESSION_KEY, $theme);
                return $theme;
            }
        }

        // Default to light theme
        return self::LIGHT_THEME;
    }

    /**
     * Set the current theme preference
     */
    public function setTheme(string $theme): void
    {
        if (!in_array($theme, [self::LIGHT_THEME, self::DARK_THEME])) {
            throw new \InvalidArgumentException('Invalid theme provided');
        }

        Session::put(self::SESSION_KEY, $theme);
        Cookie::queue(self::COOKIE_NAME, $theme, 60 * 24 * 365); // 1 year
    }

    /**
     * Toggle between light and dark theme
     */
    public function toggleTheme(): string
    {
        $currentTheme = $this->getCurrentTheme();
        $newTheme = $currentTheme === self::LIGHT_THEME ? self::DARK_THEME : self::LIGHT_THEME;
        $this->setTheme($newTheme);
        return $newTheme;
    }

    /**
     * Check if current theme is dark mode
     */
    public function isDarkMode(): bool
    {
        return $this->getCurrentTheme() === self::DARK_THEME;
    }

    /**
     * Check if current theme is light mode
     */
    public function isLightMode(): bool
    {
        return $this->getCurrentTheme() === self::LIGHT_THEME;
    }

    /**
     * Get theme class for HTML elements
     */
    public function getThemeClass(?string $additionalClasses = null): string
    {
        $themeClass = $this->isDarkMode() ? 'dark' : '';

        if ($additionalClasses) {
            return trim($themeClass . ' ' . $additionalClasses);
        }

        return $themeClass;
    }

    /**
     * Get theme-specific CSS classes
     */
    public function getThemeClasses(): array
    {
        return [
            'html' => $this->isDarkMode() ? 'dark' : '',
            'body' => $this->isDarkMode()
                ? 'bg-gray-900 text-gray-100'
                : 'bg-gray-50 text-gray-900',
            'surface' => $this->isDarkMode()
                ? 'bg-gray-800 text-gray-100'
                : 'bg-white text-gray-900',
            'border' => $this->isDarkMode()
                ? 'border-gray-700'
                : 'border-gray-200',
            'hover' => $this->isDarkMode()
                ? 'hover:bg-gray-700'
                : 'hover:bg-gray-100',
        ];
    }

    /**
     * Get available themes
     */
    public function getAvailableThemes(): array
    {
        return [
            self::LIGHT_THEME => [
                'name' => 'Light',
                'icon' => 'sun',
                'description' => 'Light theme for day use'
            ],
            self::DARK_THEME => [
                'name' => 'Dark',
                'icon' => 'moon',
                'description' => 'Dark theme for night use'
            ]
        ];
    }

    /**
     * Get theme configuration
     */
    public function getThemeConfig(): array
    {
        return [
            'current' => $this->getCurrentTheme(),
            'isDark' => $this->isDarkMode(),
            'isLight' => $this->isLightMode(),
            'classes' => $this->getThemeClasses(),
            'available' => $this->getAvailableThemes(),
        ];
    }
}
