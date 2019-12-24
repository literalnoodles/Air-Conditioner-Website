<?php
namespace App\Core\Database;
/**
 * 
 */
class upload
{
	public $validated;
	public $target_file;
	public $target_dir;
	public $file_type;
	public $file_size;
	public $dir;
	function __construct($dir)
	{
		$this->target_dir = $dir;
		$this->validated = 1;
	}
	public function parse_tag_name($tag){
		$this->tag = $tag;
		$this->target_file = $this->target_dir . uniqid(). "." . pathinfo($_FILES[$tag]['name'],PATHINFO_EXTENSION);
		$this->file_type = strtolower(pathinfo($this->target_file,PATHINFO_EXTENSION));
		$this->file_size = $_FILES[$tag]["size"];
	}
	public function validation($type,$max_size){
		if ($type=="image"){
			if (file_exists($this->target_file)) $this->validated = 0;
			if ($this->file_size>$max_size || $this->file_size==0) $this->validated = 0;
		}
	}
	public function execute(){
		if ($this->validated) move_uploaded_file($_FILES[$this->tag]["tmp_name"], $this->target_file);
	} 

}

?>