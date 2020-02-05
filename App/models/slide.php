<?php 
namespace App\Models;
use App\Core\App;
use App\Core\Database\upload;
class slide
{
    // public $update_status;
    private $max_size;
	function __construct(){
        $this->db = App::get('database');
        $this->max_size = 1048576;
        $this->target_dir = "./storage/slides/";
    }
    
    public function upload_slide($slides){
        $this->db->transaction('begin');
        $upload_arr=[];
        try {
            foreach ($slides as $slide){
                //generate unique id
                $target_file = $this->target_dir . uniqid(). "." . pathinfo($slide['name'],PATHINFO_EXTENSION);
                $this->db->insert('tbl_slides',['path'],[$target_file]);
                $upload_arr[] = array(
                    "path"=>$target_file,
                    "temp"=>$slide['tmp_name']
                );
            }
            $this->db->transaction('commit');
            //upload
            foreach($upload_arr as $item){
                move_uploaded_file($item['temp'],$item['path']);
            }
            return true;
        } catch(\PDOException $e){
            $this->db->transaction('rollback');
            return false;
        }
    }

	public function update(){
        $slides = reArrayFiles($_FILES['slides']);
        //validation
        $validate = true;
        foreach ($slides as $slide){
            if ($slide['size'] > $this->max_size || $slide['size']==0){
                $validate = false;
                break;
            }
        }
        if ($validate){
            $result = $this->upload_slide($slides);
            if ($result){
                $_SESSION['status'] = "success";
                $_SESSION['msg'] = "Uploaded successfully";
            }else{
                $_SESSION['status'] = "error";
                $_SESSION['msg'] = "Something went wrong with your upload";
            }
        }else{
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Please choose suitable image (size limite: 1Mb)";
        }
    }
    
    public function delete($slide_id){
        $this->db->transaction('begin');
        try {
            //get img path
            $path = $this->db->where('tbl_slides','path',['slide_id'=>$slide_id],'column');
            //delete slide from the database
            $this->db->delete('tbl_slides',['slide_id'=>$slide_id]);
            $this->db->transaction('commit');
            //delete from server
            if(file_exists($path)) unlink($path);
            return true;
        } catch(\PDOException $e){
            $this->db->transaction('rollback');
            return false;
        }
    }

    public function load_all(){
        return $this->db->where('tbl_slides','*');
    }
}
?>