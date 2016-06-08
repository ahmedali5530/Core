<?php

namespace App\Core\Config;

use App\Core\Loader\Loader;

class Config extends Loader{
    
    public function get($key, $scope){
        $configOption = null;
        switch($scope){
            case('app'):
                $config = parent::loadFile(APPPATH.'config/app');
                $configOption = isset($config[$key]) ? $config[$key] : null ;
            break;
        }
        
        return $configOption;
    }
    
    public function all($scope){
        $configOption = null;
        switch($scope){
            case('app'):
                $configOption = parent::loadFile(APPPATH.'config/app');
            break;
        }
        
        return $configOption;
    }
}