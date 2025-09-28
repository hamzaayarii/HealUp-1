# 🌓 HealUp Theme System Documentation

## Overview

The HealUp application now includes a comprehensive dark/light theme switching system that provides:

-   ✅ Instant theme switching with smooth transitions
-   ✅ User preference persistence (session + cookie)
-   ✅ Server-side theme state management
-   ✅ Cross-tab synchronization
-   ✅ System theme preference detection
-   ✅ Keyboard shortcuts (Ctrl/Cmd + Shift + D)
-   ✅ Accessibility compliant
-   ✅ Future-ready for new pages and components

## 🏗️ Architecture Components

### 1. **Theme Service** (`app/Services/ThemeService.php`)

-   Manages theme state server-side
-   Handles session and cookie persistence
-   Provides theme configuration and classes
-   Thread-safe theme operations

### 2. **Theme Controller** (`app/Http/Controllers/ThemeController.php`)

-   Handles AJAX theme toggle requests
-   RESTful API for theme management
-   JSON responses for frontend integration

### 3. **Theme Middleware** (`app/Http/Middleware/ThemeMiddleware.php`)

-   Initializes theme on every request
-   Shares theme data with all views
-   Ensures consistent theme state

### 4. **Theme Toggle Component** (`resources/views/components/theme/toggle.blade.php`)

-   Interactive theme switching button
-   Alpine.js powered with smooth animations
-   Multiple size variants (sm, md, lg)
-   Positioning options (inline, fixed, absolute)

### 5. **Theme Manager JS** (`resources/js/theme-manager.js`)

-   Client-side theme orchestration
-   Cross-tab synchronization
-   Keyboard shortcuts
-   System preference detection
-   Fallback handling for server errors

## 🎨 Tailwind Configuration

### Dark Mode Setup

```javascript
// tailwind.config.js
darkMode: 'class', // Class-based dark mode
```

### Custom Theme Colors

```javascript
colors: {
  primary: { 50: '#f0f9ff', ..., 950: '#082f49' },
  secondary: { 50: '#f8fafc', ..., 950: '#020617' },
  surface: { light: '#ffffff', dark: '#1f2937' },
  background: { light: '#f9fafb', dark: '#111827' },
  text: { light: '#111827', dark: '#f9fafb' }
}
```

## 📡 API Endpoints

### Theme Routes (`routes/web.php`)

```php
POST /theme/toggle    // Toggle between light/dark
POST /theme/set       // Set specific theme
GET  /theme/current   // Get current theme info
```

### Response Format

```json
{
    "success": true,
    "theme": "dark",
    "isDarkMode": true,
    "message": "Theme switched to dark mode"
}
```

## 🧩 Component Usage

### Basic Theme Toggle

```blade
<x-theme.toggle />
```

### With Custom Options

```blade
<x-theme.toggle
    size="lg"
    position="fixed"
    button-classes="shadow-lg"
/>
```

### Sizes Available

-   `sm` - 32x32px (w-8 h-8)
-   `md` - 40x40px (w-10 h-10) [default]
-   `lg` - 48x48px (w-12 h-12)

### Positions Available

-   `inline` - Normal document flow [default]
-   `fixed` - Fixed top-right corner
-   `absolute` - Absolute top-right positioning

## 🎯 Dark Mode CSS Classes

### Updated Components

All components now include dark mode variants:

```blade
<!-- Buttons -->
bg-primary-600 dark:bg-primary-700
text-white hover:bg-primary-700 dark:hover:bg-primary-600

<!-- Backgrounds -->
bg-white dark:bg-gray-800
bg-gray-50 dark:bg-gray-900

<!-- Text -->
text-gray-900 dark:text-gray-100
text-gray-600 dark:text-gray-300

<!-- Borders -->
border-gray-300 dark:border-gray-600

<!-- Focus States -->
focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
```

### Transition Classes

```css
.theme-transition {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
```

## 🔧 Implementation for New Pages

### 1. Layout Usage

```blade
<!-- For guest pages -->
<x-guest-layout>
  <!-- Your content with dark mode classes -->
</x-guest-layout>

<!-- For authenticated pages -->
<x-app-layout>
  <!-- Your content with dark mode classes -->
</x-app-layout>
```

### 2. Adding Dark Mode to Elements

