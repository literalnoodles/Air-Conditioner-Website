<?php include "toast.javascript.php" ?>
<?php include "dataTables.javascript.php"; ?>
<script src='/plugins/select2/select2.min.js'></script>
<script src="/plugins/summernote/dist/summernote-bs4.min.js"></script>
<?php if ($action) : ?>
  <script>
    $(document).ready(function() {
      $("#inputFeature").select2({
        placeholder: "Select features",
        width: '100%'
      });
      $('#inputDescription').summernote({
        placeholder: 'Product description',
        tabsize: 2,
        height: 100
      });
    });
  </script>
<?php endif; ?>

<!-- show file input -->
<?php if ($action) : ?>
  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
<?php endif; ?>
<!-- end -->

<!-- delete existing document or picture -->
<?php if ($action == "edit") : ?>
  <script>
    $(document).ready(function() {
      $('#del_picture').on("click", function() {
        var conf = confirm("Do you want to delete");
        if (conf) {
          $('#del_picture').closest('tr').remove();
          $('#picture').attr('name', 'delete_picture');
        };
      });
      $('#del_document').on("click", function() {
        var conf = confirm("Do you want to delete");
        if (conf) {
          $('#del_document').closest('tr').remove();
          $('#document').attr('name', 'delete_document');
        };
      });
    })
  </script>
<?php endif; ?>
<!-- delete -->