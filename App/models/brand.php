<?php 
namespace App\Models;
use App\Core\App;
use App\Core\Database\upload;
/**
 * 
 */
class brand
{
	// public $update_status;
	function __construct(){
		$this->db = App::get('database');
	}
	public function add(){
		$post_arr = $_POST;
		// upload image to server
		$logo_upload = new upload("./storage/brands_logo/");
		$logo_upload->parse_tag_name("logo");
		$logo_upload->validation("image",1048576);
		if ($logo_upload->validated){
			$logo_upload->execute();
			$post_arr["logo"] = $logo_upload->target_file;
		}else{
			$_SESSION["msg"] ="No logo was uploaded";
		}
		$this->db->insert("tbl_brand",array_keys($post_arr),array_values($post_arr));
		// $this->update_status = $db->query_status;
	}

	public function edit(){
		$post_arr = $_POST;
		// check if having any old image
		$old_img = filter_input(INPUT_POST, "logo");
		// upload image to server
		$logo_upload = new upload("./storage/brands_logo/");
		$logo_upload->parse_tag_name("logo");
		$logo_upload->validation("image",1048576);
		if ($logo_upload->validated){
			// If new img existed, delete the old image (if exists) then upload the new img
			if ($old_img) unlink($old_img);
			$logo_upload->execute();
			$post_arr["logo"] = $logo_upload->target_file;
		}else{
			$_SESSION["msg"] ="No logo was uploaded";
		}
		$id = $post_arr['brand_id'];
		unset($post_arr['brand_id']);
		$this->db->update("tbl_brand",$post_arr,["brand_id"=>$id]);
		// $this->update_status = $db->query_status;
	}

	public function delete($id){
		// $db = App::get('database');
		$img = $this->db->where("tbl_brand",["brand_id"=>$id],"logo","column");
		if ($img) unlink($img);
		$this->db->delete("tbl_brand",["brand_id"=>$id]);
		// $this->update_status = $db->query_status;
	}
	public function load_data($id){
		// select * from table where brand_id = id
		$data = $this->db->where("tbl_brand",["brand_id"=>$id],"*");
		return $data ? $data[0] : NULL;
	}
	public function update_status(){
		return $this->db->query_status;
	}


}
?>