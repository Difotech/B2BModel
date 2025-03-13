<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Impostazioni predefinite delle rotte
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Pages::view/home'); // Home page
$routes->get('chi-siamo', 'Pages::view/chi-siamo');
$routes->get('catalogo', 'Pages::view/catalogo');
$routes->get('fai-una-richiesta', 'Pages::view/fai-una-richiesta');
$routes->get('contattaci', 'Pages::view/contattaci');
$routes->get('blog', 'Pages::view/blog');



// Rotte per la gestione delle news
$routes->match(['get', 'post'], 'news/create', 'News::create');
$routes->get('/', 'Home::index');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');

// Rotte per le pagine
$routes->get('pages', 'Pages::index');
$routes->get('(:any)', 'Pages::view/$1');

// ✅ Rotte per la registrazione

$routes->post('register', 'RegisterController::register'); // Elabora il form di registrazione

// Rotte per il login
$routes->get('/login', 'LoginController::login');
$routes->post('/login', 'LoginController::login');

$routes->get('/logout', 'LogoutController::logout');

$routes->get('/catalogo', 'CatalogoController::index');

// Rotta per l'area personale (solo per utenti loggati)
$routes->get('/area-personale', 'LoginController::areaPersonale', ['filter' => 'auth']);

?>

