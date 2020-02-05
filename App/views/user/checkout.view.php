<?php
    if (isset($user_info)){
        extract($user_info);
    }
?>
<?php include "partials/user.header.php"; ?>
		<div class="breadcrumb-area pt-205 pb-210" style="background-image: url(storage/background/8.jpg)">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <h2>checkout</h2>
                    <ul>
                        <li><a href="#">home</a></li>
                        <li> checkout </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- checkout-area start -->
            <div class="checkout-area ptb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="coupon-accordion">
                                <?php if (!isset($_SESSION['user'])): ?>
                                <h3>Returning customer? <a href="/get_access?action=login">Click here to login</a></h3>
                                <?php endif; ?>	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <!-- <form id="order-form" action="/request-order" method="POST"> -->
                                <div class="checkbox-form">						
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Full Name <span class="required">*</span></label>										
                                                <input type="text" name="fullname" placeholder="" value="<?= isset($fullname) ? $fullname : '' ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label for='inputAddress'>Address <span class="required">*</span></label>
                                                <input type="text" name="address" id='inputAddress' placeholder="Street address" value="<?= isset($address) ? $address : '' ?>" required />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label for="inputCity">Town / City <span class="required">*</span></label>
                                                <input type="text" name="city" id='inputCity' value="<?= isset($city) ? $city : '' ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="inputPhone">Phone  <span class="required">*</span></label>
                                                <input type="text" id="inputPhone" pattern="(09|01[2|6|8|9])+([0-9]{8})" name="phone" placeholder="(example: 01686978822...)" required="" value="<?= isset($phone) ? $phone : '' ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="inputEmail">Email</label>                                       
                                                <input type="email" name="email" id='inputEmail' value="<?= isset($email) ? $email : '' ?>"/>
                                            </div>
                                        </div>					
                                    </div>
                                    <div class="different-address">
                                        <div class="order-notes">
                                            <div class="checkout-form-list mrg-nn">
                                                <label>Order Notes</label>
                                                <textarea id="checkout-mess" name='note' cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery." ></textarea>
                                            </div>			
                                        </div>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>	
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table id='tbl-orders'>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>							
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>						
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div class="order-button-payment">
                                            <input id='btn-submit' type="submit" value="Place order" />
                                        </div>								
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- checkout-area end -->	
<?php include "partials/user.footer.php"; ?>
