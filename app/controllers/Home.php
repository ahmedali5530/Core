<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Core\Response\Response;
use App\Core\Response\JsonResponse;

class Home extends Controller{

	public function index(){
		$this->setData('names', 'safeer')->setData('name', 'amaara');
	}

	public function printing($name){
		return response('printing name is '.$name);
	}

}