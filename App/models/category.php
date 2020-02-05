<?php 
namespace App\Models;
use App\Core\App;
use App\Core\Database\upload;
class category
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
		$picture_upload = new upload("./storage/categories_img/");
		$picture_upload->parse_tag_name("picture");
		$picture_upload->validation("image",1048576);
		if ($picture_upload->validated){
			$this->post_arr["picture"] = $picture_upload->target_file;
		}else{
			$_SESSION["msg"] ="No picture was uploaded";
		}
		try{
			$this->db->insert("tbl_categories",array_keys($this->post_arr),array_values($this->post_arr));
			if ($this->db->query_status===true) $picture_upload->execute();
		}catch(\PDOException $e){
			handle_exception($e->getCode());
			$this->db->query_status=false;
		}
	}

	public function edit(){
		if (array_key_exists('delete', $this->post_arr)) {
			$picture_to_delete = $this->post_arr['delete'];
			if (file_exists($picture_to_delete)) unlink($picture_to_delete);
			unset($this->post_arr['delete']);
			$this->post_arr['picture']=null;
		}
		// check if having any old image
		$old_img = filter_input(INPUT_POST, "picture");
		// upload image to server
		$picture_upload = new upload("./storage/categories_img/");
		$picture_upload->parse_tag_name("picture");
		$picture_upload->validation("image",1048576);
		if ($picture_upload->validated){
			if ($old_img) $picture_to_delete=$old_img;
			$this->post_arr["picture"] = $picture_upload->target_file;
		}else{
			$_SESSION["msg"] ="No picture was uploaded";
		}
		$id = $this->post_arr['category_id'];
		unset($this->post_arr['category_id']);
		try{
			$this->db->update("tbl_categories",$this->post_arr,["category_id"=>$id]);
			if ($this->db->query_status===true){
				if (file_exists($picture_to_delete)) unlink($picture_to_delete);
				$picture_upload->execute();
			}
			$this->db->query_status=true;
		}catch(\PDOException $e){
			$this->db->query_status=false;
		}
	}

	public function delete($id){
		$img = $this->db->where("tbl_categories","picture",["category_id"=>$id],"column");
		//delete from child table first
		$this->db->delete("tbl_products",["category_id"=>$id]);
		$this->db->delete("tbl_categories",["category_id"=>$id]);
		if ($this->db->query_status===true){
			if ($img) unlink($img);	
		}
	}
	public function load_data($id){
		// select * from table where category_id = id
		$data = $this->db->where("tbl_categories","*",["category_id"=>$id]);
		return $data ? $data[0] : NULL;
	}

	public function load_names(){
		return $this->db->where("tbl_categories",["category_id","category_name"]);
	}

	public function load_all($cols){
		$cols = gettype($cols)=="array" ? $cols : array($cols);
		return $this->db->where("tbl_categories",$cols);
	}

	public function update_status(){
		return $this->db->query_status;
	}
}
?>