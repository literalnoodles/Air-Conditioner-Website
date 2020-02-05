<?php
use App\Core\App;
$db = App::get('database');
//datatable
if (isset($action) && $action=='update_status'){
	try{
		$db->transaction('begin');
		$old_status = $db->where("tbl_orders","status",["order_id"=>$order_id],'column');
		if ($old_status==5 || ($old_status==$new_status)) {
			echo "Cannot change status of this order";
			return;
		}
		$db->update("tbl_orders",["status"=>$new_status],["order_id"=>$order_id]);
		if ($old_status<5 and $new_status==5){
			//get all the product of this order id
			$old_quantity = $db->where("tbl_orders_details",["product_id","quantity"],["order_id"=>$order_id]);
			//add back to the product table
			$sql="UPDATE tbl_products SET unit_in_stock = unit_in_stock + ? WHERE product_id = ?";
			foreach($old_quantity as $item){
				$sql="UPDATE tbl_products SET unit_in_stock = unit_in_stock + ? WHERE product_id = ?";
				$db->query_stm($sql,[$item["quantity"],$item["product_id"]]);
			}
		}
		$db->transaction('commit');
		echo "Update status successfully";
		return;
	}catch(\PDOException $e){
		$db->transaction('rollback');
		echo handle_exception($e->getCode());
		return;
	}
	//if old status = not abort, new status = abort -> change status + add back product
	//if old status = abort, new status = abort -> change status + add back product
	//if old status = not abort, new status = not abort -> only change status
}
if (!isset($data)){
	$table = "tbl_orders";
	$primaryKey = 'order_id';
	$columns = array(
		array( 'db' => 'order_id',  'dt' => 0 ),
		array( 'db' => 'fullname',   'dt' => 1 ),
		array( 'db' => 'address', 'dt' => 2 ),
		array( 
			'db' => 'city',
			'dt' => 3
		),
		array( 
			'db' => 'phone',
			'dt' => 4
		),	
		array( 'db' => 'status',
			'formatter'=>function($d,$row){
				$option=[];
				$text=["Confirming","Packing","Delivering","Complete","Cancel"];
				switch ($d) {
					case '1':
						$option=["selected","","","",""];
						break;
					case '2':
						$option=["disabled hidden","selected","","",""];
						break;
					case '3':
						$option=["disabled hidden","disabled hidden","selected","",""];
						break;
					case '4':
						$option=["disabled hidden","disabled hidden","disabled hidden","selected",""];
						break;
					case '5':
						$option=["disabled hidden","disabled hidden","disabled hidden","disabled hidden","selected"];
						break;
				}
				return "<select name='status' id='inputStatus' class='form-control'><option {$option[0]} value='1'>{$text[0]}</option><option {$option[1]} value='2'>{$text[1]}</option><option {$option[2]} value='3'>{$text[2]}</option><option {$option[3]} value='4'>{$text[3]}</option><option {$option[4]} value='5'>{$text[4]}</option></select>";
			},
			'dt' => 5
		),
		array(
			'db'        => 'order_id',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				return "<a href='/admin?page=orders&action=edit&id={$d}' role='button' class='btn'><i class='fa fa-edit'></i></a><button class='btn update-status' value='{$d}'><i class='fas fa-check-circle'></i></button>";
			},

		)
	);

		// SQL server connection information
	$sql_details = array(
		'user' => 'root',
		'pass' => '',
		'db'   => 'cosy_airconditioner',
		'host' => '127.0.0.1'
	);

	require( './plugins/DataTables/ssp.class.php' );
	echo json_encode(SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns));
	return;
}
//end datatable
switch ($data) {
	case 'products':
		if (!isset($_POST['searchTerm'])){
			$sql = "SELECT * from tbl_products LIMIT 5";
			$results = $db->query_stm($sql,NULL,'array');
		}else{
			$search = $_POST['searchTerm'];
			$sql = "SELECT * from tbl_products WHERE product_name LIKE ? LIMIT 5";	
			$results = $db->query_stm($sql,["%{$search}%"],'array');
		}
		$return=[];
		foreach ($results as $item) {
			$return[]=[
				"id"=>$item["product_id"],
				"text"=>$item["product_name"]
			];
		}
		echo json_encode($return);
		break;
	case 'products_quantity':
		$sql = "SELECT unit_in_stock from tbl_products WHERE product_id=?";
		$results = $db->query_stm($sql,[$product_id],'column');
		echo $results;
		break;
	case 'products_price':
		$sql = "SELECT unit_price from tbl_products WHERE product_id=?";
		$results = $db->query_stm($sql,[$product_id],'column');
		echo $results;
		break;
	case 'products_discount':
		$sql = "SELECT discount from tbl_products WHERE product_id=?";
		$results = $db->query_stm($sql,[$product_id],'column');
		echo $results;
		break;
	//get data for datatable
	default:
		break;
}


?>