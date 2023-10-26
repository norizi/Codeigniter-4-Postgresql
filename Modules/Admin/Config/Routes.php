<?php
 

 $routes->group('module-admin', ['namespace' => 'Modules\Admin\Controllers'], function ($routes) {
    $routes->get('/', 'Admin::index');
    // Add more routes for the 'Blog' module here
});

