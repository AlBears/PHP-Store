<?php

$router = new AltoRouter();

$router->map( 'GET', '/about', 'App\Controllers\IndexController@show', 'about_us');


