<?php

namespace App\Controllers;

use App\Core\{App, Session};
use App\Models\category;

class UserController
{
	public $redirect = null;
	private $data = [];

	function __construct()
	{
		$this->user_session = new Session('user');
		$this->check_cookie();
		$this->load_info();
	}

	private function load_info()
	{
		$path = $_SERVER["REQUEST_URI"];
		$short_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
		//load all brand name
		$this->load_model("brand");
		$this->load_model("category");
		$this->data['brands'] = $this->brand->load_all(["brand_id", "brand_name", "logo"]);
		$this->data['categories'] = $this->category->load_all(["category_id", "category_name"]);
		$this->data['path'] = $path;
		$this->data['short_path'] = $short_path;
		return compact("path", "short_path");
	}

	private function load_model($model, ...$param)
	{
		$model_cls = "App\\Models\\" . $model;
		$this->$model = new $model_cls(...$param);
	}

	private function load_view($view_name)
	{
		extract($this->data);
		return require "../App/views/user/{$view_name}.view.php";
	}

	public function index()
	{
		//get sample product
		$this->load_model("product");
		$this->data['sample_arr'] = $this->product->load_sample();
		//get slide
		$this->load_model("slide");
		$this->data['slides'] = $this->slide->load_all();
		$categories_sample = [];
		foreach ($this->data['categories'] as $category) {
			$sample = $this->product->load_categories_sample($category["category_id"]);
			$categories_sample[] = array(
				"category_id" => $category["category_id"],
				"category_name" => $category["category_name"],
				"sample" => $sample
			);
		}
		$this->data['categories_sample'] = $categories_sample;
		$this->load_view("homepage");
	}

	public function access()
	{
		extract($this->load_info());
		$action = filter_input(INPUT_GET, 'action');
		switch ($action) {
			case "reg":
				$this->load_view("register");
				break;
			case "login":
				$this->load_view("login");
				break;
			case "logout":
				$this->load_model('user');
				$this->user->logout();
				header('Location: /');
				break;
			case "change_password":
				$this->load_view("change_password");
				break;
			case "order-history":
				$this->load_model('user');
				$this->data['orders_history'] = $this->user->load_orders($_SESSION['user']);
				$this->load_view("order-history");
				break;
		}
	}

	public function load_products()
	{
		$filter = filter_input_array(INPUT_GET);
		$this->load_model("product");
		//update filter to session
		$this->product->assign_filter($filter, true);
		//load all feature
		$this->load_model("feature");
		$this->data["features"] = $this->feature->load_names();
		$this->load_view("products");
	}

	public function load_product_details()
	{
		// high_light($_GET);
		$product_id = filter_input(INPUT_GET, "product_id");
		$this->load_model('product');
		$this->data['product_details'] = $this->product->load_details($product_id);
		$this->load_view('product-details');
	}

	public function show_cart()
	{
		$this->load_view('cart');
	}

	public function checkout()
	{
		if (isset($_SESSION['user'])) {
			$user_id = $_SESSION['user'];
			$this->load_model('user');
			$result = $this->user->load_info($user_id, ['fullname', 'address', 'city', 'email', 'phone']);
			$this->data['user_info'] = $result;
		}
		$this->load_view('checkout');
	}

	public function load_contact()
	{
		$this->load_view('contact');
	}

	public function sendmail()
	{
		$name = filter_input(INPUT_POST, 'name');
		$subject = filter_input(INPUT_POST, 'subject');
		$mailFrom = filter_input(INPUT_POST, 'email');
		$message = filter_input(INPUT_POST, 'message');
		$mailTo = "trungnguyen1994@gmail.com";
		$headers = "From: $mailFrom";
		$content = "You have received an email from $name.\n\n $message";
		mail($mailTo, $subject, $content, $headers);
	}

	public function about_us()
	{
		$this->load_view('about-us');
	}

	public function register()
	{
		$this->load_model("user");
		$this->user->register();
		header('Location: /');
	}
	public function change_password()
	{
		$this->load_model("user");
		$this->user->change_password();
		header('Location: /');
	}
	public function login()
	{
		$username = filter_input(INPUT_POST, "username");
		$password = filter_input(INPUT_POST, "password");
		$remember = filter_input(INPUT_POST, "remember") ? true : false;
		$this->load_model("user");
		if ($this->user->verify($username, $password)) {
			$this->user->login($username, $remember, true);
			header('Location: /');
		} else {
			set_msg("status", "error");
			set_msg("msg", "Username or password is incorrect!");
			header('Location: /get_access?action=login');
		}
	}

	private function check_cookie()
	{
		if (empty($_SESSION['user']) && !empty($_COOKIE['remember'])) {
			list($selector, $authenticator) = explode(':', $_COOKIE['remember']);
			$this->load_model("user");
			$data = $this->user->parse_selector($selector);
			if (!$data) return;
			if (hash_equals($data['token'], hash('sha256', base64_decode($authenticator)))) {
				$username = $this->user->get_username($data['user_id']);
				$this->user->login($username, false, false);
				//delete the old authenticator and generate new
				$this->user->delete_token($selector);
				$this->user->set_token($data['user_id']);
			}
		}
	}

	public function ajax_process()
	{
		extract($_GET);
		require("../App/views/user/partials/custom_processing/{$_GET["type"]}.processing.php");
	}

	public function update_filter()
	{
		$action = filter_input(INPUT_GET, 'action');
		$key = filter_input(INPUT_POST, 'key');
		$value = filter_input(INPUT_POST, 'value');
		$this->load_model('product');
		$this->product->update_filter($action, compact('key', 'value'));
	}

	public function update_products()
	{
		$page = filter_input(INPUT_POST, 'page');
		$this->load_model('product');
		echo json_encode(array(
			"products_details" => $this->product->load_all($page),
			"results_number" => $this->product->count_results()
		));
	}
}
