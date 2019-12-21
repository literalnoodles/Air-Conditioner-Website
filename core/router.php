<?php
namespace App\Core;
use \Exception;
class Router
{
    protected $routes = [
        'GET'=>[],
        'POST'=>[]
    ];
    public function get($endpoint,$controller){
        $this->routes['GET'][$endpoint] = $controller;
    }
    
    public function post($endpoint,$controller){
        $this->routes['POST'][$endpoint] = $controller;
    }
    
    public function load($file){
        // $routes = new self;
        // $routes = $this;
        require $file;
        // return $this;
    }
    public function direct($url,$type){
        if (array_key_exists($url,$this->routes[$type])){
            return $this->callPage(
                ...explode("@", $this->routes[$type][$url])
            );
        }else{
            throw new Exception('No route define for this URL');
        }
    }
    protected function callPage($controller,$action){
        $controller_class = "App\\Controllers\\{$controller}";
        $controller = new $controller_class;
        if (!method_exists($controller,$action)){
            throw new Exception("{$controller} does not respond to the {$action} action");
        }else{
            if ($controller->redirect != NULL) $action = $controller->redirect;
            return $controller->$action();
        }
    }
}