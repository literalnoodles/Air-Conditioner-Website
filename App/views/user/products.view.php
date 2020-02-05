<?php include "partials/user.header.php"; ?>
        <!-- header end -->
		<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url(/storage/background/1.jpg)">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h2> Products</h2>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li> Products</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-page-wrapper shop-page-padding ptb-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="shop-sidebar mr-50">
                            <div class="sidebar-widget mb-50">
                                <h3 class="sidebar-title">Search Products</h3>
                                <div class="sidebar-search">
                                    <form action="/products" method="GET">
                                        <input placeholder="Search Products..." type="text" name="search_term">
                                        <button><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-widget mb-40">
                                <h3 class="sidebar-title">Filter by Price</h3>
                                <div class="price_filter">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <label>price : </label>
                                            <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                        </div>
                                        <button type="button">Filter</button> 
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar-widget mb-45">
                                <h3 class="sidebar-title">Brands</h3>
                                <div class="sidebar-categories">
                                    <ul>
                                        <?php foreach ($brands as $brand): ?>
                                            <li class="filter-brand filter"><a href="#" onclick="return false;"><img style="height: 30px" src="<?= $brand["logo"] ?>"><span></span></a>
                                                <input type="hidden" name="brand_id" value="<?= $brand["brand_id"] ?>">
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="sidebar-widget mb-45">
                                <h3 class="sidebar-title">Categories</h3>
                                <div class="sidebar-categories">
                                    <ul>
                                        <?php foreach ($categories as $category): ?>
                                            <li class="filter-category filter"><a href="#" onclick="return false;"><?= $category["category_name"] ?><span></span></a>
                                                <input type="hidden" name="category_id" value="<?= $category["category_id"] ?>">
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget mb-45">
                                <h3 class="sidebar-title">Features</h3>
                                <div class="sidebar-categories">
                                    <ul>
                                        <?php foreach ($features as $feature): ?>
                                            <li class="filter-feature filter"><a href="#" onclick="return false;"><?= $feature["feature_name"] ?><span></span></a>
                                                <input type="hidden" name="feature_id" value="<?= $feature["feature_id"] ?>">
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="shop-product-wrapper res-xl res-xl-btn">
                            <div class="shop-bar-area">
                                <div class="shop-bar pb-60">
                                    <div class="shop-found-selector">
                                        <div class="shop-found">
                                            <p><span id="count_results"></span> Product Found</p>
                                        </div>
                                        <div class="shop-selector">
                                            <label>Sort By : </label>
                                            <select name="select" id='sort'>
                                                <option value="0">Default</option>
                                                <option value="1">Price Asc</option>
                                                <option value="2">Price Desc</option>
                                                <option value="3">Name</option>
                                                <option value="4">Brand</option>
                                                <option value="5">Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="shop-filter-tab">
                                        <div class="shop-tab nav" role=tablist>
                                            <a class="active" href="#grid-sidebar1" data-toggle="tab" role="tab" aria-selected="false">
                                                <i class="ti-layout-grid4-alt"></i>
                                            </a>
                                            <a href="#grid-sidebar2" data-toggle="tab" role="tab" aria-selected="true">
                                                <i class="ti-menu"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="shop-product-content tab-content">
                                    <div id="grid-sidebar1" class="tab-pane fade active show">
                                        <div class="row" id="grid1">
                                        </div>
                                    </div>
                                    <div id="grid-sidebar2" class="tab-pane fade">
                                        <div class="row" id="grid2">
                                        </div>
                                    </div>
                                    <?php
                                     // include "partials/products.php";  
                                     ?>

                                </div>
                            </div>
                        </div>
                        <ul class="pagination justify-content-center" id="paging">
                        </ul>
                        <?php
                         // include "partials/paging.php"; 
                         ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->
        <div id='products-modals'>
        <?php 
        // include "partials/modal.products.php"; 
        ?>
        </div>
<?php include "partials/user.footer.php"; ?>