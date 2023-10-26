<?php
 

 $routes->group('module-staff', ['namespace' => 'Module\Staff\Controllers'], function ($routes) {
    $routes->get('/', 'Staff::index');
    // Add more routes for the 'Blog' module here
});

