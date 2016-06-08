<?php

use App\Core\Request\Request;
use App\Core\Framework\App;
use App\Core\Response\Response;

//set timezone
//date_default_timezone_set($defaults['timezone']);

//start application
$response = new Response();
$request = new Request();
$app = new App($request, $response);

return $app;
