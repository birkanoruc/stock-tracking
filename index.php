<?php
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* DATABASE */
define("DB_HOST", $_ENV["DB_HOST"]);
define("DB_NAME", $_ENV["DB_NAME"]);
define("DB_USERNAME", $_ENV["DB_USERNAME"]);
define("DB_PASSWORD", $_ENV["DB_PASSWORD"]);

/* DB TYPE */
define("DB_TYPE", $_ENV["DB_TYPE"]);
define("SQLITE_PATH", __DIR__ . "/SQLite/db.sqlite");

/* MVC */
define("CONTROLLERS_PATH", __DIR__ . '/App/Controllers');
define("VIEWS_PATH", __DIR__ . '/App/Views');
define("MODELS_PATH", __DIR__ . '/App/Models');

/* DOMAIN */
define("SITE_URL", $_ENV['SITE_URL']);

/* INCLUDES */
define("PUBLIC_PATH", $_ENV['PUBLIC_PATH']);

/* PERMISSIONS */
define("PERMISSIONS", explode(',', $_ENV['PERMISSIONS']));

spl_autoload_register(function ($class) {
    $paths = [
        'Core/'
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$app = new Core\App();
