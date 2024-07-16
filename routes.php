<?php

$router->get('/', 'Welcome@index');
$router->get('/welcome', 'Welcome@index');
$router->get('/pages/index', 'Pages@index');
$router->get('/pages/about', 'Pages@about');
// Authentication VIEWS
$router->get('/auth/profile', 'Auth@profile', ['auth']);
$router->get('/auth/register', 'Auth@register', ['guest']);
$router->get('/auth/login', 'Auth@login', ['guest']);
// Authentication METHODS
$router->post('/auth/logout', 'Auth@logout', ['auth']);
$router->post('/auth/register', 'Auth@store', ['guest']);
$router->post('/auth/login', 'Auth@authenticate', ['guest']);