<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index/1/10');
$routes->get('/(:num)/5', 'Home::index/$1/5');
$routes->get('/(:num)', 'Home::index/$1/10');
$routes->get('/(:num)/10', 'Home::index/$1/10');
$routes->get('/(:num)/20', 'Home::index/$1/20');

$routes->get('/kc/(:num)','Home::kc/$1/1/10');
$routes->get('/kc/(:num)/(:num)','Home::kc/$1/$2/10');
$routes->get('/kc/(:num)/(:num)/5','Home::kc/$1/$2/5');
$routes->get('/kc/(:num)/(:num)/10','Home::kc/$1/$2/10');
$routes->get('/kc/(:num)/(:num)/20','Home::kc/$1/$2/20');

$routes->get('/rm','Home::rm');

// $routes->get('/home', 'Page::home');
