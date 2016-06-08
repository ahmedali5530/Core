<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Files implements RequestInterface{
    
    private $files ;
    
    public function __construct(){
        $this->files = $_FILES;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->files[$key]) ? $this->files[$key] : $defaultValue ;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->files[$k] = $v;
            }
            return $this;
        }
        $this->files[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->files[$key])){
            unset($this->files[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->files;
    }
}