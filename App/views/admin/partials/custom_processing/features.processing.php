<?php
use App\Models\feature;
$feature_process = new feature();
$action = filter_input(INPUT_GET,"action");
switch ($action) {
	case 'insert':
		//add value to server
		$feature_process->insert();
		break;
	
	case 'update':
		$feature_process->update();
		break;

	case "delete":
		$id = filter_input(INPUT_GET,"feature_id");
		$feature_process->delete($id);
		break;

	case "get":
		$id = filter_input(INPUT_GET,"feature_id");
		echo json_encode($feature_process->get_info($id));
		break;

	default:
		$result = $feature_process->get_all();
		if (count($result)){
			echo json_encode($feature_process->get_all());
		}
}

?>