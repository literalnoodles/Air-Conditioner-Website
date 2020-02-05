<?php 
namespace App\Models;
use App\Core\App;
class identity
{
	private $table,$identity,$check_col;
	function __construct($table_name)
	{
		$this->table = $table_name;
	}
	public function input($identity,$check_col){
		$this->identity = $identity;
		$this->check_col = $check_col;
	}
	public function check_password($password){
		$ref = App::get('database')->where($this->table,$this->check_col,$this->identity,"column");
		return password_verify($password,$ref);
	}
	public function get_col($col_name){
		return App::get('database')->where($this->table,$col_name,$this->identity,"column");
	}
}
?>