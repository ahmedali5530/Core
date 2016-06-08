<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Cookie implements RequestInterface{
    
    private $cookie ;
    
    public function __construct(){
        $this->cookie = $_COOKIE;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->cookie[$key]) ? $this->cookie[$key] : $defaultValue ;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->cookie[$k] = $v;
            }
            return $this;
        }
        $this->cookie[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->cookie[$key])){
            unset($this->cookie[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->cookie;
    }
}