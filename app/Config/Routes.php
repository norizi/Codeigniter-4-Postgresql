<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');

$routes->get('user-index', 'User::index'); 
$routes->post('user-index', 'User::index'); 
$routes->get('user-datatable', 'User::datatable');
$routes->get('user-create', 'User::create',['filter' => 'authGuard']);
$routes->post('user-store', 'User::store');
$routes->get('user-edit/(:num)', 'User::edit/$1');
$routes->post('user-update', 'User::update');
$routes->get('user-delete/(:num)', 'User::delete/$1');
$routes->post('user-delete-form', 'User::delete_form');
$routes->get('profile', 'User::profile'); 
$routes->post('profile-update', 'User::profile_update');
$routes->get('sendemail', 'User::sendemail');


$routes->get('staff', 'User::staff'); 
$routes->get('uuid', 'User::uuid');
$routes->get('timedate', 'User::timedate');
$routes->get('batch_processing', 'User::batch_processing');
$routes->get('nobatch_processing', 'User::nobatch_processing');
$routes->get('myservice', 'MyController::index');

$routes->get('cache_staff', 'Report::index'); 
$routes->get('delete_cache', 'Report::delete_cache'); 
$routes->get('show_processlist', 'Report::show_processlist');

$routes->get('bar', 'Report::bar'); 
$routes->get('line', 'Report::line');
$routes->get('pie', 'Report::pie'); 

$routes->get('mylibrary', 'User::mylibrary');
$routes->get('mpdf', 'User::mpdf');
$routes->get('spreadsheet', 'User::spreadsheet');
$routes->get('spreadsheet', 'User::spreadsheet');
$routes->get('faker', 'User::faker');


$routes->get('login', 'Login::index'); 
$routes->post('login-auth', 'Login::loginAuth'); 
$routes->get('logout', 'Login::logout');
$routes->get('traits', 'Login::traits');
$routes->get('segment', 'Login::segment');

//Custom error 404
/*
$routes->set404Override(function(){
    echo "your error message";
});
*/

//$routes->delete('user/delete/(:num)', 'User::delete/$1');
