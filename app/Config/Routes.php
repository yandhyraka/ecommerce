<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('master-barang', 'MasterBarang::index');
$routes->post('master-barang/store', 'MasterBarang::store');
$routes->post('master-barang/update/(:any)', 'MasterBarang::update/$1');
$routes->get('master-barang/delete/(:any)', 'MasterBarang::delete/$1');

$routes->get('promo', 'Promo::index');
$routes->post('promo/store', 'Promo::store');
$routes->post('promo/update/(:any)', 'Promo::update/$1');
$routes->get('promo/delete/(:any)', 'Promo::delete/$1');

$routes->get('penjualan', 'Penjualan::index');
$routes->get('penjualan/getDetail/(:any)', 'Penjualan::getDetail/$1');
$routes->post('penjualan/store', 'Penjualan::store');
$routes->get('penjualan/edit/(:any)', 'Penjualan::edit/$1');
$routes->post('penjualan/update/(:any)', 'Penjualan::update/$1');
$routes->get('penjualan/delete/(:any)', 'Penjualan::delete/$1');
