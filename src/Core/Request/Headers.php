<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Headers implements RequestInterface{
    
    private $headers ;
    
    public function __construct(){
        $this->headers = $_HEADERS;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->headers[$key]) ? $this->headers[$key] : $defaultValue ;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->headers[$k] = $v;
            }
            return $this;
        }
        $this->headers[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->headers[$key])){
            unset($this->headers[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->headers;
    }
}