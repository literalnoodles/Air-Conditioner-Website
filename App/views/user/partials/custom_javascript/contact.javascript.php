<script>
    $(document).ready(function() {
        $("#btnSubmit").on("click", function() {
            email = $("input[name='email']").val();
            name = $("input[name='name']").val();
            subject = $("input[name='subject']").val();
            message = $("textarea[name='message']").val();
            $.ajax({
                url: "/send-email",
                method: "POST",
                data: {
                    email,
                    name,
                    subject,
                    message
                },
            })
            $.alert({
                title:"Success",
                content: "Your email was sent successfully"
            })
        });
    });
</script>