<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/plugins/admin-lte/js/adminlte.js"></script>

<!-- only for brand-->
<?php if ($section_name == "brands"): ?>
<?php switch($action): ?>
<?php case "add": ?>
  <script>
  	$(".custom-file-input").on("change", function() {
  		var fileName = $(this).val().split("\\").pop();
  		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  	});
  </script>
<?php break; ?>
<?php case"edit": ?>
<!--   <script>
    $(document).ready(function(){
      $('#del_logo').on("click",function(){
        console.log(this);
      })
    })
  </script> -->
<?php break; ?>
<?php default: ?>
  <script src="/plugins/toastr/toastr.js"></script>
  <script src='/plugins/DataTables/datatables.js'></script>
  <script>
    $(document).ready(function() {
      var table = $('#tbl_brands').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "/admin/ajax_process?type=brands"
        // "ajax": "./plugins/DataTables/brands.processing.php"
      } );
      $('#tbl_brands').on("click",".delete",function(){
        var row = $(this).parents('tr');
        var conf = confirm("Do you want to delete");
        if (conf){
          var request = $.ajax({
            url: "/admin/delete-brand",
            method: "POST",
            data: { id : this.value }
          });
          request.done(function(msg) {
            toastr.success(msg,'Information');
            if(msg=="Delete successfully!") table.draw();
          });
          request.fail(function() {
            toastr.error('Request fail!','Information');
          });
        }
      });
    });
    <?php
      if (isset($_SESSION['status'])) {
        $status = $_SESSION['status'];
        $title = ($status=="success") ? "Update successfully!" : "Update fail!";
        $msg = isset($_SESSION['msg'])? $_SESSION['msg'] : "";
        echo "toastr.{$status}('{$msg}','{$title}');";
        unset($_SESSION['status']);
        unset($_SESSION['msg']);
      }
    ?>
  </script>
<?php endswitch; ?>
<?php endif; ?>
<!-- end brand -->

