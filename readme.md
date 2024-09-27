# Multi-DB Laravel Package Documentation

## Overview

The **Multi-DB** package is a Laravel library that offers utility functions for seamless management and operations across multiple databases. It allows developers to easily switch between database connections and run database-specific migrations with simple commands.

---

## Installation

To install the **Multi-DB** package, add it to your Laravel project using Composer:

```bash
composer require faraztanveer/multi-db
```

### Requirements:

- PHP: `^7.3|^8.0`
- Laravel: `^8.0 || ^9.0 || ^10.0`

Once installed, the package will automatically register its service provider.

---

## Configuration

By default, no additional configuration is required. However, you can publish the package's configuration file for customization:

```bash
php artisan vendor:publish --provider="MultiDB\MultiDBServiceProvider"
```

---

## Features and Usage

### 1. Switch Between Databases

The `DatabaseShifter` class lets you dynamically switch database connections at runtime.

#### Example: Switching to a New Database

```php
// Access the multidb instance
$db = app('multidb');

// Shift to a new database connection
$db->shift('new_database', 'new_host', 'new_username', 'new_password', 'new_port');
```

### 2. Reset to Default Database

To revert back to the default database defined in your `.env` file:

```php
$db->setDefaultDb();
```

### 3. Get the Current Database Name

You can retrieve the current database name at runtime using:

```php
$db->currentDb();
```

---

## Migrations for Specific Databases

This package provides a custom Artisan command that allows you to run migrations on a specific database connection.

### Command: `multidb:migrate`

Run migrations for a specific database using this command:

```bash
php artisan multidb:migrate --database=your_database --path=path/to/migrations --host=127.0.0.1 --username=root --password=your_password --port=3306
```

**Options:**

- `--database` (required): Specify the name of the database.
- `--path`: Path to the migration files (optional).
- `--host`: Database host (default: `127.0.0.1`).
- `--username`: Database username (default: `root`).
- `--password`: Database password (optional).
- `--port`: Database port (default: `3306`).
- `--force`: Run migrations in production without confirmation.

Once the migrations are complete, the connection will automatically reset to the default database.

---

## License

This package is licensed under the MIT License. For more information, refer to the [LICENSE](LICENSE) file in the repository.

---

## Contribution

Contributions are welcome! Feel free to submit issues, suggestions, or pull requests to improve this package.

**GitHub Repository:** [Link to repository](https://github.com/faraztanveer/db-shifter)
