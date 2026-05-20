
# Laravel DevTools

A lightweight and secure developer toolkit for Laravel applications that allows you to execute predefined Artisan commands directly from the browser using keyboard shortcuts.

---

## Features

- Execute Artisan commands instantly from the browser
- Keyboard shortcuts support (works with Arabic/English keyboards)
- Secure command execution with middleware & environment protection
- Configurable commands whitelist
- Toast notifications for success/error messages
- CSRF protection & rate limiting
- Command confirmation for dangerous operations
- Supports Laravel 10, 11, and 12
- Easy installation, zero frontend dependencies

---

## Why Laravel DevTools?

During development, developers constantly run commands such as:

```bash
php artisan optimize:clear
php artisan migrate
php artisan queue:restart
php artisan cache:clear
```

Instead of switching to the terminal repeatedly, Laravel DevTools allows you to execute these commands directly inside the browser using keyboard shortcuts.

---

## Installation

### Install via Composer

```bash
composer require adel-mahmoud/devtools --dev
```

### Publish Package Files

```bash
php artisan devtools:install
```

This command publishes:
- Configuration file (`config/devtools.php`)
- Views

### Add Script Directive

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

## Default Shortcuts

| Shortcut | Command | Description |
|----------|---------|-------------|
| `Alt + C` | `optimize:clear` | Clear all application caches |
| `Alt + M` | `migrate` | Run database migrations (with confirmation) |
| `Alt + S` | `storage:link` | Create symbolic link from `public/storage` to `storage/app/public` |
| `Alt + Q` | `queue:restart` | Restart queue worker daemons |
| `Alt + R` | `route:clear` | Clear the route cache |
| `Alt + V` | `view:clear` | Clear all compiled view files |

> **Note:** The `migrate` command includes `--force` option and requires user confirmation before execution.

---

## Configuration

The package configuration file is published to:

```php
config/devtools.php
```

### Full Configuration Example

```php
<?php

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
            'options' => [
                '--force' => true,
            ],
        ],

        's' => [
            'command' => 'storage:link',
            'route' => 'storage-link',
            'description' => 'Create storage symbolic link',
            'confirm' => false,
        ],

        'q' => [
            'command' => 'queue:restart',
            'route' => 'queue-restart',
            'description' => 'Restart queue workers',
            'confirm' => false,
        ],

        'r' => [
            'command' => 'route:clear',
            'route' => 'route-clear',
            'description' => 'Clear route cache',
            'confirm' => false,
        ],

        'v' => [
            'command' => 'view:clear',
            'route' => 'view-clear',
            'description' => 'Clear compiled views',
            'confirm' => false,
        ],

    ],

];
```

---

## Security

Laravel DevTools was designed with security in mind.

### Middleware Protection

You can protect routes using middleware:

```php
'middleware' => [
    'web',
    'auth',           // Requires authentication
    'verified',       // Requires email verification
    'can:admin',      // Requires specific permissions
    'throttle:10,1',  // Rate limiting
]
```

### Environment Protection

Commands only work in allowed environments. This prevents accidental command execution in production:

```php
'allowed_environments' => [
    'local',
    'development',
    'staging',  // Add if needed
]
```

### Command Whitelist

Only commands explicitly defined in the `commands` array can be executed. This prevents arbitrary Artisan command execution.

### Rate Limiting

Protects against brute force attacks:

```php
'throttle:10,1'  // 10 requests per minute
```

### Command Confirmation

For dangerous commands (like `migrate`), set `'confirm' => true` to require user confirmation before execution.

---

## Keyboard Support

The package uses `event.code` instead of `event.key`, which fixes keyboard shortcut issues with:
- Arabic keyboards
- Different keyboard layouts (QWERTY, AZERTY, etc.)
- International keyboards

---

## Custom Commands

You can define your own shortcuts by adding entries to the `commands` array:

```php
'x' => [
    'command' => 'cache:clear',
    'route' => 'cache-clear',
    'description' => 'Clear application cache',
    'confirm' => false,
    'options' => [],  // Optional Artisan command options
],
```

Usage: Press `Alt + X`

---

## Route Structure

All package routes are prefixed automatically:

```
/devtools/*
```

Example routes:
- `/devtools/optimize-clear`
- `/devtools/migrate`
- `/devtools/storage-link`

---

## Package Structure

```
src/
├───Commands
├───Http
│   ├───Controllers
│   └───Middleware
├───resources
│   └───views
└───routes
└── config/                
```

---

## Recommended Usage

**Recommended for:**
- Local development environments
- Internal admin panels with authentication
- Development and QA environments
- Staging servers with restricted access

**Not recommended for:**
- Public production access without additional protection
- Shared hosting environments without IP whitelisting
- Any environment where unauthorized access is possible

---

## Troubleshooting

### Shortcuts Not Working

1. **Ensure the script directive exists:**
   ```blade
   @devtoolsScript
   ```

2. **Check browser console for errors:**
   ```
   F12 → Console
   ```

3. **Verify routes are registered:**
   ```bash
   php artisan route:list | grep devtools
   ```

4. **Clear application caches:**
   ```bash
   php artisan optimize:clear
   ```

5. **Ensure correct environment:**
   ```env
   APP_ENV=local
   DEVTOOLS_ENABLED=true
   ```

6. **Check if shortcuts conflict with browser defaults:**
   - Some browsers reserve certain shortcuts
   - Try different key combinations

### Command Execution Fails

1. **Check middleware permissions** - Ensure authenticated if using `auth`
2. **Verify environment** - Confirm `APP_ENV` is in `allowed_environments`
3. **Check rate limiting** - Wait if you exceeded the rate limit
4. **Review Laravel logs** - `storage/logs/laravel.log`

---

## Best Practices

- ✅ Always use `auth` middleware in non-local environments
- ✅ Never enable in public production without additional protection
- ✅ Use `'confirm' => true` for destructive commands (migrate, etc.)
- ✅ Keep command whitelist minimal (only what you need)
- ✅ Use rate limiting to prevent abuse
- ✅ Monitor logs for unexpected command execution
- ✅ Consider IP whitelisting for sensitive environments

---

## Compatibility

| Laravel Version | PHP Version | Supported |
|----------------|-------------|-----------|
| Laravel 10     | PHP 8.1+    | ✅ Yes    |
| Laravel 11     | PHP 8.2+    | ✅ Yes    |
| Laravel 12     | PHP 8.2+    | ✅ Yes    |

---

## Future Improvements

Planned features:
- UI command palette (Ctrl/Cmd + K style)
- Live command output streaming
- WebSocket support for real-time feedback
- Command execution history
- User-specific permissions
- Multi-key shortcuts (e.g., Ctrl+Shift+C)
- Dark mode support
- Live log viewer

---

## License

MIT License - feel free to use and modify as needed.

---

## Author

**Adel Mahmoud**

- GitHub: [https://github.com/Adel-Mahmoud](https://github.com/Adel-Mahmoud)
- Packagist: [https://packagist.org/packages/adel-mahmoud/devtools](https://packagist.org/packages/adel-mahmoud/devtools)

---

## Contributing

Issues and pull requests are welcome! If you find discrepancies between documentation and code, please open an issue.
