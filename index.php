<?php
/**
 * This is the first file loaded and only meant to initialize
 * the application modules.
 */

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// define global constant path to app/ root
if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', realpath(__DIR__));
}

// configs for applications modules
$appConfig = include APPLICATION_PATH . '/config/module.config.php';

// initialize the autoloader
include APPLICATION_PATH . '/vendor/autoload.php';

// configs for development only, remove before deploy to production
if (file_exists(APPLICATION_PATH . '/config/development.config.php')) {
    $appConfig = array_merge($appConfig, include APPLICATION_PATH . '/config/development.config.php');
}

// config for global configurations
if (file_exists(APPLICATION_PATH . '/config/global.config.php')) {
    $appConfig = array_merge($appConfig, include APPLICATION_PATH . '/config/global.config.php');
}

// Run the application!
Lightweight\Application::init($appConfig)->run();
