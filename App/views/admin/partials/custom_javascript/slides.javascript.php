<?php include "toast.javascript.php" ?>
<script>
    $(document).ready(function() {
        $("#inputFile").on("change", function() {
            output = [];
            files = this.files;
            for (file of files) {
                output.push(file.name);
            }
            $(".custom-file-label").html(output.join(' | '));
        });

        $('.slide-delete').on("click", function() {
            row_data = $(this).closest('tr');
            slide_id = $(this).data('slideid');
            if (confirm("Do you want to delete")) {
                $.ajax({
                    url: "/admin/ajax_process?type=slides&action=delete",
                    type: "POST",
                    data: {
                        'slide_id': slide_id
                    },
                    success: function(response) {
                        result = JSON.parse(response);
                        if (result == true) {
                            toastr.success('Deleted succesfully', 'Success!');
                            row_data.remove();
                        } else {
                            toastr.error('Something went wrong!', 'Error!')
                        }
                    }
                })
            };
        })

    })
</script>