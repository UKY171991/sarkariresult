<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['get','post'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->match(['get','post'], 'register', 'Auth::register');

// Category listing (mirror SarkariExam top menu slugs)
$routes->get('category/(:segment)', 'Category::index/$1');

// Admin Routes (protected)
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
	$routes->get('/', 'Admin\\Dashboard::index');
	$routes->get('posts', 'Admin\\Posts::index');
	$routes->match(['get','post'], 'posts/create', 'Admin\\Posts::create');
	$routes->match(['get','post'], 'posts/edit/(:num)', 'Admin\\Posts::edit/$1');
	$routes->get('posts/delete/(:num)', 'Admin\\Posts::delete/$1');
});
