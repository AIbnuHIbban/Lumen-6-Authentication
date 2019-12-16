<?php

use Illuminate\Support\Str;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Key Generate
$router->get('key', function () {
    return Str::random(32);
});


// Authenticate
$router->post('register', 'AuthController@register');
$router->post('login', 'AuthController@login');

// Get Data
$router->get('user/{id}', 'UsersController@show');