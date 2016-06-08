<?php
namespace App\Core\Request;

use App\Core\Request\Get;
use App\Core\Request\Post;
use App\Core\Request\Cookie;
use App\Core\Request\Session;
use App\Core\Request\Server;
use App\Core\Request\Files;

class Request{
    
    public $get, $post, $cookie, $session, $server, $files;
    
    public function __construct(){
        $this->get = new Get();
        $this->post = new Post();
        $this->cookie = new Cookie();
        $this->session = new Session();
        $this->server = new Server();
        $this->files = new Files();
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return $this->get->get($key, $defaultValue, $deep);
    }
    
    public function post($key, $defaultValue = null, $deep = false){
        $this->post->get($key, $defaultValue, $deep);
    }
    
    public function requestMethod(){
        return $this->server->get('REQUEST_METHOD');
    }
    
    public function isMethod($requestMethod){
        return $this->requestMethod() == $requestMethod ? true : false;
    }
    
    public function pathInfo(){
        return $this->server->get('PATH_INFO');
    }
    
    public function requestUri(){
        return $this->server->get('REQUEST_URI');
    }
    
    public function httpHost(){
        return $this->server->get('HTTP_HOST');
    }
    
    public function requestScheme(){
        return $this->server->get('REQUEST_SCHEME');
    }
    
    public function current(){
        return $this->requestScheme().'://'.$this->httpHost().$this->requestUri();
    }
}