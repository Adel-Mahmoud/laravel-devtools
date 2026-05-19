# Laravel DevTools 🛠️

[![Latest Version on Packagist](https://img.shields.io/packagist/v/adel-mahmoud/devtools.svg)](https://packagist.org/packages/adel-mahmoud/devtools)
[![Total Downloads](https://img.shields.io/packagist/dt/adel-mahmoud/devtools.svg)](https://packagist.org/packages/adel-mahmoud/devtools)
[![License](https://img.shields.io/packagist/l/adel-mahmoud/devtools.svg)](https://github.com/Adel-Mahmoud/laravel-devtools/blob/main/LICENSE)

A powerful Laravel package that allows you to run Artisan commands using keyboard shortcuts with a beautiful toast notification system.

## 🚀 Features

- **Keyboard Shortcuts** - Run Artisan commands with `Alt + Key` combinations
- **Secure by Design** - Environment-based restrictions and middleware support
- **Fully Configurable** - Custom commands, middleware, and toast settings
- **Auto CSRF Protection** - Built-in CSRF token handling
- **Beautiful Toast Notifications** - Visual feedback for command execution
- **Easy Installation** - One command installation process

## 📋 Requirements

- PHP 8.1 or higher
- Laravel 10.x, 11.x, 12.x, or 13.x

## 🔧 Installation

```bash
composer require adel-mahmoud/devtools --dev
⚙️ Configuration
Publish the configuration file:

bash
php artisan devtools:install
Or manually publish:

bash
php artisan vendor:publish --provider="Adel\DevTools\DevToolsServiceProvider" --tag="devtools-config"
🎯 Usage
Add the script to your main layout file (e.g., resources/views/layouts/app.blade.php):

blade
@devtoolsScript
Default Shortcuts
Shortcut	Command	Description
Alt + C	optimize:clear	Clear all optimization caches
Alt + M	migrate	Run database migrations
Alt + S	storage:link	Create storage symbolic link
Alt + Q	queue:restart	Restart queue workers
Alt + R	route:clear	Clear route cache
Alt + V	view:clear	Clear compiled views
Custom Shortcuts
Edit config/devtools.php:

php
'commands' => [
    'd' => [
        'command' => 'down',
        'method' => 'POST',
        'route' => '/down',
        'label' => 'Put Application Down',
    ],
    'u' => [
        'command' => 'up',
        'method' => 'POST',
        'route' => '/up',
        'label' => 'Bring Application Up',
    ],
],
🔒 Security
The package includes multiple security layers:

Environment Restriction - Only works in local, development, or staging

Middleware Support - Add auth, admin, or custom middleware

Enable/Disable Toggle - Use DEVTOOLS_ENABLED=false in production

Add Authentication
php
// config/devtools.php
'middleware' => ['web', 'auth'],
🌍 Environment Variables
env
DEVTOOLS_ENABLED=true  # Enable/disable the package
📝 Advanced Configuration
Custom Toast Settings
php
'toast' => [
    'duration' => 3000,
    'position' => 'bottom-right',
    'success_color' => '#10b981',
    'error_color' => '#ef4444',
],
Command Options
php
'm' => [
    'command' => 'migrate',
    'method' => 'POST',
    'route' => '/migrate',
    'label' => 'Migration',
    'options' => ['--force' => true, '--seed' => true],
],
🐛 Troubleshooting
Script not working?

Ensure @devtoolsScript is added before </body>

Check if DEVTOOLS_ENABLED=true in your .env

Verify you're in a development environment

Commands not executing?

Check Laravel logs: storage/logs/laravel.log

Verify CSRF token exists in your layout

Ensure routes are registered: php artisan route:list | grep devtools

📦 Publishing Views
To customize the JavaScript:

bash
php artisan vendor:publish --provider="Adel\DevTools\DevToolsServiceProvider" --tag="devtools-views"
🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

📄 License
The MIT License (MIT). Please see License File for more information.