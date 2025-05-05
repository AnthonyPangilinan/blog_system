<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('api/register', 'Auth::register');
$routes->post('api/login', 'Auth::login');
$routes->get('api/posts', 'Post::index');
$routes->get('api/posts/(:num)', 'Post::show/$1');
$routes->post('api/posts', 'Post::create');
$routes->put('api/posts/(:num)', 'Post::update/$1');
$routes->delete('api/posts/(:num)', 'Post::delete/$1');
$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate'); // Optional if you're handling login
$routes->group('api', function($routes) {
    $routes->post('register', 'Auth::register');
    $routes->post('login', 'Auth::login');
});
