<?php
	$page_name = filter_input(INPUT_GET, "page");
	$action = filter_input(INPUT_GET, "action");
?>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <!-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="/plugins/admin-lte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="/plugins/admin-lte/css/Source_Sans_Pro.css" rel="stylesheet">
<?php if ($section_name == "brands" && $action == NULL) : ?>
  <link rel="stylesheet" href="/plugins/toastr/toastr.css">
	<link rel='stylesheet' href='/plugins/DataTables/datatables.css'>
<?php endif; ?>
