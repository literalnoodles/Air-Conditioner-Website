<?php

use App\Core\App;

App::bind('config',require 'Database/config.php');
App::bind('database',new query(Connection::make(App::get('config'))));

// Helper function
function view($view_name,$data=[])
{
	extract($data);
	return require "../App/views/{$view_name}.view.php";
}
function high_light($var){
    highlight_string("<?php\n".var_export($var,true)."?>");
    die();
}
function set_msg($var_name,$value){
	if (isset($_SESSION[$var_name])) $_SESSION[$var_name].="<br>{$value}";
	else{
		$_SESSION[$var_name]=$value;
	}
}

function unset_msg($var_name){
	unset($_SESSION[$var_name]);
}
function handle_exception($code){
	switch ($code) {
		case '22003':
			set_msg("msg","Running out of unit in stock");
			break;
		case '23000':
			set_msg("msg","Duplicate value");
			break;
		
		default:
			# code...
			break;
	}
}

function dd($param){
    echo '<pre>';
    die(var_dump($param));
    echo '</pre>';
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
