<?php 
namespace App\Models;
use App\Core\App;
use App\Core\Database\upload;
class product
{
	// public $update_status;
	public $count_results;
	function __construct(){
		$this->db = App::get('database');
		$this->post_arr=$_POST;
		foreach ($this->post_arr as $key => $value) {
			if ($value==='') $this->post_arr[$key]=null;
		}
	}

	private function set_msg($msg){
		if (!isset($_SESSION["msg"])) $_SESSION["msg"]=$msg;
		else $_SESSION["msg"].="<br>{$msg}";
	}
	public function add(){
		// upload to server
		$picture_upload = new upload("./storage/product_pictures/");
		$picture_upload->parse_tag_name("picture");
		$picture_upload->validation("image",1048576);
		if ($picture_upload->validated){
			$this->post_arr["picture"] = $picture_upload->target_file;
		}else{
			$this->set_msg("No picture was uploaded");
		}
		$document_upload = new upload("./storage/product_documents/");
		$document_upload->parse_tag_name("document");
		$document_upload->validation("document",1048576);
		if ($document_upload->validated){
			$this->post_arr["document"] = $document_upload->target_file;
		}else{
			$this->set_msg("No document was uploaded");
		}
		//end upload
		// get the feature array out of post array
		if (array_key_exists("features_arr",$this->post_arr)){
			$features_arr=$this->post_arr["features_arr"];
			unset($this->post_arr["features_arr"]);
		}else{
			$features_arr=[];
		}
		try{
			$this->db->insert("tbl_products",array_keys($this->post_arr),array_values($this->post_arr));
			if (!$this->db->query_status) return;
			//if insert successful then update all the features the product has
			$new_id = $this->db->get_last_id();
			foreach ($features_arr as $feature_id) {
				$this->db->insert("tbl_features_products",["feature_id","product_id"],[$feature_id,$new_id]);
			}
			// if query successful then upload
			if ($this->db->query_status===true) {
				$picture_upload->execute();
				$document_upload->execute();
			}
		}catch(\PDOException $e){
			handle_exception($e->getCode());
			$this->db->query_status=false;
		}
	}

	public function edit(){
		if (array_key_exists('delete_picture', $this->post_arr)) {
			$picture_to_delete = $this->post_arr['delete_picture'];
			unset($this->post_arr['delete_picture']);
			$this->post_arr['picture']=null;
		}
		if (array_key_exists('delete_document', $this->post_arr)) {
			$document_to_delete = $this->post_arr['delete_document'];
			unset($this->post_arr['delete_document']);
			$this->post_arr['document']=null;
		}
		// check if having any old image
		$old_picture = filter_input(INPUT_POST, "picture");
		$old_document = filter_input(INPUT_POST, "document");
		// check new img or doc
		$picture_upload = new upload("./storage/product_pictures/");
		$picture_upload->parse_tag_name("picture");
		$picture_upload->validation("image",1048576);
		$document_upload = new upload("./storage/product_documents/");
		$document_upload->parse_tag_name("document");
		$document_upload->validation("image",1048576);
		if ($picture_upload->validated){
			if ($old_picture) $picture_to_delete=$old_picture;
			$this->post_arr["picture"] = $picture_upload->target_file;
		}else{
			$this->set_msg("No picture was uploaded");
		}
		if ($document_upload->validated){
			if ($old_document) $document_to_delete=$old_document;
			$this->post_arr["document"] = $document_upload->target_file;
		}else{
			$this->set_msg("No document was uploaded");
		}
		$product_id = $this->post_arr['product_id'];
		unset($this->post_arr['product_id']);

		try{
			if (array_key_exists("features_arr",$this->post_arr)){
				$features_arr=$this->post_arr["features_arr"];
				unset($this->post_arr["features_arr"]);
				//delete all features of product then re-update
				$this->db->delete("tbl_features_products",["product_id"=>$product_id]);
				foreach ($features_arr as $feature_id) {
				$this->db->insert("tbl_features_products",["feature_id","product_id"],[$feature_id,$product_id]);
				}
			}

			$this->db->update("tbl_products",$this->post_arr,["product_id"=>$product_id]);
			if ($this->db->query_status===true){
				if (file_exists($picture_to_delete)) unlink($picture_to_delete);
				if (file_exists($document_to_delete)) unlink($document_to_delete);
				// if ($old_picture) unlink($old_picture);
				$picture_upload->execute();
				$document_upload->execute();
			}
			$this->db->query_status=true;
		}catch(\PDOException $e){
			$this->db->query_status=false;
		}
	}

