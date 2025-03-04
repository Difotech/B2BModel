<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 
// Rotte per la gestione delle news
$routes->match(['get', 'post'], 'news/create', 'News::create');
$routes->get('/', 'Home::index');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');

// Rotte per le pagine
$routes->get('pages', 'Pages::index');
$routes->get('(:any)', 'Pages::view/$1');

// ✅ ROTTA REGISTRAZIONE (corretta e senza duplicati)
$routes->get('register', 'RegisterController::index');  // Mostra il form di registrazione
$routes->post('register', 'RegisterController::register'); // Elabora il form

?>
