<?php

$router->add('/', [
    'controller' => 'HomeController',
    'middlewares' => ['GuestOnly']
]);

$router->add('/signup', [
    'controller' => 'SignupController',
    'action' => 'index',
    'middlewares' => ['GuestOnly']
]);

$router->add('/signup/process', [
    'controller' => 'SignupController',
    'action' => 'process',
    'services' => ['user.services', 'auth.services', 'validation.services'],
    'middlewares' => ['VerifyCsrfToken']
]);

$router->add('/login', [
    'controller' => 'LoginController',
    'action' => 'index',
    'middlewares' => ['GuestOnly']
]);

$router->add('/login/process', [
    'controller' => 'LoginController',
    'action' => 'process',
    'services' => ['user.services', 'auth.services', 'validation.services'],
    'middlewares' => ['VerifyCsrfToken']
]);

$router->add('/logout', [
    'controller' => 'LogoutController',
    'action' => 'index',
    'services' => ['auth.services'],
    'middlewares' => []
]);

$router->add('/dashboard', [
    'controller' => 'DashboardController',
    'action' => 'index',
    'services' => ['data.services'],
    'middlewares' => ['AuthOnly']
]);

$router->add('/create', [
    'controller' => 'Userdata\\CreateController',
    'middlewares' => ['AuthOnly']
]);

$router->add('/create/process', [
    'controller' => 'Userdata\\CreateController',
    'action' => 'process',
    'services' => ['data.services', 'validation.services'],
    'middlewares' => ['VerifyCsrfToken']
]);

$router->add('/delete', [
    'controller' => 'Userdata\\DeleteController',
    'services' => ['data.services'],
    'middlewares' => ['VerifyCsrfToken']
]);




