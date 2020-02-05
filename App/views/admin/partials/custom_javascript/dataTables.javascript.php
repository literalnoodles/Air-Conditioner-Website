<script src='/plugins/DataTables/datatables.js'></script>
<?php
switch ($section_name) {
  case "brands":
    $table = "#tbl_brands";
    break;
  case "categories":
    $table = "#tbl_categories";
    break;
  case "deliveries":
    $table = "#tbl_deliveries";
    break;
  case "products":
    $table = "#tbl_products";
    break;
  case "orders":
    $table = "#tbl_orders";
    break;
}
?>
<script>
  $(document).ready(function() {
    var table = $("<?= $table; ?>").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "/admin/ajax_process?type=<?= $section_name; ?>"
    });
    $("<?= $table; ?>").on("click", ".delete", function() {
      var row = $(this).parents('tr');
      var conf = confirm("Do you want to delete");
      if (conf) {
        var request = $.ajax({
          url: "/admin/delete-section?page=<?= $section_name; ?>",
          method: "POST",
          data: {
            id: this.value
          }
        });
        request.done(function(msg) {
          toastr.success(msg, 'Information');
          if (msg == "Delete successfully!") table.draw();
        });
        request.fail(function() {
          toastr.error('Request fail!', 'Information');
        });
      }
    });
  });
</script>