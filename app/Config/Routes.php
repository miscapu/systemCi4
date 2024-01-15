<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');
$routes->match([ 'get', 'post' ], '/register', 'UserController::register');
$routes->get('/logout', 'UserController::logout');
