<?php
require_once __DIR__.'/vendor/autoload.php';

/**
 * entry script
 */

//include helpers
require_once('src/Core/Framework/helpers.php');

//define enviornment
define('ENVIORNMENT', 'development');

if(ENVIORNMENT == 'development'){
	error_reporting(E_ALL);
}

//define constants PATH Separator
define('DS', DIRECTORY_SEPARATOR);

//application path
define('APPPATH', dirname(__FILE__).DS.'app'.DS);

define('VIEWPATH', APPPATH.'views'.DS);

//set exception handler
set_exception_handler('my_exception_handler');

//set custom error handler
set_error_handler('my_error_handler', E_STRICT|E_ERROR|E_PARSE);

//start the application
require_once('src/bootstrap.php');