<?php
namespace App\Core;
class request{
    public static function return_url(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        // return $_SERVER['REQUEST_URI'];
    }
    public static function type(){
        return $_SERVER['REQUEST_METHOD'];
    }
}