```blade
<!-- Basic element -->
<div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
  Content
</div>

<!-- With transitions -->
<div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 theme-transition">
  Content with smooth theme transitions
</div>
```

### 3. Creating Theme-Aware Components

```blade
@props(['variant' => 'default'])

@php
$classes = [
    'default' => 'bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100',
    'primary' => 'bg-primary-50 dark:bg-primary-900 text-primary-900 dark:text-primary-100',
];
@endphp

<div {{ $attributes->merge(['class' => $classes[$variant] . ' theme-transition']) }}>
    {{ $slot }}
</div>
```

## 🎪 JavaScript Integration

### Using Theme Manager

```javascript
// Toggle theme
await window.themeManager.toggleTheme();

// Set specific theme
await window.themeManager.setTheme("dark");

// Get current theme
const theme = window.themeManager.getCurrentTheme();

// Check if dark mode
const isDark = window.themeManager.isDarkMode();
```

### Listening to Theme Changes

```javascript
window.addEventListener("theme-changed", (event) => {
    const { theme, isDarkMode } = event.detail;
    console.log(`Theme changed to: ${theme}`);
});
```

### Alpine.js Components

```javascript
// Theme-aware Alpine component
function myComponent() {
    return {
        isDarkMode: window.themeManager?.isDarkMode() || false,

        init() {
            window.addEventListener("theme-changed", (e) => {
                this.isDarkMode = e.detail.isDarkMode;
            });
        },
    };
}
```

## 🔍 Debugging & Troubleshooting

### Theme State Inspection

```javascript
// Check theme configuration
console.log(window.themeManager.getCurrentTheme());

// Check HTML class
console.log(document.documentElement.classList.contains("dark"));

// Check local storage
console.log(localStorage.getItem("healup_theme"));
```

### Server-Side Theme Check

```blade
<!-- In Blade templates -->
Current Theme: {{ $currentTheme }}
Is Dark Mode: {{ $isDarkMode ? 'Yes' : 'No' }}
```

### CSS Debugging

```css
/* Check if dark mode is applied */
html.dark {
    /* Dark mode styles */
}
html:not(.dark) {
    /* Light mode styles */
}
```

## 🚀 Future Enhancements Ready

### 1. Additional Themes

The system is designed to support multiple themes:

```php
// ThemeService.php - Add new themes
const THEMES = [
    'light' => 'Light Theme',
    'dark' => 'Dark Theme',
    'high-contrast' => 'High Contrast',
    'sepia' => 'Sepia Theme'
];
```

### 2. User-Specific Themes

```php
// Add to User model
public function theme()
{
    return $this->hasOne(UserTheme::class);
}
```

### 3. Auto Theme Scheduling

```javascript
// Schedule theme changes
themeManager.scheduleTheme("dark", "18:00");
themeManager.scheduleTheme("light", "06:00");
```

## ✅ Current Implementation Status

### ✅ Completed Features

-   [x] Dark/Light theme switching
-   [x] Server-side theme persistence
-   [x] Client-side theme management
-   [x] Theme toggle component
-   [x] Updated all layouts
-   [x] Updated core UI components
-   [x] Keyboard shortcuts
-   [x] Cross-tab synchronization
-   [x] System preference detection
-   [x] Smooth transitions
-   [x] Accessibility compliance

### 🔄 Ready for Extension

-   [ ] Multiple theme variants
-   [ ] User preference database storage
-   [ ] Theme scheduling
-   [ ] Theme customization UI
-   [ ] Admin theme management
-   [ ] Theme analytics

## 📝 Usage Examples

### Complete Page Example

```blade
<x-guest-layout>
    <!-- Hero Section with Theme Support -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-800 dark:to-gray-900 py-20 theme-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6 theme-transition">
                Welcome to <span class="text-primary-600 dark:text-primary-400">HealUp</span>
            </h1>

            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 theme-transition">
                Your healthcare platform with beautiful themes
            </p>

            <div class="flex gap-4">
                <x-ui.button variant="primary" size="lg">
                    Get Started
                </x-ui.button>

                <x-ui.button variant="outline" size="lg">
                    Learn More
                </x-ui.button>
            </div>
        </div>
    </section>
</x-guest-layout>
```

The theme system is now fully implemented and ready for all current and future pages! 🎉
