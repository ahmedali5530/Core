<?php 

namespace App\Core\Request;

use App\Core\Request\RequestInterface;

class Session implements RequestInterface{
    
    private $session ;

    private $sessionKey = 'ahmedali5530';

    private $sessionName = 'core_session';
    
    public function __construct(){
        session_name($this->sessionName);
        @session_start();
        $this->session = $_SESSION;
    }
    
    public function get($key, $defaultValue = null, $deep = false){
        return isset($this->session[$key]) ? $this->session[$key] : $defaultValue ;
    }
    
    public function set($key, $value){
        if(is_array($key)){
            foreach($key as $k=>$v){
                $this->session[$k] = $v;
            }
            return $this;
        }
        $this->session[$key] = $value;
        return $this;
    }
    
    public function update($key, $value){
        return $this->set($key, $value);
    }
    
    public function delete($key){
        if(isset($this->session[$key])){
            unset($this->session[$key]);
            return true;
        }else{
            return false;
        }
    }
    
    public function all(){
        return $this->session;
    }
    
    public function destroy(){
        @session_destroy();
        return true;
    }

    /**
     * Ends the current session and store session data.
     */
    public function close()
    {
        if(session_id()!=='')
            @session_write_close();
    }
}