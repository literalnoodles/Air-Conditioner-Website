<?php
$table = "tbl_categories";
$primaryKey = 'category_id';
$columns = array(
	array( 'db' => 'category_name',  'dt' => 0 ),
	array(
		'db'       => 'description',
		'dt'       => 1,
		'formatter'=> function($d,$row){
			if (strlen($d)>70){
				$s = strpos($d," ",70);
				return substr($d,0,$s)." (<a href='/admin?page=categories&action=edit&id={$row[3]}'>See more</a>...)";
			}
			return $d;
		}
	),
	array(
		'db'        => 'picture',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "<img style='max-height: 50px' src='" . $d . "'/>";
			// return date( 'jS M y', strtotime($d));
		}
	),
	array(
		'db'        => 'category_id',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<a href='/admin?page=categories&action=edit&id={$d}' role='button' class='btn'><i class='fa fa-edit'></i></a>
<button class='btn delete' value='{$d}'><i class='fa fa-trash'></i></button>";
		}
	)
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'cosy_airconditioner',
    'host' => '127.0.0.1'
);
 
require( './plugins/DataTables/ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);
