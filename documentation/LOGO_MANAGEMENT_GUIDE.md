# 🎨 HealUp Logo Management Guide

## 🎯 Overview

This guide shows you how to customize and manage logos across your HealUp application. The logo system supports both light and dark themes with multiple size variants.

## 📍 Logo Locations

### 1. **Main Navigation Logo**

-   **File**: `resources/views/components/ui/logo.blade.php`
-   **Usage**: `<x-ui.logo />`
-   **Size**: Default h-8 (32px)
-   **Location**: Header navigation, welcome page

### 2. **Authentication Logo**

-   **File**: `resources/views/components/authentication-card-logo.blade.php`
-   **Usage**: Automatic on login/register pages
-   **Size**: 64px (size-16)
-   **Location**: Login, register, password reset pages

### 3. **Application Logo** (Laravel Default)

-   **File**: `resources/views/components/application-logo.blade.php`
-   **Usage**: `<x-application-logo />`
-   **Note**: Used by some Jetstream components

### 4. **Application Mark** (Small Icon)

-   **File**: `resources/views/components/application-mark.blade.php`
-   **Usage**: `<x-application-mark />`
-   **Note**: Small icon version for compact spaces

## 🔧 Logo Implementation Options

### **Option 1: Image Files (Professional)**

#### **Step 1: Prepare Your Logo Files**

Create your logo files in these formats and sizes:

**Required Files:**

```
public/images/logos/
├── healup-logo-light.svg (or .png)    # Main logo for light theme
├── healup-logo-dark.svg (or .png)     # Main logo for dark theme
├── healup-icon-light.svg (or .png)    # Icon only - light theme
├── healup-icon-dark.svg (or .png)     # Icon only - dark theme
└── healup-favicon.ico                 # Browser favicon
```

**Recommended Sizes:**

-   **Main Logo**: 200x60px (SVG preferred for scalability)
-   **Icon**: 64x64px (square)
-   **Favicon**: 32x32px (.ico format)

#### **Step 2: Logo Component Usage**

```blade
{{-- Different logo variants --}}
<x-ui.logo />                    <!-- Full logo (default) -->
<x-ui.logo type="icon" />        <!-- Icon only -->
<x-ui.logo type="text" />        <!-- Text only -->
<x-ui.logo class="h-12" />       <!-- Custom size -->
```

### **Option 2: SVG Code (Customizable)**

Create inline SVG logos directly in the components:

```blade
{{-- Example custom SVG logo --}}
<svg viewBox="0 0 120 40" class="w-full h-full">
    {{-- Your custom SVG paths here --}}
    <path d="..." fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
    <text x="40" y="25" class="fill-current text-gray-900 dark:text-gray-100 font-bold">
        HealUp
    </text>
</svg>
```

### **Option 3: Text-Based Logo (Quick)**

Current implementation - styled text with medical icon:

```blade
<div class="flex items-center space-x-2">
    <svg><!-- Medical cross icon --></svg>
    <span class="font-bold text-lg">
        Heal<span class="text-primary-600">Up</span>
    </span>
</div>
```

## 🎨 Current Logo Features

### ✅ **Implemented Features:**

-   **Theme Awareness**: Different styles for light/dark modes
-   **Responsive Sizing**: Scalable with Tailwind classes
-   **Multiple Variants**: Full logo, icon only, text only
-   **Accessibility**: Proper alt text and ARIA labels
-   **Smooth Transitions**: Theme switching animations
-   **Consistent Branding**: Same design language across all pages

### **Logo Variants Available:**

1. **Full Logo** (Default)

    - Medical cross icon + "HealUp" text
    - Used in headers and main navigation
    - Theme-aware colors

2. **Icon Only**

    - Just the medical cross symbol
    - For compact spaces, mobile menus
    - Maintains brand recognition

3. **Text Only**
    - "HealUp" with stylized text
    - For minimal designs
    - Includes small icon accent

## 📱 Usage Examples

### **In Headers:**

```blade
{{-- Main navigation --}}
<x-ui.logo class="h-8" />

{{-- Large header --}}
<x-ui.logo class="h-12" />

{{-- Mobile menu --}}
<x-ui.logo type="icon" class="h-8" />
```

### **In Authentication Pages:**

The authentication logo is automatically used and sized appropriately.

### **In Welcome/Marketing Pages:**

```blade
{{-- Hero section --}}
<x-ui.logo class="h-16" />

{{-- Footer --}}
<x-ui.logo type="text" class="h-6" />
```

## 🔄 How to Replace with Custom Logo

### **Method 1: Replace Image Files**

1. **Create your logo files** in the recommended sizes
2. **Save them** to `public/images/logos/` with the correct names:
    - `healup-logo-light.svg`
    - `healup-logo-dark.svg`
    - `healup-icon-light.svg`
    - `healup-icon-dark.svg`
3. **Update the favicon** at `public/favicon.ico`
4. **Test** on different pages and themes

### **Method 2: Modify SVG Code**

1. **Edit** `resources/views/components/ui/logo.blade.php`
2. **Replace** the SVG paths with your custom design
3. **Maintain** the theme-aware color classes
4. **Test** responsiveness and theme switching

### **Method 3: Use Logo Generator**

1. **Create** your logo using:
    - Canva, Figma, Adobe Illustrator
    - Logo generator tools
    - AI logo generators
2. **Export** as SVG for best quality
3. **Follow** Method 1 or 2 above

## 🎯 Logo Design Guidelines

### **Brand Consistency:**

-   Use your primary brand colors
-   Maintain readable contrast ratios
-   Ensure scalability from 16px to 200px
-   Test in both light and dark themes

### **Healthcare Theme:**

-   Medical cross or health-related icons
-   Clean, professional typography
-   Trustworthy color palette (blues, greens)
-   Accessible design elements

### **Technical Requirements:**

-   SVG format preferred for scalability
-   Current color classes for theme switching
-   Proper aspect ratios (3:1 for full logo, 1:1 for icon)
-   Optimized file sizes

## 🚀 Current Status

Your logo system is now:

-   ✅ **Theme-aware** (supports light/dark modes)
-   ✅ **Responsive** (scales properly on all devices)
-   ✅ **Consistent** (same branding across all pages)
-   ✅ **Accessible** (proper alt text and contrast)
-   ✅ **Professional** (clean medical cross design)

You can now either:

1. **Keep the current design** (professional medical cross + text)
2. **Add your custom images** to `public/images/logos/`
3. **Modify the SVG code** for completely custom design

The logo system is ready for immediate use and easy customization! 🎨
