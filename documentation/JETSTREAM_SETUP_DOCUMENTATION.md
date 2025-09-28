# Laravel Jetstream Authentication Setup Documentation

## 📋 Project Overview

**Project Name:** HealUp  
**Laravel Version:** 12.x  
**Authentication Stack:** Laravel Jetstream with Livewire  
**Setup Date:** September 26, 2025

## 🚀 Complete Setup Commands

### 1. Initial Laravel Project Creation

```bash
composer create-project --prefer-dist laravel/laravel:^12.0 healUp
cd healUp
```

### 2. Install Laravel Jetstream

```bash
composer require laravel/jetstream
```

### 3. Install Jetstream with Livewire Stack

```bash
php artisan jetstream:install livewire
```

### 4. Install Frontend Dependencies

```bash
pnpm install
pnpm run build
```

### 5. Database Migration

```bash
# Remove duplicate migration file (if exists)
Remove-Item "database\migrations\2025_09_26_161407_add_two_factor_columns_to_users_table.php"

# Run fresh migrations
php artisan migrate:fresh
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Start Development Server

```bash
php artisan serve
# Server runs at: http://127.0.0.1:8000
```

## 🔧 Configuration Files Modified

### `.env` Configuration

```env
# Application Settings
APP_NAME=HealUp
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healUp
DB_USERNAME=root
DB_PASSWORD=

# Email Configuration (Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hamzosayari07@gmail.com
MAIL_PASSWORD="uwzk orzv sdat vukv"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hamzosayari07@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

# Session Configuration
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Jetstream Features
FORTIFY_FEATURES=registration,reset-passwords,email-verification,update-profile-information,update-passwords,two-factor-authentication
JETSTREAM_FEATURES=profile-photos,api,teams
```

### `config/fortify.php` - Email Verification Enabled

```php
'features' => [
    Features::registration(),
    Features::resetPasswords(),
    Features::emailVerification(),  // ✅ ENABLED
    Features::updateProfileInformation(),
    Features::updatePasswords(),
    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]),
],
```

### `config/jetstream.php` - Features Enabled

```php
'features' => [
    Features::termsAndPrivacyPolicy(),  // ✅ ENABLED
    Features::profilePhotos(),          // ✅ ENABLED
    // Features::api(),
    // Features::teams(['invitations' => true]),
    Features::accountDeletion(),        // ✅ ENABLED
],
```

### `app/Models/User.php` - Email Verification

```php
// Added MustVerifyEmail interface
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ... existing code
}
```

## 📁 Files Created by Jetstream

### Authentication Views

```
resources/views/auth/
├── confirm-password.blade.php
├── forgot-password.blade.php
├── login.blade.php
├── register.blade.php
├── reset-password.blade.php
├── two-factor-challenge.blade.php
└── verify-email.blade.php
```

### Profile Management Views

```
resources/views/profile/
├── delete-user-form.blade.php
├── logout-other-browser-sessions-form.blade.php
├── show.blade.php
├── two-factor-authentication-form.blade.php
├── update-password-form.blade.php
└── update-profile-information-form.blade.php
```

### Layout & Components

```
resources/views/
├── dashboard.blade.php
├── navigation-menu.blade.php
├── policy.blade.php
├── terms.blade.php
└── layouts/
    └── app.blade.php
