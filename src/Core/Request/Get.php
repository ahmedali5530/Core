<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Get implements RequestInterface{
    
    public $get ;
    
    public function __construct(){
        $this->get = $_GET;
        return $this;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->get[$key]) ? $this->get[$key] : $defaultValue ;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->get[$k] = $v;
            }
            return $this;
        }
        $this->get[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->get[$key])){
            unset($this->get[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->get;
    }
}