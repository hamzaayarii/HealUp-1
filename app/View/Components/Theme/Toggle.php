<?php

namespace App\View\Components\Theme;

use Illuminate\View\Component;
use App\Services\ThemeService;

class Toggle extends Component
{
    public $currentTheme;
    public $isDarkMode;
    public $buttonClasses;
    public $size;

    /**
     * Create a new component instance.
     */
    public function __construct($size = 'md', $buttonClasses = '')
    {
        $themeService = app(ThemeService::class);
        $this->currentTheme = $themeService->getCurrentTheme();
        $this->isDarkMode = $themeService->isDarkMode();
        $this->size = $size;
        $this->buttonClasses = $buttonClasses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.theme.toggle');
    }
}
