<?php

use App\Core\App;

// require 'Database/Database.php';
// require 'Database/query.php';
// require 'tasks.php';
// require 'router.php';
// require 'request.php';
// require 'App.php';
// require 'controllers/PagesController.php';
// require 'controllers/UserController.php';

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
function dd($param){
    echo '<pre>';
    die(var_dump($param));
    echo '</pre>';
}