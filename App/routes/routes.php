<?php

use App\Controllers\NewsapiController;
use App\Controllers\RandomUserApiController;

/**
 * binds
 */

// newsapi
$router->bind('/newsapi/index', NewsapiController::class, 'index');
$router->bind('/newsapi/send', NewsapiController::class, 'send');

// randomuserapi
$router->bind('/random-user-api/index', RandomUserApiController::class, 'index');
$router->bind('/random-user-api/send', RandomUserApiController::class, 'send');