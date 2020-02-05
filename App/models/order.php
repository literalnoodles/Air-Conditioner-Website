<?php 
namespace App\Models;
use App\Core\App;
class order
{
	function __construct(){
		$this->db = App::get('database');
		$this->post_arr=$_POST;
		foreach ($this->post_arr as $key => $value) {
			if ($value==='') $this->post_arr[$key]=null;
		}
	}
	public function add(){
		$this->db->transaction('begin');
		try{
			$query_arr=[
				"status"=>$this->post_arr['status'],
				"fullname"=>$this->post_arr['fullname'],
				"address"=>$this->post_arr['address'],
				"city"=>$this->post_arr['city'],
				"phone"=>$this->post_arr['phone'],
				"note"=>$this->post_arr['note']
			];
			$this->db->insert("tbl_orders",array_keys($query_arr),array_values($query_arr));
			$new_order_id = $this->db->get_last_id();
			foreach ($this->post_arr['details'] as $item) {
				/*
					//this to make sure quantity > 0
					if ($item['quantity']<1){
						$this->db->transaction('rollback');
						$this->db->query_status=false;
						set_msg("msg","You can order less than 1 unit!");
						return;
					}
					//end note
				*/
				$query_arr = $item + ["order_id"=>$new_order_id];
				$this->db->insert("tbl_orders_details",array_keys($query_arr),array_values($query_arr));
			}
			if ($this->post_arr['status']!=5){
				//deduct from the product table
				foreach ($this->post_arr['details'] as $item) {
					$sql = "UPDATE tbl_products SET unit_in_stock = unit_in_stock - ? WHERE product_id = ?";
					$this->db->query_stm($sql,[
						$item['quantity'],
						$item['product_id']
					]);
				}
			}
			$this->db->transaction('commit');
			$this->db->query_status=true;
		}catch(\PDOException $e){
			$this->db->transaction('rollback');
			handle_exception($e->getCode());
			$this->db->query_status=false;
		}
	}

	public function edit(){
			$this->db->transaction('begin');
		try{		
			$id = $this->post_arr['order_id'];
			$old_status = $this->db->where("tbl_orders","status",["order_id"=>$id],'column');
			// if status = complete or cancel -> cannot be update
			if ($old_status>=4) {
				set_msg('msg','Cannot update this order because it was either completed or cancelled!');
				$this->db->query_status==false;
				return;
			}
			$old_quantity = $this->db->where("tbl_orders_details",["product_id","quantity"],["order_id"=>$id]);
			// unset($this->post_arr['company_id']);
			// update order information in order table
			$query_arr = [
				"status"=>$this->post_arr['status'],
				"fullname"=>$this->post_arr['fullname'],
				"address"=>$this->post_arr['address'],
				"city"=>$this->post_arr['city'],
				"phone"=>$this->post_arr['phone'],
				"note"=>$this->post_arr['note']
			];
			$this->db->update("tbl_orders",$query_arr,["order_id"=>$id]);
			//reset the quantity of product
			foreach($old_quantity as $item){
				$sql="UPDATE tbl_products SET unit_in_stock = unit_in_stock + ? WHERE product_id = ?";
				$this->db->query_stm($sql,[$item["quantity"],$item["product_id"]]);
			}
			//delete the old details in order details table
			$this->db->delete("tbl_orders_details",["order_id"=>$id]);
			//update the new details
			foreach ($this->post_arr['details'] as $item) {
				$query_arr = $item + ["order_id"=>$id];
				$this->db->insert("tbl_orders_details",array_keys($query_arr),array_values($query_arr));
			}
			//update the quantity of product
			//old status = abort, new = abort -> add back
			//old status = not abort , new = abort -> do nothing
			//old status = not abort, new = not abort-> add back
			$new_status = $this->post_arr["status"];
			if (!($old_status<5 && $new_status==5)){
				foreach ($this->post_arr['details'] as $item) {
					$sql = "UPDATE tbl_products SET unit_in_stock = unit_in_stock - ? WHERE product_id = ?";
					$this->db->query_stm($sql,[
						$item['quantity'],
						$item['product_id']
					]);
				}
			}
			$this->db->transaction('commit');
			$this->db->query_status=true;
		}catch(\PDOException $e){
			$this->db->transaction('rollback');
			handle_exception($e->getCode());
			$this->db->query_status=false;
		}


	}

	public function load_data($id){
		//fullname,address,city,status,phone,details[product_id,quantity,unit_price,discount]
		try{
			$data = $this->db->where("tbl_orders","*",["order_id"=>$id]);
			$order_details = $this->db->where("tbl_orders_details",["product_id","quantity","unit_price","discount"],["order_id"=>$id]);
			foreach ($order_details as $index=>$item) {
				$product_name = $this->db->where("tbl_products",["product_name"],["product_id"=>$item["product_id"]],'column');
				$order_details[$index]["product_name"]=$product_name;
			}
			$data=$data[0]+["details"=>$order_details];
			return $data; 
		}catch (\PDOException $e){
			return null;
		}
	}

	public function process_user_order($user_id){
		$this->db->transaction('begin');
		try{
			$query_arr=[
				"status"=>$this->post_arr['status'],
				"fullname"=>$this->post_arr['fullname'],
				"address"=>$this->post_arr['address'],
				"city"=>$this->post_arr['city'],
				"phone"=>$this->post_arr['phone'],
				"email"=>$this->post_arr['email'],
				"note"=>$this->post_arr['note']
			];
			if ($user_id != null) $query_arr["user_id"] = $user_id;
			$this->db->insert("tbl_orders",array_keys($query_arr),array_values($query_arr));
			$new_order_id = $this->db->get_last_id();
			foreach ($this->post_arr['cart'] as $item) {
				/*
					//this to make sure quantity > 0
					if ($item['quantity']<1){
						$this->db->transaction('rollback');
						$this->db->query_status=false;
						set_msg("msg","You can order less than 1 unit!");
						return;
					}
					//end note
				*/
				$query_arr = $item + ["order_id"=>$new_order_id];
				$this->db->insert("tbl_orders_details",array_keys($query_arr),array_values($query_arr));
			}
			//deduct
			foreach ($this->post_arr['cart'] as $item) {
				$sql = "UPDATE tbl_products SET unit_in_stock = unit_in_stock - ? WHERE product_id = ?";
				$this->db->query_stm($sql,[
					$item['quantity'],
					$item['product_id']
				]);
			}
			$this->db->transaction('commit');
			return true;
		}catch(\PDOException $e){
			$this->db->transaction('rollback');
			return false;
		}
	}

	public function update_status(){
		return $this->db->query_status;
	}
}
?>