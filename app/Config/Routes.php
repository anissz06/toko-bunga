<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/Home', 'Home::index');

$routes->get('/Auth/login', 'Auth::login');
$routes->get('/Auth/register', 'Auth::registerpage');
$routes->get('/Auth/loginpage', 'Auth::loginpage');
$routes->get('/Auth/registerpage', 'Auth::registerpage');
$routes->post('/Auth/login', 'Auth::login');
$routes->post('/Auth/register', 'Auth::register');


$routes->get('Home/', 'Home::index');
$routes->get('/Admin', 'Admin::index');
$routes->get('Admin/', 'Admin::index');

$routes->get('Admin/listbunga', 'Admin::listbunga');
$routes->get('Admin/profile', 'Admin::profile');
$routes->get('Admin/user', 'Admin::listuser');
$routes->get('bunga/(:segment)', 'Admin::detail/$1');
$routes->get('bunga', 'Admin::listbunga'); 
$routes->get('Admin/create', 'Admin::create');
$routes->post('Admin/save', 'Admin::save');
$routes->get('Admin/edit/(:segment)', 'Admin::edit/$1');
$routes->delete('Admin/delete/(:num)', 'Admin::delete/$1');
$routes->post('Admin/update/(:segment)', 'Admin::update/$1');


$routes->get('/Transaksi/add/(:segment)', 'Transaksi::add/$1');
$routes->get('Transaksi/', 'Transaksi::index');
$routes->get('add/(:num)', 'CTransaksiClient::addTransaksi/$1');
$routes->delete('Transaksi/delete/(:num)', 'Transaksi::delete/$1');
$routes->post('Transaksi/bayar', 'Transaksi::bayar');
$routes->get('DataTransaksi/', 'DataTransaksi::index');

// Logout route
$routes->get('Auth/logout', 'Auth::logout');