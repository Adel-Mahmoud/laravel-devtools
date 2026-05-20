# Laravel DevTools

A lightweight and secure developer toolkit for Laravel applications that allows you to execute predefined Artisan commands directly from the browser using keyboard shortcuts.

---

# Features

- Execute Artisan commands instantly from the browser
- Keyboard shortcuts support
- Secure command execution
- Environment protection
- Middleware protection
- Configurable commands
- Toast notifications
- CSRF protection
- Rate limiting support
- Supports Laravel 10, 11, and 12
- Works with Arabic and English keyboards
- Easy installation
- Zero frontend dependencies

---

# Why Laravel DevTools?

During development, developers constantly run commands such as:

```bash
php artisan optimize:clear
php artisan migrate
php artisan queue:restart
php artisan config:clear
```

Instead of switching to the terminal repeatedly, Laravel DevTools allows you to execute these commands directly inside the browser using keyboard shortcuts.

---

# Installation

## Install via Composer 

```bash
composer require adel-mahmoud/devtools --dev
```

---

# Publish Package Files

```bash
php artisan devtools:install
```

This command publishes:

- Configuration file
- Views

---

# Add Script Directive

Add the directive before the closing `</body>` tag:

```blade
@devtoolsScript
```

Example:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>App</title>
</head>
<body>

    @yield('content')

    @devtoolsScript
</body>
</html>
```

---

# Default Shortcuts

| Shortcut | Command |
|---|---|
| Alt + C | optimize:clear |
| Alt + M | migrate |
| Alt + Q | queue:restart |

---

# Configuration

The package configuration file:

```php
config/devtools.php
```

---

# Example Configuration

```php
return [

    'enabled' => env('DEVTOOLS_ENABLED', true),

    'middleware' => [
        'web',
        'auth',
        'throttle:10,1',
    ],

    'allowed_environments' => [
        'local',
        'development',
    ],

    'commands' => [

        'c' => [
            'command' => 'optimize:clear',
            'route' => 'optimize-clear',
            'description' => 'Clear all caches',
            'confirm' => false,
        ],

        'm' => [
            'command' => 'migrate',
            'route' => 'migrate',
            'description' => 'Run database migrations',
            'confirm' => true,
        ],

    ],

];
```

---

# Security

Laravel DevTools was designed with security in mind.

## Middleware Protection

You can protect routes using middleware:

```php
'middleware' => [
    'web',
    'auth',
]
```

---

# Environment Protection

Commands only work in allowed environments.

Example:

```php
'allowed_environments' => [
    'local',
]
```

This prevents accidental command execution in production.

---

# Rate Limiting

Rate limiting can be added:

```php
'throttle:10,1'
```

This allows:

- 10 requests
- Every 1 minute

---

# Command Whitelist

Only commands defined in the config file can be executed.

This prevents arbitrary Artisan command execution.

---

# Keyboard Support

The package uses:

```js
event.code
```

instead of:

```js
event.key
```

This fixes keyboard shortcut issues with:

- Arabic keyboards
- Different keyboard layouts
- International keyboards

---

# Toast Notifications

The package includes built-in toast notifications for:

- Success messages
- Error messages
- Confirmation messages

---

# Example Usage

Press:

```text
Alt + C
```

Result:

```text
Caches cleared successfully
```

---

# Route Structure

All package routes are prefixed automatically:

```text
/devtools/*
```

Example:

```text
/devtools/optimize-clear
```

---

# Package Structure

```text
src/
├── Commands/
├── Controllers/
├── Middleware/
├── Providers/
├── Services/
├── Support/
├── routes/
├── resources/
│   └── views/
└── config/
```

---

# Recommended Middleware

Recommended production-safe middleware:

```php
'middleware' => [
    'web',
    'auth',
    'verified',
    'can:admin',
    'throttle:10,1',
]
```

---

# Recommended Usage

Recommended for:

- Local development
- Internal admin panels
- Development environments
- QA environments

Not recommended for:

- Public production access
- Shared hosting environments without protection

---

# Troubleshooting

## Shortcuts Not Working

### Ensure the script directive exists

```blade
@devtoolsScript
```

---

### Check browser console

Open:

```text
F12 → Console
```

---

### Verify routes

```bash
php artisan route:list
```

You should see:

```text
/devtools/*
```

---

### Clear caches

```bash
php artisan optimize:clear
```

---

### Ensure local environment

```env
APP_ENV=local
```

---

# Custom Commands

You can define your own shortcuts.

Example:

```php
'x' => [
    'command' => 'cache:clear',
    'route' => 'cache-clear',
    'description' => 'Clear cache',
],
```

Usage:

```text
Alt + X
```

---

# Advanced Example

```php
'commands' => [

    'c' => [
        'command' => 'optimize:clear',
        'route' => 'optimize-clear',
        'description' => 'Clear application caches',
    ],

    'm' => [
        'command' => 'migrate',
        'route' => 'migrate',
        'confirm' => true,
    ],

    's' => [
        'command' => 'storage:link',
        'route' => 'storage-link',
    ],

],
```

---

# Best Practices

- Always use auth middleware
- Never enable in public production without protection
- Use command confirmation for dangerous commands
- Keep command whitelist minimal
- Use rate limiting
- Monitor logs

---

# Compatibility

| Laravel Version | Supported |
|---|---|
| Laravel 10 | Yes |
| Laravel 11 | Yes |
| Laravel 12 | Yes |

---

# Future Improvements

Planned features:

- UI command palette
- Live command output
- WebSocket support
- Command history
- User permissions
- Multi-key shortcuts
- Dark mode
- Live logs

---

# License

MIT License

---

# Author

Adel Mahmoud

GitHub:

https://github.com/Adel-Mahmoud

Packagist:

https://packagist.org/packages/adel-mahmoud/devtools
