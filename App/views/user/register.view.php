<?php include "partials/user.header.php"; ?>
<div class="breadcrumb-area pt-205 pb-210" style="background-image: url(/storage/user_register/2.png)">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2 >register</h2>
            <ul>
                <li><a href="/">home</a></li>
                <li> register </li>
            </ul>
        </div>
    </div>
</div>
<!-- register-area start -->
<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <form action="/user/register" method="post">
                            	<label for="inputUsername" >Username</label><span id="user_check"></span>
                                <input type="text" id="inputUsername" name="username" placeholder="Username" required="">
                                <label for="pword">Password</label>
                                <input type="password" id="pword" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required="">
                                <label for="re_pword">Re-type Password</label><span id='message'></span>
                                <input type="password" id="re_pword" placeholder="Re-type password" required="">
                                <label for="inputFullname">Full name</label>
                                <input type="text" id="inputFullname" name="fullname" placeholder="Your fullname" required="">
                                <label for="inputPhone">Phone number</label>
                                <input type="tel" id="inputPhone" pattern="(09|01[2|6|8|9])+([0-9]{8})" name="phone" placeholder="Phone number (example: 01686978822...)" required="">
                                <label for="inputAddress">Address</label>
                                <input type="text" id="inputAddress" name="address" placeholder="Address" required="">
                                <label for="inputCity">City</label>
                                <input type="text" id="inputCity" name="city" placeholder="City" required="">
                                <label for="inputEmail">Email</label>
                                <input name="email" id="inputEmail" placeholder="Email" type="email" required="">
                                <div class="button-box">
                                    <button type="submit" class="default-btn floatright">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- register-area end -->
<?php include "partials/user.footer.php"; ?>