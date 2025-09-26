/**
 * Theme Manager - Handles theme switching and persistence
 */
class ThemeManager {
    constructor() {
        this.theme = this.getInitialTheme();
        this.init();
    }

    /**
     * Initialize theme manager
     */
    init() {
        this.applyTheme(this.theme);
        this.setupEventListeners();
        this.setupStorageListener();
    }

    /**
     * Get initial theme from various sources
     */
    getInitialTheme() {
        // Check meta tag first
        const metaTheme = document.querySelector('meta[name="theme-config"]');
        if (metaTheme) {
            try {
                const config = JSON.parse(metaTheme.content);
                return config.current;
            } catch (e) {
                console.warn('Failed to parse theme config from meta tag');
            }
        }

        // Check local storage
        const stored = localStorage.getItem('healup_theme');
        if (stored && ['light', 'dark'].includes(stored)) {
            return stored;
        }

        // Check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }

        return 'light';
    }

    /**
     * Apply theme to document
     */
    applyTheme(theme) {
        const html = document.documentElement;

        if (theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        // Update body theme attribute
        document.body.setAttribute('data-theme', theme);

        // Store in localStorage for persistence
        localStorage.setItem('healup_theme', theme);

        this.theme = theme;
    }

    /**
     * Toggle between light and dark theme
     */
    async toggleTheme() {
        const newTheme = this.theme === 'light' ? 'dark' : 'light';

        try {
            // Update server-side preference
            const response = await fetch('/theme/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            });

            if (response.ok) {
                const data = await response.json();
                this.applyTheme(data.theme);

                // Emit custom event
                this.emitThemeChange(data.theme);

                return data.theme;
            } else {
                throw new Error('Server request failed');
            }
        } catch (error) {
            console.warn('Failed to sync theme with server, applying locally only:', error);

            // Apply locally even if server sync fails
            this.applyTheme(newTheme);
            this.emitThemeChange(newTheme);

            return newTheme;
        }
    }

    /**
     * Set specific theme
     */
    async setTheme(theme) {
        if (!['light', 'dark'].includes(theme)) {
            throw new Error('Invalid theme: ' + theme);
        }

        try {
            const response = await fetch('/theme/set', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ theme })
            });

            if (response.ok) {
                const data = await response.json();
                this.applyTheme(data.theme);
                this.emitThemeChange(data.theme);
                return data.theme;
            } else {
                throw new Error('Server request failed');
            }
        } catch (error) {
            console.warn('Failed to sync theme with server, applying locally only:', error);
            this.applyTheme(theme);
            this.emitThemeChange(theme);
            return theme;
        }
    }

    /**
     * Emit theme change event
     */
    emitThemeChange(theme) {
        const event = new CustomEvent('theme-changed', {
            detail: {
                theme,
                isDarkMode: theme === 'dark'
            }
        });
        window.dispatchEvent(event);
    }

    /**
     * Setup event listeners
     */
    setupEventListeners() {
        // Listen for system theme changes
        if (window.matchMedia) {
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            mediaQuery.addEventListener('change', (e) => {
                if (!localStorage.getItem('healup_theme')) {
                    // Only auto-switch if user hasn't set a preference
                    this.applyTheme(e.matches ? 'dark' : 'light');
                    this.emitThemeChange(e.matches ? 'dark' : 'light');
                }
            });
        }

        // Listen for keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + Shift + D to toggle theme
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'D') {
                e.preventDefault();
                this.toggleTheme();
            }
        });
    }

    /**
     * Setup storage listener for cross-tab synchronization
     */
    setupStorageListener() {
        window.addEventListener('storage', (e) => {
            if (e.key === 'healup_theme' && e.newValue !== this.theme) {
                this.applyTheme(e.newValue || 'light');
                this.emitThemeChange(e.newValue || 'light');
            }
        });
    }

    /**
     * Get current theme
     */
    getCurrentTheme() {
        return this.theme;
    }

    /**
     * Check if current theme is dark
     */
    isDarkMode() {
        return this.theme === 'dark';
    }
}

// Initialize theme manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.themeManager = new ThemeManager();
});

// Make it available globally
window.ThemeManager = ThemeManager;
