<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match([ 'get', 'post' ], '/', 'UserController::index', [ 'filter'  =>  'noauth'  ]);
$routes->match([ 'get', 'post' ], '/register', 'UserController::register', [ 'filter'  =>  'noauth'  ]);
$routes->get('/dashboard', 'Dashboard::index', [ 'filter'  =>  'auth'  ]);
$routes->get('/logout', 'UserController::logout');
$routes->match([ 'get', 'post' ], '/edituser/(:num)', 'Dashboard::edit/$1', [ 'filter'  =>  'auth'  ]);
$routes->set404Override(function (){
    echo view( '404' );
});