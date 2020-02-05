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
                            <form action="/user/change_password" method="post">
                                <label for="inputUsername">Username</label>
                                <input type="text" id="inputUsername" name="username" placeholder="Username" required="">

                                <label for="old_pword">Old password</label>
                                <input type="password" id="old_pword" name="old_password" placeholder="Your old password" required="">

                                <label for="new_pword">Password</label>
                                <input type="password" id="new_pword" name="new_password" placeholder="New password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="">

                                <label for="re_pword">Retype Password</label>
                                <input type="password" id="re_pword" placeholder="Retype Password" required="">
                                <div class="button-box">
                                    <button type="submit" class="default-btn floatright">Change password</button>
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