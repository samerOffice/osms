<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

use Illuminate\Support\Facades\DB;

// Check if the database connection is working
try {
    DB::connection()->getPdo();
} catch (\Exception $e) {
    echo "Warning: Could not connect to the database. Please check your configuration or run php artisan migrate";
}

// Return the application instance
return $app;
