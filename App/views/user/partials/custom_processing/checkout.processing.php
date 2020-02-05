<?php
	use App\Core\App;
	use App\Models\order;
	$action = filter_input(INPUT_GET,'action');
	switch($action){
		case "check_cart":
			check_cart();
			break;
		case "request_order":
			request_order();
			break;
	}

	function check_cart(){
		$db = App::get('database');
		$check_cart = json_decode(filter_input(INPUT_POST,'check_cart'),true);
		foreach ($check_cart as $item) {
			$unit_in_stock = $db->where('tbl_products',['unit_in_stock'],['product_id' => $item['product_id']],'column');
			if ($unit_in_stock<$item['quantity']) {
				echo json_encode(array(
					"msg"=>"Order quantity for {$item['product_name']} exceeds total unit in stock",
					"status"=>false
				));
				return;
			}
		}
		echo json_encode(array(
			"status"=>true
		));
	}

	function request_order(){
		if (isset($_SESSION['user'])){
			$user_id = $_SESSION['user'];
		}else{
			$user_id = null;
		}
		$process = new order;
		echo json_encode($process->process_user_order($user_id));
	}
	
?>