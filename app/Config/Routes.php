<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Admin Routes
$routes->group('admin', static function ($routes) {
	$routes->get('/', 'Admin\\Dashboard::index');
	$routes->get('posts', 'Admin\\Posts::index');
	$routes->match(['get','post'], 'posts/create', 'Admin\\Posts::create');
	$routes->match(['get','post'], 'posts/edit/(:num)', 'Admin\\Posts::edit/$1');
	$routes->get('posts/delete/(:num)', 'Admin\\Posts::delete/$1');
});
