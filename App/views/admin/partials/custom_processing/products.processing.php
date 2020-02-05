<?php
$table = "tbl_products";
$primaryKey = 'product_id';
$columns = array(
    array( 'db' => '`c`.`product_name`',  'dt' => 0, 'field' => 'product_name'),
    array( 'db' => '`cn`.`brand_name`',   'dt' => 1, 'field' => 'brand_name'),
    array( 'db' => '`cm`.`category_name`','dt' => 2, 'field' => 'category_name'),
    array( 'db' => '`c`.`unit_in_stock`', 'dt' => 3, 'field' => 'unit_in_stock'),
    array( 
    	'db' => '`c`.`picture`',
    	'dt' => 4,
	    'formatter' => function( $d, $row ) {
			return "<img style='max-height: 50px' src='" . $d . "'/>";
		},
    	'field' => 'picture' ),
    array( 
    	'db' => '`c`.`status`',
    	'formatter' => function( $d, $row ){
			return (($d==1) ? 'Coming soon' : (($d==2) ? 'Ready' : 'Discontinued'));
            },
        'dt' => 5,
        'field' => 'status' ),
    array(
    	'db' => '`c`.`discount`',
    	'dt' => 6,
    	'formatter' => function( $d, $row ) {
			return (!$d) ? "" : "{$d}%";
		},
    	'field' => 'discount'),
    array(
		'db'        => '`c`.`product_id`',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "<a href='/admin?page=products&action=edit&id={$d}' role='button' class='btn'><i class='fa fa-edit'></i></a>
<button class='btn delete' value='{$d}'><i class='fa fa-trash'></i></button>";
		},
		'field' => 'product_id'
	)
);
$joinQuery = "FROM `{$table}` AS `c` LEFT JOIN `tbl_brands` AS `cn` ON (`cn`.`brand_id` = `c`.`brand_id`) LEFT JOIN `tbl_categories` AS `cm` ON (`cm`.`category_id` = `c`.`category_id`)";

 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'cosy_airconditioner',
    'host' => '127.0.0.1'
);

require( './plugins/DataTables/ssp.php' );
echo json_encode(
       SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery)
     );
?>