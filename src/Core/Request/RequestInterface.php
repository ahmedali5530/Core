<?php 
namespace App\Core\Request;

interface RequestInterface{
    
    public function get($key, $deffaultValue = null, $deep = false);
    
    public function set($key, $value);
    
    public function update($key, $value);
    
    public function delete($key);
    
    public function all();
    
}