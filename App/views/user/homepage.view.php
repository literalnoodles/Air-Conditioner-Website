<?php
include "partials/user.header.php"; 
?>
<!-- header end -->
<div class="slider-area">
    <div class="slider-active owl-carousel">
        <?php foreach ($slides as $slide) : ?>
            <div class="single-slider-4 slider-height-6 bg-img" style="background-image: url(<?= $slide['path']; ?>)">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto col-lg-6">
                            <div class="furniture-content fadeinup-animated">
                                <h2 class="animated">Welcome <br> to Cosy</h2>
                                <p class="animated">COOL YOUR SPACE WITH INNOVATIVE AIR CONDITIONERS</p>
                                <a class="furniture-slider-btn btn-hover animated" href="/products">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- product area start -->
<div class="popular-product-area wrapper-padding-3 pt-100 pb-100">
    <div class="container-fluid">
        <div class="section-title-6 text-center mb-50">
            <h2>Popular Product</h2>
            <p>Here you can purchase different kinds of brands of air conditioners with suitable prices</p>
        </div>
        <div class="product-style">
            <div class="popular-product-active owl-carousel">
                <?php foreach ($sample_arr as $sample) : ?>
                    <div class="product-wrapper">
                        <div class="product-img">
                            <a href="product-details?product_id=<?= $sample['product_id'] ?>">
                                <img src="<?= $sample["picture"] ?>" alt="">
                            </a>
                        </div>
                        <div class="funiture-product-content text-center">
                            <h4><a href="product-details.html"><?= $sample["product_name"] ?></a></h4>
                            <span>$<?= $sample["unit_price"] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- product area end -->
<!-- product area start -->
<div class="product-style-area ">
    <div class="coustom-container-fluid">
        <div class="section-title-7 text-center">
            <h2>All Products</h2>
            <p>We provide you large variety of air conditioners.Cosy employ our own installation teams who only work for Cosy. We buy direct from the manufacturer. We quote, We install, We guarantee it!</p>
        </div>
        <div class="product-tab-list text-center mb-65 nav" role="tablist">
            <?php foreach ($categories as $category) : ?>
                <a href="#cate<?= $category['category_id'] ?>" data-toggle="tab" role="tab">
                    <h4><?= $category['category_name'] ?></h4>
                </a>
            <?php endforeach ?>
        </div>
        <div class="tab-content">
            <?php foreach ($categories_sample as $category) : ?>
                <div class="tab-pane fade" id="cate<?= $category['category_id'] ?>" role="tabpanel">
                    <div class="coustom-row-5">
                        <?php foreach ($category['sample'] as $sample) : ?>
                            <div class="custom-col-three-5 custom-col-style-5 mb-65">
                                <div class="product-wrapper">
                                    <div class="product-img">
                                        <a href="product-details?product_id=<?= $sample['product_id'] ?>">
                                            <img src="<?= $sample['picture'] ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="funiture-product-content text-center">
                                        <h4><a href="product-details.html"><?= $sample['product_name'] ?></a></h4>
                                        <span>$<?= $sample['unit_price'] ?></span>

                                        <div class="product-rating-5">
                                            <?php for ($i = 0; $i < $sample['energy_label']; $i++) : ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>
                                            <?php for ($i = $sample['energy_label']; $i < 5; $i++) : ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="view-all-product text-center mb-50">
            <a href="/products">View All Product</a>
        </div>
    </div>
</div>
<!-- product area end -->
<div class="section-title-7 text-center">
    <h2>All Brands</h2>
    <p>Here you can purchase different kinds of brands of air conditioners with suitable prices. </p>
</div>
<div class="brand-logo-area-2 wrapper-padding ptb-80">
    <div class="container-fluid">
        <div class="brand-logo-active2 owl-carousel">
            <?php foreach($brands as $brand): ?>
                <div class="single-brand pl-30 pr-30">
                    <img src="<?= $brand["logo"]; ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include "partials/user.footer.php"; ?>