	public function delete($id){
		// get picture and document path
		$picture = $this->db->where("tbl_products","picture",["product_id"=>$id],"column");
		$document = $this->db->where("tbl_products","document",["product_id"=>$id],"column");
		//delete from child table first
		$this->db->delete("tbl_features_products",["product_id"=>$id]);;
		//delete from parent table
		$this->db->delete("tbl_products",["product_id"=>$id]);
		if ($this->db->query_status===true){
			if ($picture) unlink($picture);
			if ($document) unlink($document);
		}
	}
	public function load_data($id){
		// select * from table where brand_id = id
		$data = $this->db->where("tbl_products","*",["product_id"=>$id]);
		$features_data = $this->db->where("tbl_features_products","feature_id",["product_id"=>$id]);
		if ($data){
			$data=$data[0]+array(
			"features_arr"=>array_map(
				function($d){
					return $d["feature_id"];
				},
				$features_data)
			);
		}else{
			$data=NULL;
		}
		return $data;
	}

	public function get_filter_statement($type){
		$filter = $_SESSION["filter"];
		$condition_arr = [];
		$param_arr= [];
		if ($type=='count'){
			$sql = "SELECT COUNT(1) FROM ";
		}else if ($type=='get_data'){
			$sql = "SELECT tbl_products.product_id AS product_id,product_name,tbl_products.description as description,tbl_products.brand_id AS brand_id,tbl_products.category_id as category_id,unit_price,discount,unit_in_stock,tbl_products.picture AS picture,apower_consumption,cooling_capacity,effective_range,n_ways,status,inverter,energy_label,release_date,country_of_origin,warranty_period,document,short_description,tbl_brands.brand_name as brand_name,tbl_categories.category_name as category_name FROM ";
		}
		$sql.= isset($filter["feature_id"]) && $filter["feature_id"] ? "tbl_features_products," : "";
		$sql.= "tbl_products,tbl_brands,tbl_categories";
		if (isset($filter["search_term"]) && $filter["search_term"]){
			$search_term_filter = "product_name LIKE ?";
			$param_arr[] = "%{$filter['search_term'][0]}%";
			$condition_arr[] = $search_term_filter;
		}
		if (isset($filter["brand_id"]) && $filter["brand_id"]) {
			$brand_filter = "tbl_products.brand_id IN (" ;
			$brand_filter .= implode(",",array_map(function(){return "?";},$filter["brand_id"])) ;
			$brand_filter .= ")";
			$param_arr = array_merge($filter["brand_id"],$param_arr);
			$condition_arr[] = $brand_filter;
		};
		if (isset($filter["category_id"]) && $filter["category_id"]) {
			$category_filter = "tbl_products.category_id IN (" ;
			$category_filter .= implode(",",array_map(function(){return "?";},$filter["category_id"])) ;
			$category_filter .= ")";
			$param_arr = array_merge($param_arr,$filter["category_id"]);
			$condition_arr[] = $category_filter;
		};
		if (isset($filter["feature_id"]) && $filter["feature_id"]) {
			$feature_filter = "feature_id IN (" ;
			$feature_filter .= implode(",",array_map(function(){return "?";},$filter["feature_id"])) ;
			$feature_filter .= ") AND tbl_products.product_id=tbl_features_products.product_id";
			$param_arr = array_merge($param_arr,$filter["feature_id"]);
			$condition_arr[] = $feature_filter;
		};
		if (isset($filter["price_filter"]) && $filter["price_filter"]){
			$price_filter = "unit_price*(100-discount)/100 BETWEEN ? and ?";
			$param_arr = array_merge($param_arr,$filter["price_filter"]);
			$condition_arr[] = $price_filter;
		}
		
		$condition_arr[] = "tbl_products.brand_id=tbl_brands.brand_id";
		$condition_arr[] = "tbl_products.category_id=tbl_categories.category_id";
		if ($condition_arr){
			$sql.= " WHERE ";
			$sql.= implode(" AND ",$condition_arr);
		}
		
		if (isset($filter["sort"]) && $filter["sort"]!==[]){
			$sort_value = $filter["sort"][0];
			switch ($sort_value) {
				case 0:
					$sql .= " ORDER BY status ASC, unit_in_stock DESC";
					break;
				case 1:
					$sql .= " ORDER BY unit_price ASC";
					break;
				case 2:
					$sql .= " ORDER BY unit_price DESC";
					break;
				case 3:
					$sql .= " ORDER BY product_name";
					break;
				case 4:
					$sql .= " ORDER BY brand_name";
					break;
				case 5:
					$sql .= " ORDER BY category_name";
					break;
				default:
					$sql .= " ORDER BY product_name";
			}
		}
		return array(
			'sql'=>$sql,
			'param_arr'=>$param_arr
		);
	}

