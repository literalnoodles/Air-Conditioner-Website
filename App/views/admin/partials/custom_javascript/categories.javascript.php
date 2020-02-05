<?php include "dataTables.javascript.php"; ?>
<?php include "toast.javascript.php" ?>
<?php if ($action): ?>
  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
<?php endif; ?>
<?php if ($action=="edit"): ?>
  <script>
    $(document).ready(function(){
      $('#del_picture').on("click",function(){
        var conf = confirm("Do you want to delete");
        if(conf){
          $('#del_picture').closest('tr').remove();
          $('#picture').attr('name','delete');
          };
      })
    })
  </script>
<?php endif; ?>
