<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Post implements RequestInterface{
    
    private $post ;
    
    public function __construct(){
        $this->post = $_POST;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->post[$key]) ? $this->post[$key] : $defaultValue;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->post[$k] = $v;
            }
            return $this;
        }
        $this->post[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->post[$key])){
            unset($this->post[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->post;
    }
}