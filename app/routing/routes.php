<?php

$router = new AltoRouter();

$router->map( 'GET', '/', 'App\Controllers\IndexController@show', 'home');

//adin routes
$router->map('GET', '/admin', 'App\Controllers\Admin\DashboardController@show', 'admin_dashboard');
$router->map('POST', '/admin', 'App\Controllers\Admin\DashboardController@get', 'admin_form');

//product management
$router->map('GET', '/admin/product/categories', 
'App\Controllers\Admin\ProductCategoryController@show', 'product_category');
$router->map('POST', '/admin/product/categories', 
'App\Controllers\Admin\ProductCategoryController@store', 'create_product_category');