<?php 
namespace App\Models;
use App\Core\App;
use App\Core\Database\upload;
class brand
{
	function __construct(){
		$this->db = App::get('database');
		$this->post_arr=$_POST;
		foreach ($this->post_arr as $key => $value) {
			if ($value==='') $this->post_arr[$key]=null;
		}
	}
	public function add(){
		// upload image to server
		$logo_upload = new upload("./storage/brands_logo/");
		$logo_upload->parse_tag_name("logo");
		$logo_upload->validation("image",1048576);
		if ($logo_upload->validated){
			$this->post_arr["logo"] = $logo_upload->target_file;
		}else{
			$_SESSION["msg"] ="No logo was uploaded";
		}
		try{
			$this->db->insert("tbl_brands",array_keys($this->post_arr),array_values($this->post_arr));
			if ($this->db->query_status===true) $logo_upload->execute();
		}catch(\PDOException $e){
			handle_exception($e->getCode());
			$this->db->query_status=false;
		}
	}

	public function edit(){
		if (array_key_exists('delete', $this->post_arr)) {
			$logo_to_delete = $this->post_arr['delete'];
			unset($this->post_arr['delete']);
			$this->post_arr['logo']=null;
		}
		// check if having any old image
		$old_img = filter_input(INPUT_POST, "logo");
		$logo_upload = new upload("./storage/brands_logo/");
		$logo_upload->parse_tag_name("logo");
		$logo_upload->validation("image",1048576);
		if ($logo_upload->validated){
			if ($old_img) $logo_to_delete=$old_img;
			$this->post_arr["logo"] = $logo_upload->target_file;
		}else{
			$_SESSION["msg"] ="No logo was uploaded";
		}
		$id = $this->post_arr['brand_id'];
		unset($this->post_arr['brand_id']);
		try{
			$this->db->update("tbl_brands",$this->post_arr,["brand_id"=>$id]);
			if ($this->db->query_status===true){
				if (file_exists($logo_to_delete)) unlink($logo_to_delete);
				$logo_upload->execute();
			}
			$this->db->query_status=true;
		}catch(\PDOException $e){
			$this->db->query_status=false;
		}
	}

	public function delete($id){
		$img = $this->db->where("tbl_brands","logo",["brand_id"=>$id],"column");
		//delete from child table first
		$this->db->delete("tbl_products",["brand_id"=>$id]);
		$this->db->delete("tbl_brands",["brand_id"=>$id]);
		if ($this->db->query_status===true){
			if ($img) unlink($img);	
		}
	}
	public function load_data($id){
		// select * from table where brand_id = id
		$data = $this->db->where("tbl_brands","*",["brand_id"=>$id]);
		return $data ? $data[0] : NULL;
	}

	public function load_names(){
		return $this->db->where("tbl_brands",["brand_id","brand_name"]);
	}

	public function load_all($cols){
		$cols = gettype($cols)=="array" ? $cols : array($cols);
		return $this->db->where("tbl_brands",$cols);
	}

	public function update_status(){
		return $this->db->query_status;
	}


}
?>