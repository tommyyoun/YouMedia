<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginController::index');
$routes->get('/register', 'RegisterController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->match(['get', 'post'], 'authenticate', 'LoginController::loginAuth');
$routes->match(['get', 'post'], 'register', 'RegisterController::register');
//$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authGuard']);

// Quiz
$routes->get('/quiz', 'QuizController::index');
$routes->match(['get', 'post'], 'quiz-login', 'QuizController::loginAuth');
$routes->get('/quizCompleted', 'QuizController::complete');

// File CRUD
$routes->get('/dashboard/home', 'FileController::index', ['filter' => 'authGuard']);
$routes->get('/dashboard/upload', 'FileController::create', ['filter' => 'authGuard']);
$routes->post('/dashboard/store', 'FileController::store', ['filter' => 'authGuard']);
$routes->get('/dashboard/edit/(:num)', 'FileController::edit/$1', ['filter' => 'authGuard']);
$routes->post('/dashboard/update/(:num)', 'FileController::update/$1', ['filter' => 'authGuard']);
$routes->get('/dashboard/delete/(:num)', 'FileController::delete/$1', ['filter' => 'authGuard']);
$routes->get('/dashboard/viewComment/(:num)', 'FileController::viewComment/$1', ['filter' => 'authGuard']);
$routes->post('/dashboard/addComment/(:num)', 'FileController::addComment/$1', ['filter' => 'authGuard']);
$routes->get('/dashboard/images', 'FileController::viewImages', ['filter' => 'authGuard']);
$routes->get('/dashboard/audios', 'FileController::viewAudios', ['filter' => 'authGuard']);
$routes->get('/dashboard/videos', 'FileController::viewVideos', ['filter' => 'authGuard']);
$routes->post('/dashboard/search', 'FileController::search', ['filter' => 'authGuard']);

$routes->post('/dashboard/viewComment/(:num)/addLike/(:num)', 'FileController::addLike/$1/$2', ['filter' => 'authGuard']);
$routes->post('/dashboard/viewComment/(:num)/addDislike/(:num)', 'FileController::addDislike/$1/$2', ['filter' => 'authGuard']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
