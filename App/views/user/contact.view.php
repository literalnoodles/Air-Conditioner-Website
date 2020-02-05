<?php
include 'partials/user.header.php';
?>
<!-- header end -->
<div class="breadcrumb-area pt-205 pb-210" style="background-image: url(storage/background/6.jpg)">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>contact us</h2>
            <ul>
                <li><a href="#">home</a></li>
                <li> contact us</li>
            </ul>
        </div>
    </div>
</div>
<!-- shopping-cart-area start -->
<div class="contact-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-map-wrapper">
                    <div class="contact-map mb-40">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d930.9830048978598!2d105.81828762923998!3d21.035405899124704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0d146d4fc3%3A0x976049bed4c023db!2zMjIwLTI5MiDEkOG7mWkgQ-G6pW4sIExp4buFdSBHaWFpLCBCYSDEkMOsbmgsIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1579600033001!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        <!-- <div id="hastech2"></div> -->
                    </div>
                    <div class="contact-message">
                        <div class="contact-title">
                            <h4>Contact Information</h4>
                        </div>
                        <form id="contact-form" class="contact-form" action="/send-email" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="contact-input-style mb-30">
                                        <label>Name*</label>
                                        <input name="name" required="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-input-style mb-30">
                                        <label>Email*</label>
                                        <input name="email" required="" type="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-input-style mb-30">
                                        <label>Telephone</label>
                                        <input name="telephone" required="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="contact-input-style mb-30">
                                        <label>subject</label>
                                        <input name="subject" required="" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="contact-textarea-style mb-30">
                                        <label>Comment*</label>
                                        <textarea class="form-control2" name="message" required=""></textarea>
                                    </div>
                                    <button id='btnSubmit' class="submit contact-btn btn-hover" type="button">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info-wrapper">
                    <div class="contact-title">
                        <h4>Location & Details</h4>
                    </div>
                    <div class="contact-info">
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Address:</span> 266 Doi Can, Ba Dinh <br> Hanoi</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-mail"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Email: </span> Support@cosyairconditioner.com</p>
                            </div>
                        </div>
                        <div class="single-contact-info">
                            <div class="contact-info-icon">
                                <i class="pe-7s-call"></i>
                            </div>
                            <div class="contact-info-text">
                                <p><span>Phone: </span> (1800) 100 456 789</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->

<?php
include 'partials/user.footer.php';
?>