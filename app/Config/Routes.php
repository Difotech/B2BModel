<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Impostazioni predefinite delle rotte
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Pages::view/home'); // Home page
$routes->get('chi-siamo', 'Pages::view/chi-siamo');
$routes->get('fai-una-richiesta', 'Pages::view/fai-una-richiesta');
$routes->get('contattaci', 'Pages::view/contattaci');
$routes->get('blog', 'Pages::view/blog');


$routes->get('base-pizza', 'Pages::view/base-pizza');
$routes->get('panzerotto', 'Pages::view/panzerotto');



// ✅ Rotte per la registrazione

$routes->post('register', 'RegisterController::register'); // Elabora il form di registrazione

// Rotte per il login
$routes->get('/login1', 'LoginController::login');
$routes->post('/login1', 'LoginController::login');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/catalogo1', 'CatalogoController::index');




$routes->post('/faiunarichiesta1', 'PreventivoController::store');
$routes->post('elimina-preventivo', 'PreventivoController::eliminaPreventivo');

$routes->get('/area-personale1', 'LoginController::areaPersonale');
$routes->post('/contattaci1', 'ContattaciController::invia');
$routes->get('/get-users', 'AreaPersonaleAdminController::getUsers');
$routes->post('/delete-user', 'AreaPersonaleAdminController::deleteUser');
$routes->post('/add-product', 'AreaPersonaleAdminController::addProduct');
$routes->post('/delete-product', 'AreaPersonaleAdminController::deleteProduct');
$routes->post('/update-preventivo-status', 'AreaPersonaleAdminController::updatePreventivoStatus');
$routes->get('/get-all-preventivi', 'AreaPersonaleAdminController::getAllPreventivi');


$routes->get('pages', 'Pages::index');
$routes->get('(:any)', 'Pages::view/$1');
// Rotta per l'area personale (solo per utenti loggati)



?>

