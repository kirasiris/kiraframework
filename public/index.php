<?php

// Force developer to have some life  standards!
declare(strict_types=1);

namespace public;

// Load composer
require __DIR__ . '/../vendor/autoload.php';

// Load Kira libraries
use kira\libraries\Router;
use kira\libraries\Session;

// Load third party libraries
use Dotenv\Dotenv;

// Initiate session
Session::start();

// Load env variables from root folder
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Load env variables from kira folder
$kiradotenv = Dotenv::createImmutable(__DIR__ . '/../kira');
$kiradotenv->safeLoad();

// Load global helpers
require '../helpers.php';

// Instatiate the router
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);