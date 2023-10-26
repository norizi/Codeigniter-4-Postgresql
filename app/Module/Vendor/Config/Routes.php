<?php
 

 $routes->group('module-vendor', ['namespace' => 'Module\Vendor\Controllers'], function ($routes) {
    $routes->get('/', 'Vendor::index');
    // Add more routes for the 'Blog' module here
});