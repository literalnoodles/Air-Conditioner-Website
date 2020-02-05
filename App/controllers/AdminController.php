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

	private function load_info(){
		$action = filter_input(INPUT_GET,'action');
		$section_name = filter_input(INPUT_GET,'page');
		switch($section_name){
			case "brands":
				$model = "brand";
				break;
			case "categories":
				$model = "category";
				break;
			case "deliveries":
				$model = "delivery";
				break;
			case "products":
				$model = "product";
				break;
			case "orders":
				$model = "order";
				break;
			default:
				$model = "";
		}
		return compact("action","section_name","model");
	}

	public function index(){
		$this->data["section_name"] = filter_input(INPUT_GET, 'page');
		$this->data["action"] = filter_input(INPUT_GET, 'action');
		extract($this->load_info());
		// extract($this->data);
		switch($section_name){
			case "logout":
				$this->admin_session->logout();
				header('Location: /admin');
				break;
			case "products":
				$this->load_model('brand');
				$this->load_model('category');
				$this->load_model('feature');
				$this->data +=array(
					"all_brands"=>$this->brand->load_names(),
					"all_categories"=>$this->category->load_names(),
					"all_features"=>$this->feature->load_names(),
				);
			case "brands":
			case "categories":
			case "deliveries":
			case "features":
			case "orders":
				switch($action){
					case "add":
						$this->load_view("update-{$model}");
						break;
					case "edit":
						$id = filter_input(INPUT_GET, 'id');
						$this->load_model($model);
						$data = $this->$model->load_data($id);
						if (!$data) {
							echo "{$model} not exists. Press <a href='/admin?page={$section_name}'>this</a> to go back";
							return;
						}
						$this->data += $data;
						$this->load_view("update-{$model}");
						break;
					default:
						$this->load_view($section_name);
				}
				break;
			case "slides":
				$this->load_model('slide');
				$this->data['slides'] = $this->slide->load_all();
				$this->load_view("update-slides");
				break;
			default:
				$this->load_view('admin');
		}
	}

	public function update_section(){
		// high_light($_POST);
		extract($this->load_info());
		$this->load_model($model);
		$this->$model->$action();
		if ($this->$model->update_status() == true) {
			set_msg("status","success");
		} else set_msg("status","error");
		header("Location: /admin?page={$section_name}");
	}

	public function update_slides(){
		$this->load_model('slide');
		$this->slide->update();
		header("Location: /admin?page=slides");
	}

	public function delete_section(){
		extract($this->load_info());
		$this->load_model($model);
		$id = filter_input(INPUT_POST,'id');
		$this->$model->delete($id);
		echo $this->$model->update_status()==true ? "Delete successfully!" : "Delete fail!";
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
		extract($_GET);
		require ("../App/views/admin/partials/custom_processing/{$_GET["type"]}.processing.php");
	}
}
?>