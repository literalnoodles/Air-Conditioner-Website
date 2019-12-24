<?php
namespace App\Controllers;
use App\Core\{App,Session,request};

// use App\Models\Session;
class AdminController{
	
	public $redirect = NULL;
	private $admin_session;
	private $data=[];

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

	private function load_view($view_name){
		extract($this->data);
		return require "../App/views/admin/{$view_name}.view.php";
	}

	public function index(){
		$this->data["section_name"] = filter_input(INPUT_GET, 'page');
		$this->data["action"] = filter_input(INPUT_GET, 'action');
		extract($this->data);
		switch($section_name){
			case "logout":
				$this->admin_session->logout();
				header('Location: /admin');
				break;
			case "brands":
				switch ($action){
					case "add":
						$this->load_view("add-brand");
						break;
					case "edit":
						$id = filter_input(INPUT_GET, 'id');
						$this->load_model("brand");
						$brand_data = $this->brand->load_data($id);
						if (!$brand_data) {
							echo "Brand not exists. Press <a href='/admin?page=brands'>this</a> to go back";
							return;
						}
						$this->data += $brand_data;
						$this->load_view("edit-brand");
						break;
					default:
						$this->load_view("brands");
				}
				break;
			default:
				$this->load_view('admin');
		}
	}

	public function add_brand(){
		$this->load_model('brand');
		$this->brand->add();
		if ($this->brand->update_status() == true) {
			$this->admin_session->set_msg("status","success");
		} else $this->admin_session->set_msg("status","error");
		header("Location: /admin?page=brands");
	}

	public function edit_brand(){
		$this->load_model('brand');
		$this->brand->edit();
		if ($this->brand->update_status() == true) {
			$this->admin_session->set_msg("status","success");
		} else $this->admin_session->set_msg("status","error");
		header("Location: /admin?page=brands");
	}

	public function delete_brand(){
		$this->load_model('brand');
		$brand_id = filter_input(INPUT_POST,'id');
		$this->brand->delete($brand_id);
		echo $this->brand->update_status()==true ? "Delete successfully!" : "Delete fail!";
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

	public function ajax_process(){
		require ("../App/views/admin/partials/{$_GET["type"]}.processing.php");
	}
}
?>