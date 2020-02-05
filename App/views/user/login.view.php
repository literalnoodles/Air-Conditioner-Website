<?php include "partials/user.header.php"; ?>
<div class="breadcrumb-area pt-205 pb-210" style="background-image: url(/storage/user_register/2.png)">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2 >login</h2>
            <ul>
                <li><a href="/">home</a></li>
                <li> login </li>
            </ul>
        </div>
    </div>
</div>
<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <form action="/user/login" method="post">
                                <label for="inputUsername">Username</label>
                                <input type="text" id="inputUsername" name="username" placeholder="Username" required="">
                                <label for="inputPassword">Password</label>
                                <input type="password" id="inputPassword" name="password" placeholder="Password" required="">
                                <div class="button-box">
                                    <div class="login-toggle-btn">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember">Remember me</label>
                                        <!-- <a href="#">Forgot Password?</a> -->
                                    </div>
                                    <button type="submit" class="default-btn floatright">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "partials/user.footer.php"; ?>