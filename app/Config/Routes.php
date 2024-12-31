<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
$routes->match(['get', 'post'], 'news/create', 'News::create');
$routes->get('/', 'Home::index');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');


$routes->get('pages', 'Pages::index');
$routes->get('(:any)', 'Pages::view/$1');

?>