	public function load_sample(){
		$sql = "SELECT * from tbl_products LIMIT 15";
		$data = $this->db->query_stm($sql,array(),'array');
		return $data;
	}

	public function load_categories_sample($category_id){
		$sql = "SELECT * FROM tbl_products WHERE category_id = ? LIMIT 15";
		return ($this->db->query_stm($sql,array($category_id),"array"));
	}

	public function load_all($page){
		$page_size = 12;
		$filter = $this->get_filter_statement('get_data');
		$sql = $filter['sql'];
		$param_arr = $filter['param_arr'];
		$sql.= " LIMIT ?,?";
		$param_arr = array_merge($param_arr,array(($page-1)*$page_size,$page_size));
		$result = $this->db->query_stm($sql,$param_arr,'array');
		return $result;
	}

	public function load_details($product_id){
		$sql = "SELECT tbl_products.product_id AS product_id,product_name,tbl_products.description as description,tbl_products.brand_id AS brand_id,tbl_products.category_id as category_id,unit_price,discount,unit_in_stock,tbl_products.picture AS picture,apower_consumption,cooling_capacity,effective_range,n_ways,status,inverter,energy_label,release_date,country_of_origin,warranty_period,document,short_description,tbl_brands.brand_name as brand_name,tbl_categories.category_name as category_name FROM tbl_products,tbl_brands,tbl_categories WHERE tbl_products.brand_id AND tbl_products.category_id = tbl_categories.category_id AND product_id=?";
		$data = $this->db->query_stm($sql,array($product_id),'array');
		$sql = "SELECT tbl_features.feature_id AS feature_id,feature_name,description FROM tbl_features,tbl_features_products WHERE product_id=? AND tbl_features_products.feature_id=tbl_features.feature_id";
		$features_data = $this->db->query_stm($sql,array($product_id),'array');
		if ($data){
			$data=$data[0]+array(
				"features_arr"=>array_map(
					function($d){
						return array(
							'feature_id'=>$d['feature_id'],
							'feature_name'=>$d['feature_name'],
							'description'=>$d['description']
						);
					},
					$features_data)
			);
		}else{
			$data=NULL;
		}
		return $data;
	}

	public function count_results(){
		$filter = $this->get_filter_statement('count');
		$sql = $filter['sql'];
		$param_arr = $filter['param_arr'];
		return $this->db->query_stm($sql,$param_arr,"column");
	}

	

	public function assign_filter($filter_arr,$unset_filter=false){
		//default filter
		$filter_arr["sort"] = 0;
		//unset old filter
		if ($unset_filter) unset($_SESSION["filter"]);
		if (!isset($_SESSION["filter"])) $_SESSION["filter"]=[];
		foreach ($filter_arr as $key => $value) {
			$_SESSION["filter"][$key]= gettype($value)=='array' ? $value : [$value];
		}
	}

	public function update_filter($action,$item){
		if (!isset($_SESSION["filter"])) $_SESSION["filter"]=[];
		extract($item);
		switch ($action) {
			case 'add':
				if (!isset($_SESSION["filter"][$key])) $_SESSION["filter"][$key]=[];
				array_push($_SESSION["filter"][$key],$value);
				break;
			case 'remove':
				if (($delete_key = array_search($value,$_SESSION["filter"][$key])) !== false) {
					unset($_SESSION["filter"][$key][$delete_key]);
				}
				break;
			case 'change':
				if ($key=='price_filter') $value = json_decode($value);
				$_SESSION['filter'][$key] = $value;
				break;
		}
		echo json_encode($_SESSION['filter']);
	}

	public function update_status(){
		return $this->db->query_status;
	}
}
