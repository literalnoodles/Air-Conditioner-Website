<?php include "dataTables.javascript.php"; ?>
<?php include "toast.javascript.php" ?>

<!-- show file input -->
<?php if ($action): ?>
  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
<?php endif; ?>
<!-- end -->

<!-- delete existing picture -->
<?php if ($action=="edit"): ?>
  <script>
    $(document).ready(function(){
      $('#del_logo').on("click",function(){
        var conf = confirm("Do you want to delete");
        if(conf){
          $('#del_logo').closest('tr').remove();
          $('#logo').attr('name','delete');
          };
      })
    })
  </script>
<?php endif; ?>
<!-- delete existing picture -->