<?php

require_once __DIR__ . '/controller/UserController.php';
require_once 'index.php';

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

$routes = [
    '/' => '/views/login.php',
    '/users'=> '/views/users.php',
    '/create' => '/views/create.php',
    '/edit' => '/views/edit.php',
    '/logout' => '/views/logout.php'
];

if (array_key_exists($path, $routes)){
    require_once __DIR__ . $routes[$path];
}else {
    http_response_code(404);
    echo '404 You are not human';
}