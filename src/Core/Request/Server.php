<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Server implements RequestInterface{
    
    private $server ;
    
    public function __construct(){
        $this->server = $_SERVER;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->server[$key]) ? $this->server[$key] : $defaultValue ;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->server[$k] = $v;
            }
            return $this;
        }
        $this->server[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->server[$key])){
            unset($this->server[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->server;
    }
}