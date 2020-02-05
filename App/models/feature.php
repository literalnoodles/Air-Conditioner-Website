<?php
namespace App\Models;
use App\Core\App;

class feature
{
	function __construct(){
		$this->db = App::get('database');
	}

	public function insert(){
		$this->post_arr = [
			"feature_name"=>filter_input(INPUT_POST,"feature_name"),
			"description"=>filter_input(INPUT_POST,"description")
		];
		$this->db->insert("tbl_features",array_keys($this->post_arr),array_values($this->post_arr));
		echo ($this->db->query_status==true) ? "success" : "error";
	}

	public function update(){
		$condition_arr = [
			"feature_id"=>filter_input(INPUT_POST,"feature_id")
		];
		$set_arr = [
			"feature_name"=>filter_input(INPUT_POST,"feature_name"),
			"description"=>filter_input(INPUT_POST,"description")
		];

		$this->db->update("tbl_features",$set_arr,$condition_arr);
		echo ($this->db->query_status==true) ? "success" : "error";
	}

	public function delete($id){
		$del_arr = [
			"feature_id"=>$id
		];
		$this->db->delete("tbl_features",$del_arr);
		echo ($this->db->query_status==true) ? "success" : "error";
	}

	public function get_info($id){
		$get_arr = [
			"feature_id"=>$id
		];
		$result = $this->db->where("tbl_features",["feature_name","description"],$get_arr);
		return $result;
	}

	public function get_all(){
		$sql = "SELECT * FROM tbl_features";
		$result = $this->db->query_stm($sql,NULL,"array");
		return $result;
	}

	public function load_names(){
		return $this->db->where("tbl_features",["feature_id","feature_name"]);
	}
}

?>