```

### Database Migrations Created

```
database/migrations/
├── 2025_09_26_160232_add_two_factor_columns_to_users_table.php
├── 2025_09_26_160331_create_personal_access_tokens_table.php
├── 2025_09_26_160331_create_teams_table.php
├── 2025_09_26_160332_create_team_user_table.php
└── 2025_09_26_160333_create_team_invitations_table.php
```

## 🌐 Available Routes

### Public Routes (No Authentication Required)

-   `/` - Welcome page
-   `/login` - User login form
-   `/register` - User registration form
-   `/forgot-password` - Password reset request
-   `/reset-password` - Password reset form

### Protected Routes (Authentication Required)

-   `/dashboard` - User dashboard (requires email verification)
-   `/user/profile` - Profile management page
-   `/user/two-factor-challenge` - 2FA verification

### Email Verification Routes

-   `/email/verify` - Email verification notice
-   `/email/verify/{id}/{hash}` - Email verification link

## 🎯 Authentication Features Enabled

### ✅ Core Features

-   [x] **User Registration** - Complete signup process
-   [x] **User Login/Logout** - Secure authentication
-   [x] **Email Verification** - Required for new users
-   [x] **Password Reset** - Via email links
-   [x] **Profile Management** - Update user information
-   [x] **Profile Photos** - Upload and manage avatars
-   [x] **Password Updates** - Change passwords securely

### ✅ Advanced Security Features

-   [x] **Two-Factor Authentication (2FA)** - TOTP with QR codes
-   [x] **Session Management** - View and terminate active sessions
-   [x] **Account Deletion** - Self-service account removal
-   [x] **Terms & Privacy Policy** - Legal compliance

### ✅ Database Tables

-   [x] `users` - User accounts with 2FA columns
-   [x] `sessions` - Active user sessions
-   [x] `personal_access_tokens` - API tokens
-   [x] `teams` - Team management (optional)
-   [x] `team_invitations` - Team invites (optional)

## 🧪 Testing Instructions

### 1. Registration Test

1. Go to `http://127.0.0.1:8000/register`
2. Fill form with valid email
3. Check email for verification link
4. Click verification link
5. Should redirect to dashboard

### 2. Login Test

1. Go to `/login`
2. Enter credentials
3. Should redirect to dashboard
4. Test logout functionality

### 3. Password Reset Test

1. Go to `/forgot-password`
2. Enter email address
3. Check email for reset link
4. Set new password
5. Login with new password

### 4. Profile Management Test

1. Login and go to `/user/profile`
2. Update profile information
3. Upload profile photo
4. Change password
5. Test session management

### 5. Two-Factor Authentication Test

1. Enable 2FA in profile settings
2. Scan QR code with authenticator app
3. Enter confirmation code
4. Save recovery codes
5. Test login with 2FA

## 🔍 Authentication Storage

Laravel Jetstream uses **HTTP-only cookies** and **server-side sessions**, NOT localStorage.

### Browser Cookies Location

-   **Chrome/Edge:** DevTools → Application → Cookies → `http://127.0.0.1:8000`
-   **Firefox:** DevTools → Storage → Cookies

### Key Cookies

-   `laravel_session` - Main session identifier
-   `XSRF-TOKEN` - CSRF protection token

### Database Sessions

Sessions stored in `sessions` table (SESSION_DRIVER=database)

## 🚨 Troubleshooting

### Common Issues & Solutions

**Server not starting:**

```bash
php artisan serve
```

**Email not sending:**

-   Check Gmail app password in `.env`
-   Verify MAIL_PASSWORD is quoted: `"uwzk orzv sdat vukv"`

**Database errors:**

```bash
php artisan migrate:fresh
```

**Frontend assets not loading:**

```bash
pnpm run build
```

**Clear cache issues:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

## 📞 Support Commands

### Check Routes

```bash
php artisan route:list --name=login
php artisan route:list --name=register
```

### Check Database

```bash
php artisan tinker --execute="echo 'Users: ' . App\Models\User::count();"
```

### View Logs

```bash
Get-Content storage\logs\laravel.log -Tail 20
```

## 🎨 Customization Notes

### For Future Blade Layout Integration

-   Main layout: `resources/views/layouts/app.blade.php`
-   Navigation: `resources/views/navigation-menu.blade.php`
-   Auth forms: `resources/views/auth/*.blade.php`
-   Profile forms: `resources/views/profile/*.blade.php`

### Styling Framework

-   **CSS Framework:** Tailwind CSS
-   **JavaScript:** Alpine.js + Livewire
-   **Icons:** Heroicons

---

## 📝 Summary

This documentation covers the complete Laravel Jetstream setup with Livewire for the HealUp project. The setup includes full authentication functionality with email verification, 2FA, profile management, and secure session handling.

**Status:** ✅ Complete and Ready for Development

**Next Steps:**

1. Test all authentication flows
2. Customize views to match your design
3. Add your business logic to protected routes

---

_Created: September 26, 2025_  
_Project: HealUp - Laravel Jetstream Authentication_
