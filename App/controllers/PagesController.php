<?php
namespace App\Controllers;
use App\Core\App;
class PageController
{
	public function home(){
		$tasks = App::get('database')->getQuery('tasks');
		$users = App::get('database')->getQuery('userName');
		// require 'views/index.view.php';
		return view('index');
	}
	public function about(){
		// require 'views/about.view.php';
		return view('about');
	}
	public function contact(){
		// require 'views/contact.view.php';
		return view('contact');
	}
	public function add_name(){
		highlight_string("<?php\n".var_export($_POST['user'],true)."?>");
		App::get('database')->add_data('userName',[
			'name'=>$_POST['user']
		]);
		header('Location:/');
	}
	public function about_culture(){
		// require 'views/about-culture.view.php';
		return view('about-culture');
	}
}
?>