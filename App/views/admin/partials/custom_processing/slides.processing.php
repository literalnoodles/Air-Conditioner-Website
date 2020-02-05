<?php 
    use App\Models\slide;
    $slide_process = new slide();
    $action = filter_input(INPUT_GET,"action");
    if ($action=="delete"){
        $slide_id = filter_input(INPUT_POST,"slide_id");
        $result = $slide_process->delete($slide_id);
        echo json_encode($result);
    }
?>