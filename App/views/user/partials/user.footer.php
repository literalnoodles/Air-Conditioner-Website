<!-- services area start -->
<div class="services-area wrapper-padding-4 gray-bg pt-60 pb-60">
    <div class="container-fluid">
        <div class="services-wrapper">
            <div class="single-services mb-40">
                <div class="services-img">
                    <img src="/plugins/ezone/img/icon-img/26.png" alt="">
                </div>
                <div class="services-content">
                    <h4>Free Shipping</h4>
                    <p>Contrary to popular belief, Lorem Ipsum is random text. </p>
                </div>
            </div>
            <div class="single-services mb-40">
                <div class="services-img">
                    <img src="/plugins/ezone/img/icon-img/27.png" alt="">
                </div>
                <div class="services-content">
                    <h4>24/7 Support</h4>
                    <p>Contrary to popular belief, Lorem Ipsum is random text. </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- services area end -->
<!-- footer area start -->
<footer class="footer-area">
            <div class="footer-top-area bg-img pt-80 pb-50" style="background-image: url(assets/img/bg/1.jpg)" data-overlay="9">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-3">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title"><a href="#"><img src="/plugins/ezone/img/logo/test1.png" height="45px" alt=""></a></h3>
                                <div class="footer-newsletter">
                                    <p>We provide you large variety of air conditioners. <br>Cosy employ our own installation teams who only work for Cosy</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-3">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Brands</h3>
                                <div class="footer-widget-content">
                                    <ul>
                                       <?php foreach($brands as $brand): ?>
                                        <li><a href="/products?brand_id=<?= $brand["brand_id"]; ?>"><?= $brand["brand_name"] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="footer-widget mb-40">
                                <h3 class="footer-widget-title">Contact</h3>
                                <div class="footer-newsletter">
                                    <div class="footer-contact">
                                        <p><span><i class="ti-location-pin"></i></span> 266 Doi Can, Ba Dinh, Ha Noi </p>
                                        <p><span><i class=" ti-headphone-alt "></i></span> +88 (015) 609735 or +88 (012) 112266</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom black-bg ptb-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="copyright">
                                <p>
                                    Copyright ©
                                    <a href="https://hastech.company/">Cosy Airconditioner</a> 2020 . All Right Reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- modal -->
		<!-- all js here -->
        <script src="/plugins/ezone/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="/plugins/ezone/js/popper.js"></script>
        <script src="/plugins/ezone/js/bootstrap.min.js"></script>
        <script src="/plugins/ezone/js/jquery.magnific-popup.min.js"></script>
        <script src="/plugins/ezone/js/isotope.pkgd.min.js"></script>
        <script src="/plugins/ezone/js/imagesloaded.pkgd.min.js"></script>
        <script src="/plugins/ezone/js/jquery.counterup.min.js"></script>
        <script src="/plugins/ezone/js/waypoints.min.js"></script>
        <script src="/plugins/ezone/js/ajax-mail.js"></script>
        <script src="/plugins/ezone/js/owl.carousel.min.js"></script>
        <script src="/plugins/ezone/js/plugins.js"></script>
        <script src="/plugins/ezone/js/main.js"></script>
        <script src="/plugins/jquery-confirm/jquery-confirm.min.js"></script>
        <?php include "javascript.php"; ?>
    </body>
</html>