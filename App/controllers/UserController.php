<?php
namespace App\Controllers;
use App\Core\App;
class UserController
{
	public function index()
	{
		$tasks = App::get('database')->getQuery('tasks');
		$users = App::get('database')->getQuery('userName');
		// require 'views/index.view.php';
		return view('users',[
			'users'=>$users,
			'tasks'=>$tasks
		]);
	}
	public function store()
	{
		App::get('database')->add_data('userName',[
			'name'=>$_POST['user']
		]);
		header('Location:/');
	}

}

?>