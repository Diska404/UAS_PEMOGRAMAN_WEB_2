<?php

use CodeIgniter\Router\RouteCollection;

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->options('api', 'Api\\PreflightController::index');
$routes->options('api/(:any)', 'Api\\PreflightController::index');

$routes->group('api', ['filter' => 'corsFilter'], static function ($routes) {
    $routes->post('login', 'Api\\AuthController::login');
    $routes->get('summary', 'Api\\DashboardController::summary');
    $routes->get('profile', 'Api\\AuthController::profile', ['filter' => 'authToken']);
    $routes->post('logout', 'Api\\AuthController::logout', ['filter' => 'authToken']);

    $routes->get('kategori', 'Api\\KategoriController::index');
    $routes->get('kategori/(:num)', 'Api\\KategoriController::show/$1');
    $routes->post('kategori', 'Api\\KategoriController::create', ['filter' => 'authToken']);
    $routes->put('kategori/(:num)', 'Api\\KategoriController::update/$1', ['filter' => 'authToken']);
    $routes->patch('kategori/(:num)', 'Api\\KategoriController::update/$1', ['filter' => 'authToken']);
    $routes->delete('kategori/(:num)', 'Api\\KategoriController::delete/$1', ['filter' => 'authToken']);

    $routes->get('supplier', 'Api\\SupplierController::index');
    $routes->get('supplier/(:num)', 'Api\\SupplierController::show/$1');
    $routes->post('supplier', 'Api\\SupplierController::create', ['filter' => 'authToken']);
    $routes->put('supplier/(:num)', 'Api\\SupplierController::update/$1', ['filter' => 'authToken']);
    $routes->patch('supplier/(:num)', 'Api\\SupplierController::update/$1', ['filter' => 'authToken']);
    $routes->delete('supplier/(:num)', 'Api\\SupplierController::delete/$1', ['filter' => 'authToken']);

    $routes->get('barang', 'Api\\BarangController::index');
    $routes->get('barang/(:num)', 'Api\\BarangController::show/$1');
    $routes->post('barang', 'Api\\BarangController::create', ['filter' => 'authToken']);
    $routes->put('barang/(:num)', 'Api\\BarangController::update/$1', ['filter' => 'authToken']);
    $routes->patch('barang/(:num)', 'Api\\BarangController::update/$1', ['filter' => 'authToken']);
    $routes->delete('barang/(:num)', 'Api\\BarangController::delete/$1', ['filter' => 'authToken']);

    $routes->get('stok', 'Api\\StokHistoriController::index');
    $routes->get('stok/(:num)', 'Api\\StokHistoriController::show/$1');
    $routes->post('stok', 'Api\\StokHistoriController::create', ['filter' => 'authToken']);
    $routes->delete('stok/(:num)', 'Api\\StokHistoriController::delete/$1', ['filter' => 'authToken']);
});
