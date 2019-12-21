<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V18</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/plugins/login-admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/plugins/login-admin/css/util.css">
	<link rel="stylesheet" type="text/css" href="/plugins/login-admin/css/main.css">
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="/admin_login">
					<span class="login100-form-title p-b-43">
						Sign in to start your session
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Username not valid">
						<input class="input100" type="text" name="user">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>
					<div class="container-login100-form-btn m-t-40">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('/plugins/login-admin/images/bg-02.jpg');">
				</div>
			</div>
		</div>
	</div>
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/login-admin/js/main.js"></script>
</body>
</html>