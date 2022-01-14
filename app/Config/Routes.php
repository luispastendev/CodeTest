<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('CodeTest');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('{locale}/contact-us', 'CodeTest::index');
$routes->get('{locale}/contact-list', 'CodeTest::tableForm');
$routes->get('/contacts', 'CodeTest::fetch');
$routes->post('/add', 'CodeTest::add');
$routes->post('/edit', 'CodeTest::edit');
$routes->post('/update', 'CodeTest::update');
$routes->post('/delete', 'CodeTest::delete');



$routes->get('{locale}/reservation', 'ReservationCon::index');
$routes->get('{locale}/reservation-list', 'ReservationCon::tableForm');
//$routes->get('/contacts', 'CodeTest::fetch');
$routes->post('/new', 'ReservationCon::new');
$routes->post('/modif', 'ReservationCon::modif');
$routes->post('/saveChange', 'ReservationCon::saveChange');
$routes->post('/erase', 'ReservationCon::erase');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
