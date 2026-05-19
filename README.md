# Laravel DevTools

## Overview
Lightweight Laravel package to run Artisan commands using keyboard shortcuts.

## Requirements
- PHP ^8.1
- Laravel 10 - 13

## Installation

```bash
composer require adel-mahmoud/devtools --dev
```

Then run:

```bash
php artisan devtools:install
```

## Manual Publish

```bash
php artisan vendor:publish --tag=devtools-config
php artisan vendor:publish --tag=devtools-views
```

## Usage

Add this to your layout:

```blade
@devtoolsScript
```

## Default Shortcuts

- Alt + C → optimize:clear
- Alt + M → migrate
- Alt + S → storage:link
- Alt + Q → queue:restart
- Alt + R → route:clear
- Alt + V → view:clear

## Security

- Enabled only in local/development/staging
- Middleware support
- Can be disabled via DEVTOOLS_ENABLED=false

## License
MIT
