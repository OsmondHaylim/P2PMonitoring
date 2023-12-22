<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index2/1/10');
$routes->get('/(:num)/5', 'Home::index2/$1/5');
$routes->get('/(:num)', 'Home::index2/$1/10');
$routes->get('/(:num)/10', 'Home::index2/$1/10');
$routes->get('/(:num)/20', 'Home::index2/$1/20');

$routes->get('/kc/(:segment)','Home::kc2/$1/1/10');
$routes->get('/kc/(:segment)/(:num)','Home::kc2/$1/$2/10');
$routes->get('/kc/(:segment)/(:num)/5','Home::kc2/$1/$2/5');
$routes->get('/kc/(:segment)/(:num)/10','Home::kc2/$1/$2/10');
$routes->get('/kc/(:segment)/(:num)/20','Home::kc2/$1/$2/20');

$routes->get('/rm/(:segment)','Home::rm2/$1/1/10');
$routes->get('/rm/(:segment)/(:num)','Home::rm2/$1/$2/10');
$routes->get('/rm/(:segment)/(:num)/5','Home::rm2/$1/$2/5');
$routes->get('/rm/(:segment)/(:num)/10','Home::rm2/$1/$2/10');
$routes->get('/rm/(:segment)/(:num)/20','Home::rm2/$1/$2/20');

$routes->get('/rm/all','Home::rm');

$routes->add('/add', 'Home::add');
$routes->add('/edit/$id', 'Home::edit/$1');
$routes->get('/delete/$id', 'Home::delete/$1');
$routes->add('/csv', 'Home::addByCSV');
$routes->add('/csv/updated', 'Home::updatedCSV');
$routes->add('/csv/monthly', 'Home::monthlyCSV');
$routes->add('/csv/cabang', 'Home::cabangCSV');
$routes->add('/admin', 'Home::admin');




// $routes->get('/home', 'Page::home');
