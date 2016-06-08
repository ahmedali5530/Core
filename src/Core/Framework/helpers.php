<?php

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Framework\Template;
use App\Controllers\Controller;

if(!function_exists('e')){
	function e($string){
		echo htmlentities($string);
	}
}

if(!function_exists('view')){
	function view($template = null, $params = array()){

		$contoller = new Controller();
		return $contoller->view($template, $params);
	}
}

if(!function_exists('response')){

	function response($contents){
		return $contents;
	}

}

if(!function_exists('json')){

	function json($data){
		header('content-type:application/json');
		return json_encode($data, 15);
	}

}

if(!function_exists('my_exception_handler')){
	function my_exception_handler($e){
		$request = new Request();
		header($request->server->get('SERVER_PROTOCOL') . ' 500 Internal Server Error', true, 500);
		echo view('errors/exception', array('e' => $e, 'statusCode' => null));
		exit();
	}
}

if(!function_exists('my_error_handler')){
	function my_error_handler($errno, $errstr, $errfile, $errline, $errcontext){
		$request = new Request();
		header($request->server->get('SERVER_PROTOCOL') . ' 500 Internal Server Error', true, 500);
		echo view('errors/error', array('e' => func_get_args()));
		exit();
	}
}