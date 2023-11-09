<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index/');
$routes->get('/(:num)', 'Home::index/$1');

$routes->get('/home', 'Page::home');
