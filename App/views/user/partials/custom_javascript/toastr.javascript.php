<script src="/plugins/toastr/toastr.js"></script>
<script>
<?php
  if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    $title = ($status=="success") ? "Successfully!" : "Something went wrong!";
    $msg = isset($_SESSION['msg'])? $_SESSION['msg'] : "";
    echo "toastr.{$status}('{$msg}','{$title}');";
    unset($_SESSION['status']);
    unset($_SESSION['msg']);
  }
?>
</script>