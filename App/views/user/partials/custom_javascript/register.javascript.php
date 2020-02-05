<script>
	var password = $("#pword")[0];
	var confirm_password = $("#re_pword")[0];
	function validatePassword(){
		if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("Passwords Don't Match");
		} else {
			confirm_password.setCustomValidity('');
		}
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
	$('#inputUsername').change(function(){
		$.ajax({
	        url: "/user/ajax_process?type=register",
	        data: { "username": this.value },
	        type: "post",
	        success: function(data){
	        	if(!data){
	        		$("#user_check").html("");
	        	}else{
	        		$("#user_check").html(" | This username is already taken").css('color','red');
	        	}
	        }
    	});
    });

</script>