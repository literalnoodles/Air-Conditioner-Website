<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/plugins/admin-lte/js/adminlte.js"></script>
<?php if($section_name=='brands') include(dirname(__FILE__).'/custom_javascript/brands.javascript.php'); ?>
<?php if($section_name=='categories') include(dirname(__FILE__).'/custom_javascript/categories.javascript.php'); ?>
<?php if($section_name=='deliveries') include(dirname(__FILE__).'/custom_javascript/deliveries.javascript.php'); ?>
<?php if ($section_name=="features") include(dirname(__FILE__).'/custom_javascript/features.javascript.php'); ?>
<?php if ($section_name=="products") include(dirname(__FILE__).'/custom_javascript/products.javascript.php'); ?>
<?php if ($section_name=="orders") include(dirname(__FILE__).'/custom_javascript/orders.javascript.php'); ?>
<?php if ($section_name=="slides") include(dirname(__FILE__).'/custom_javascript/slides.javascript.php'); ?>

