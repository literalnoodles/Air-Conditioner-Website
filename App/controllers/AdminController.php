<?php
namespace App\Controllers;
use App\Core\{App,Session,request};

// use App\Models\Session;
class AdminController{
	
	public $redirect = NULL;
	private $admin_session;

	function __construct(){
		$this->admin_session = new Session('admin');
		if (!$this->admin_session->is_logged_in()){
			$this->redirect = "login";
		}
	}

	private function load_model($model,...$param){
		$model_cls = "App\\Models\\".$model;
		$this->$model = new $model_cls(...$param);
	}

	private function load_view($view_name,$data=[]){
		extract($data);
		return require "../App/views/{$view_name}.view.php";
	}

	public function index(){
		$page = filter_input(INPUT_GET,'page');
		$section_name = ucfirst(filter_input(INPUT_GET, 'page'));
		switch($page){
			case NULL:
				return $this->load_view('admin',compact("section_name"));
			case "logout":
				$this->admin_session->logout();
				header('Location: /admin');
				break;
			default:
				$this->load_view('admin',compact("section_name"));
		}
	}

	public function login(){
		if (request::type()=="POST"){
			$this->load_model("identity","tbl_admin");
			$username = filter_input(INPUT_POST,'user');
			$password = filter_input(INPUT_POST,'pass');
			$this->identity->input(["username"=>$username],"password");
			if ($this->identity->check_password($password)==true){
				$this->admin_session->login($this->identity->get_col('id'));
				header('Location: /admin');
			}
			else{
				echo ("Invalid username and password<br>");
				echo ("Click <a href='/admin'>here</a> to go back to the login page");
			}
		} else{
			$this->load_view('login');
		}
	}


}
?>