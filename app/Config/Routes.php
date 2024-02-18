<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Authentication Routes
$routes->get('/', 'AuthController::signin');
$routes->get('signup', 'AuthController::signup');
$routes->post('signup', 'AuthController::signup');
$routes->get('signin', 'AuthController::signin');
$routes->post('signin', 'AuthController::signin');


// Dashboard Routes
$routes->group('dashboard', function ($routes) {
    // Dashboard Home
    $routes->get('/', 'Dashboard::index');

    // Customer Routes
    $routes->get('customers', 'Customer::index');
    $routes->post('customer/add', 'Customer::add');

    $routes->get('customer/summary', 'Customer::index', ['as' => 'customer-summary']);
    $routes->get('tasks/task', 'TaskController::viewTasks', ['as' => 'tasks']);
    $routes->get('dashboard/customer/summary', 'Customer::index', ['as' => 'customer-summary']);
    $routes->get('dashboard/tasks/task', 'TaskController::viewTasks', ['as' => 'tasks']);


    // Task Routes
    $routes->get('task', 'TaskController::viewTasks');
    $routes->post('task', 'TaskController::add'); 
});


 