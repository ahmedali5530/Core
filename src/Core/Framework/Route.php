<?php 
namespace App\Core\Framework;

use App\Core\Request\Request;
use App\Core\Loader\Loader;
use App\Core\Exceptions\NotFoundException;
use App\Controllers\Controller;
use App\Core\Framework\Template;

class Route{
    
    public static $routes = array();
    private $controllerNamespace = '\App\Controllers' ,
            $controller = 'Home',
            $method = 'index',
            $params = array();
    
    public static function set($requestMethod, $route, $controller, $arguments = null){
        self::$routes[$route] = array(
            'requestMethod' => $requestMethod,
            'route' => $route,
            'controller' => $controller,
            'arguments' => $arguments,
        );
    }
    
    public static function get($route, $arguments = null){
        return self::$routes[$route];
    }
    
    public static function all(){
        return self::$routes;
    }
    
    public function getCurrentRoute(Request $request){
        $pathInfo = $request->pathInfo();
        $uriParts = explode('/', $pathInfo);
        //return route
        return $uriParts; 
    }
    
    public function run($route){
        
        $controllerClass = new Controller();
        $templateClass = new Template();

        if($this->resolveRoute($route)){
            $controller = $this->controllerNamespace.DS.$this->controller;
            $response = call_user_func_array(array(new $controller, $this->method), $this->params);

            if($controllerClass->hasView == false && $response === null){
                //run default view related to class and method

                return $controllerClass->view($this->controller.'/'.$this->method, $templateClass->getViewBag());
            }
            // elseif($response === null){
            //     throw new \Exception(sprintf('The controller %s must return a valid Response', $this->controller.'/'.$this->method));
            // }

            return $response;
        
        }else{
            throw new NotFoundException(sprintf('Route "%s/%s" not found', $this->controller, $this->method));
        }
    }
    
    protected function resolveRoute($route){

        $this->prepareRoute($route);

        if(is_callable(array($this->controllerNamespace.DS.$this->controller, $this->method))){
            return true;
        }
        
        return false;
    }

    protected function prepareRoute($route){
        //check if this controller and method exists or not
        if(count($route) >= 3){
            $this->controller = trim($route[1]) == '' ? $this->controller : ucfirst($route[1]);
            $this->method = trim($route[2]) == '' ? $this->method : $route[2];

            //unset other params from $route
            unset($route[0]);
            unset($route[1]);
            unset($route[2]);
            $this->params = $route;

        }elseif(count($route) === 2){
            $this->controller = trim($route[1]) == '' ? $this->controller : ucfirst($route[1]);
            $this->method = 'index';
        }elseif(count($route) === 0 || count($route) === 1){
            //dont set its already setup
        }
    }
}