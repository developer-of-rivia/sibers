<?php

/**
 * foundation
 */
require_once 'Core/ViewCreator.php';
require_once 'Core/Router.php';

/**
 * session
 */
session_start();


/**
 * route init
 */

$router = new Router();

require_once 'routes/routes.php';

$router->start();