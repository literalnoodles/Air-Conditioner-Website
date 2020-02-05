<?php 
namespace App\Models;
use App\Core\App;
class user
{
	function __construct()
	{
		$this->db = App::get('database');
		$this->post_arr=$_POST;
		foreach ($this->post_arr as $key => $value) {
			if ($value==='') $this->post_arr[$key]=null;
		}
	}

	public function register(){
		//add information to user table
		$this->db->transaction('begin');
		try{
			$this->post_arr["password"] = password_hash($this->post_arr["password"], PASSWORD_DEFAULT);
			$this->db->insert("tbl_users",array_keys($this->post_arr),array_values($this->post_arr));
			set_msg("msg","Successfully registered, you can now login ...");
			set_msg("status","success");
			$this->db->transaction('commit');
			$this->db->query_status = true;		
		}catch(\PDOException $e){
			$this->db->transaction('rollback');
			set_msg("status","error");
		}
	}

	public function verify($username,$password){
		$ref_password = $this->db->where("tbl_users","password",["username"=>$username],"column");
		if($ref_password && password_verify($password,$ref_password)){
			return true;
		}else{
			return false;
		}
	}

	public function login($username,$remember=false,$notify=false){
		$user_id = $this->get_id($username);
		$_SESSION["user"]=$user_id;
		$_SESSION["username"]=$username;
		if ($notify){
			set_msg("status","success");
			set_msg("msg","Login successfully!");
		}
		if ($remember){
			$this->set_token($user_id);
		}
	}

	public function logout(){
		unset($_SESSION["user"]);
		unset($_SESSION["username"]);
		set_msg("status","success");
		set_msg("msg","Logout successfully!");
		if (!empty($_COOKIE['remember'])){
			list($selector, $authenticator) = explode(':', $_COOKIE['remember']);
			setcookie("remember","", time() - 3600);
		}
		$this->delete_token($selector);
	}

	public function change_password(){
		$username = $this->post_arr["username"];
		$old_password = $this->post_arr["old_password"];
		$new_password = $this->post_arr["new_password"];
		if ($this->verify($username,$old_password)){
			try{
				$this->db->update("tbl_users",
					[
						"password"=>password_hash($new_password, PASSWORD_DEFAULT)
					],
					[
						"username"=>$username
					]
				);
				//delete auth token if exists
				$user_id = $this->get_id($username);
				$this->db->delete("auth_tokens",["user_id"=>$user_id]);
				set_msg("status","success");
				set_msg("msg","Change password successfully!");
				if (!empty($_COOKIE['remember'])){
					setcookie("remember","", time() - 3600);
				}
			}catch(\PDOException $e){
				set_msg("status","error");
				set_msg("msg",$e->getMessage());
			}
		}else{
			set_msg("status","error");
			set_msg("msg","Invalid username or password");
		}

	}

	public function get_id($username){
		return $this->db->where("tbl_users","user_id",["username"=>$username],"column");
	}

	public function get_username($user_id){
		return $this->db->where("tbl_users","username",["user_id"=>$user_id],"column");
	}

	public function check_exists_username($username){
		return $this->db->where("tbl_users",1,["username"=>$username],"column"); 
	}

	public function set_token($user_id){
		$selector = base64_encode(random_bytes(9));
		$authenticator = random_bytes(33);
		setcookie(
			'remember',
			$selector.':'.base64_encode($authenticator),
			time() + 864000,
			'/',
    	);
    	$this->db->insert("auth_tokens",
    		[
				"selector",
				"token",
				"user_id",
				"expires"
			],
			[
				$selector,
				hash('sha256', $authenticator),
				$user_id,
				date('Y-m-d\TH:i:s', time() + 864000)
			]
		);
	}

	public function delete_token($selector){
		$this->db->delete("auth_tokens",["selector"=>$selector]);
	}

	public function parse_selector($selector){
		$result = $this->db->where("auth_tokens","*",["selector"=>$selector]);
		return $result ? $result[0] : null;
	}

	public function update_status(){
		return $this->db->query_status;
	}

	public function load_info($id,$col_arr){
		$col = implode(',',$col_arr);
		$result = $this->db->where("tbl_users",$col,["user_id"=>$id],'array');
		return $result[0];
	}

	public function load_orders($id){
		$result = [];
		$orders = $this->db->where("tbl_orders","order_id,order_date,status",["user_id"=>$id],"array");
		foreach($orders as $order){
			$sql = "SELECT product_name,quantity FROM tbl_products x,tbl_orders_details y WHERE x.product_id = y.product_id AND order_id = ?";
			$product_arr = $this->db->query_stm($sql,[$order['order_id']],"array");
			$arr = implode('<br>',array_map(function($item){
				return "{$item['product_name']} x {$item['quantity']}";
				},$product_arr));
			$result[] = array(
				'status'=>$order['status'],
				'order_id'=>$order['order_id'],
				'order_date'=>$order['order_date'],
				'order_items'=>$arr
			);
		}
		return ($result);
	}
}
?>