<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cosy | Air conditioner</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/plugins/ezone/img/favicon.png">

    <!-- all css here -->

    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/ezone/css/magnific-popup.css">
    <link rel="stylesheet" href="/plugins/ezone/css/animate.css">
    <link rel="stylesheet" href="/plugins/ezone/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/plugins/ezone/css/themify-icons.css">
    <link rel="stylesheet" href="/plugins/ezone/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/plugins/ezone/css/icofont.css">
    <link rel="stylesheet" href="/plugins/ezone/css/meanmenu.min.css">
    <link rel="stylesheet" href="/plugins/ezone/css/easyzoom.css">
    <link rel="stylesheet" href="/plugins/ezone/css/bundle.css">
    <link rel="stylesheet" href="/plugins/ezone/css/jquery-ui.css">
    <link rel="stylesheet" href="/plugins/ezone/css/style.css">
    <link rel="stylesheet" href="/plugins/ezone/css/responsive.css">
    <link rel="stylesheet" href="/plugins/toastr/toastr.css">
    <link rel="stylesheet" href="/plugins/ezone/css/custom.css">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/plugins/jquery-confirm/jquery-confirm.min.css">
    <script src="/plugins/ezone/js/vendor/modernizr-2.8.3.min.js"></script>

    <style>
        /* header {
                background-image: url("/storage/background/test.jpg");
            } */
        body {
            background-image: url("plugins/ezone/img/bg/7.jpg");
        }

        .owl-carousel .owl-stage {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- header start -->
    <header>
        <div class="header-top-furniture wrapper-padding-2 res-header-sm">
            <div class="container-fluid">
                <div class="header-bottom-wrapper">
                    <div class="logo-2 furniture-logo ptb-30">
                        <a href="/">
                            <img src="/plugins/ezone/img/logo/test.png" height="45px" alt="">
                        </a>
                    </div>
                    <div class="menu-style-2 furniture-menu menu-hover">
                        <!-- nav bar-->
                        <nav>
                            <ul>
                                <li><a href="/">home</a>
                                </li>
                                <li><a href="/products">Brands</a>
                                    <ul class="single-dropdown">
                                        <?php foreach ($brands as $brand) : ?>
                                            <li><a href="/products?brand_id=<?= $brand["brand_id"]; ?>"><?= $brand["brand_name"] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="/products">Categories</a>
                                    <ul class="single-dropdown">
                                        <?php foreach ($categories as $category) : ?>
                                            <li><a href="/products?category_id=<?= $category["category_id"]; ?>"><?= $category["category_name"] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="/about-us">About us</a></li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </nav>
                        <!-- end nav bar-->
                    </div>
                    <!-- cart-->
                    <?php include "user.cart.php" ?>
                </div>
            </div>
        </div>
        <div class="header-bottom-furniture wrapper-padding-2 border-top-3">
            <div class="container-fluid">
                <div class="furniture-bottom-wrapper">
                    <div class="furniture-login">
                        <ul>
                            <?php if (!isset($_SESSION["user"])) : ?>
                                <li>Get Access: <a href="get_access?action=login">Login</a></li>
                                <li><a href="get_access?action=reg">Reg </a></li>
                            <?php else : ?>
                                <li>Hello <?= $_SESSION["username"]; ?>!</li>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown">Setting</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" style="font-weight: normal;font-size:14px" href="/get_access?action=change_password">Change password</a>
                                        <a class="dropdown-item" style="font-weight: normal;font-size:14px" href="/get_access?action=logout">Logout</a>
                                        <a class="dropdown-item" style="font-weight: normal;font-size:14px" href="/get_access?action=order-history">Order history</a>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="furniture-search">
                        <form action="/products">
                            <input placeholder="I am Searching for . . ." type="text" name='search_term'>
                            <button>
                                <i class="ti-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="furniture-wishlist">
                        <ul>
                            <li><a data-toggle="modal" data-target="#compareProduct" href="#"><i class="ti-reload"></i> Compare</a></li>
                            <!-- <li><a href="wishlist.html"><i class="ti-heart"></i> Wishlist</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
          include "compare.modal.php";
        ?>
    </header>