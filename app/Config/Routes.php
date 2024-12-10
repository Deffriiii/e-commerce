<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Redirect ke halaman yang sesuai berdasarkan login dan role
$routes->get('/', function () {
    $session = session();

    // Jika belum login, arahkan ke halaman login
    if (!$session->has('isLoggedIn')) {
        return redirect()->to('auth/login'); // Halaman login
    }

    // Cek role pengguna
    if ($session->get('role') === 'admin') {
        return redirect()->to('admin/dashboard'); // Halaman Admin
    } elseif ($session->get('role') === 'user') {
        return redirect()->to('user/dashboard'); // Halaman User
    }

    // Jika role tidak diketahui, logout
    return redirect()->to('logout');
});

// Rute Login
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/authenticate', 'AuthController::authenticate');
$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/store', 'AuthController::store');

// Rute untuk Admin
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Home::index'); // Halaman dashboard admin
});

// Rute untuk User
$routes->group('user', ['filter' => 'role:user'], function ($routes) {
    $routes->get('dashboard', 'HomeUser::index'); // Halaman dashboard user
});

// Rute Navbar
$routes->get('home', 'Home::index');
$routes->get('products', 'ProductController::index');
$routes->get('about', 'AboutController::index');
$routes->get('contact', 'ContactController::index');
$routes->get('logout', 'AuthController::logout');

// Rute untuk CRUD Produk
$routes->get('/products', 'ProductController::index');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/store', 'ProductController::store');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/update/(:num)', 'ProductController::update/$1');
$routes->get('/products/delete/(:num)', 'ProductController::delete/$1');

// Rute untuk halaman produk pengguna
$routes->get('product-user', 'ProductController::productUser'); // Halaman produk untuk user
$routes->get('product-user/detail/(:num)', 'ProductController::detail/$1');

// Rute Untuk Manajemen Pengguna 
$routes->group('manajemen_pengguna', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});

// Rute Profil untuk Admin dan User
$routes->group('profile', ['filter' => 'role:admin,user'], function ($routes) {
    $routes->get('/', 'ProfileController::index');     // Menampilkan Profil
    $routes->post('update', 'ProfileController::update');  // Pembaruan Profil
});

// Rute untuk Keranjang dan Checkout
$routes->group('cart', ['filter' => 'role:user'], function ($routes) {
    $routes->get('/', 'CartController::index');
    $routes->post('add', 'CartController::add');
    $routes->post('update', 'CartController::update');
    $routes->post('delete', 'CartController::delete');
});

$routes->group('checkout', ['filter' => 'role:user'], function ($routes) {
    $routes->get('/', 'CheckoutController::index');
    $routes->post('process', 'CheckoutController::process');
});

$routes->get('orders', 'OrderController::index');

// rute complete order 
$routes->get('orders/complete/(:num)', 'OrderController::complete/$1');
// rute riwayat Pembayaran 
// Di routes.php
$routes->get('orders/payment-history/(:num)', 'OrderController::paymentHistory/$1');