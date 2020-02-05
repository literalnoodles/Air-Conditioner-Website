<?php
$table = "tbl_brands";
$primaryKey = 'brand_id';
$columns = array(
	array( 'db' => 'brand_name',  'dt' => 0 ),
	array(
		'db'       => 'description',
		'dt'       => 1,
		'formatter'=> function($d,$row){
			if (strlen($d)>70){
				$s = strpos($d," ",70);
				return substr($d,0,$s)." (<a href='/admin?page=brands&action=edit&id={$row[5]}'>See more</a>...)";
			}
			return $d;
		}
	),
	// array( 'db' => 'description', 'dt' => 1 ),
	array( 'db' => 'address',     'dt' => 2 ),
	array( 'db' => 'phone_number','dt' => 3 ),
	array(
		'db'        => 'logo',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<img style='height: 50px' src='" . $d . "'/>";
			// return date( 'jS M y', strtotime($d));
		}
	),
	array(
		'db'        => 'brand_id',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "<a href='/admin?page=brands&action=edit&id={$d}' role='button' class='btn'><i class='fa fa-edit'></i></a>
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
