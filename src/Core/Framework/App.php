<?php
namespace App\Core\Framework;

use App\Core\Framework\Route;
use App\Core\Request\Request;
use App\Core\Response\Response;

class App{
    
    public function __construct(Request $request, Response $response){
        //get current route and run it
        $route = new Route();

        //run current route
        $return = $route->run($route->getCurrentRoute($request));

        return $response->create($return)->send();
    }
}