<?php

namespace Core;

// Define base path
define('BASE_PATH', __DIR__);

// Import functions
require_once BASE_PATH . '/core/functions.php';

// Import config
$config = require_once BASE_PATH . '/config.php';

// Initialize autoloader
require_once BASE_PATH . '/core/Autoloader.php';
Autoloader::init($config['autoloader'])->register();

// Initialize container
$container = new Container();

// Register database
$container->register('db', function() use ($config){
    return new Database($config['database']);
});

// Register router
$container->register('router', function() use ($container) {
    $router = new Router($container);
    require_once BASE_PATH . '/routes.php';
    return $router;
});

// Register models
$container->register('user.model', function() use ($container) {
    $db = $container->get('db');
    return new \App\Models\User($db);
});

$container->register('data.model', function() use ($container) {
    $db = $container->get('db');
    return new \App\Models\Data($db);
});

// Register repositories
$container->register('user.repository', function() use ($container) {
    $model = $container->get('user.model');
    return new \App\Repositories\UserRepository($model);
});

// Register services
$container->register('user.services', function() use ($container) {
    $repository = $container->get('user.repository');
    return new \App\Services\UserServices($repository);
});

$container->register('auth.services', function() use ($container) {
    $repository = $container->get('user.repository');
    return new \App\Services\AuthServices($repository);
});

$container->register('validation.services', function() use ($container) {
    return new \App\Services\ValidationServices();
});

$container->register('data.services', function() use ($container) {
    $model = $container->get('data.model');
    return new \App\Services\DataServices($model);
});

// Initialize application
Application::init($container)->run();

