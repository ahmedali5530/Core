<?php
namespace App\Core\Loader;

use App\Core\Exceptions\NotFoundException;

class Loader {
    
    private $extension = '.php';
    
    public function getFile($file, $vars = array()){
        if (file_exists($file.$this->extension)) {
            //inject global variables and loaded variables
            extract($GLOBALS, EXTR_REFS);
			extract($vars, EXTR_REFS);
            
            ob_start();
            require_once $file.$this->extension;
            return ob_get_clean();
            
        }else{
            ob_clean();
            return new NotFoundException('File '.$file.$this->extension.' Not Found');
        }
    }
    
    public function loadFile($file, $vars = array()){
        if (file_exists($file.$this->extension)) {
            require_once $file.$this->extension;
        }else{
            return new NotFoundException('File '.$file.$this->extension.' Not Found');
        }
    }
}