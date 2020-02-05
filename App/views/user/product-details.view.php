<?php include "partials/user.header.php"; ?>
<?php
 // high_light($product_details); 
 ?>
	<div class="breadcrumb-area pt-205 pb-210" style="background-image: url(storage/background/4.jpg)">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Product details</h2>
                <ul>
                    <li><a href="/">home</a></li>
                    <li> Product details </li>
                </ul>
            </div>
        </div>
    </div>
	<div class="product-details ptb-100 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-7 col-12">
                    <div class="product-details-img-content">
                        <div class="product-details-tab mr-70">
                            <div class="product-details-large tab-content">
                                <div class="tab-pane active show fade" id="pro-details1" role="tabpanel">
                                    <div class="easyzoom easyzoom--overlay">
                                        <a href="<?= $product_details['picture'] ?>">
                                            <img src="<?= $product_details['picture'] ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5 col-12">
                    <div class="product-details-content">
                        <h3><?= $product_details['product_name'] ?></h3>
                        <?php if($product_details['energy_label']): ?>
	                        <div class="rating-number">
	                            <div class="quick-view-rating">
	                            	<?php for($i = 0;$i < $product_details['energy_label'];$i++): ?>
	                            		<i class="fas fa-star"></i>
	                            	<?php endfor; ?>
	                            	<?php for($i = $product_details['energy_label'];$i < 5;$i++): ?>
	                            		<i class="far fa-star"></i>
	                            	<?php endfor; ?>
	                            </div>
	                            <div class="quick-view-number">
	                                <span><?= $product_details['energy_label'] ?> Star(s)</span>
	                            </div>
	                        </div>
	                    <?php endif; ?>
                        <div class="details-price">
	        				<?php if (!$product_details['discount']): ?>
                            	<span>$<?= $product_details["unit_price"] ?></span>
                           	<?php else: ?>
                           		<span>$<?= $product_details["unit_price"]*(100-$product_details["discount"])/100 ?></span><strike>&nbsp$<?= $product_details["unit_price"] ?></strike>
                           	<?php endif; ?>
                        </div>
                        <p><?php $product_details['short_description'] ?></p>
                     
                        <div class="quickview-plus-minus">
                            <div class="cart-plus-minus">
                                <input type="text" id='product-amount' value="1" name="qtybutton" class="cart-plus-minus-box">
                            </div>
                            	<button type="button" id='btn-cart' onclick="this.blur();" class="btn btn-primary" style="margin-left:10px;margin-right: 10px;height:auto">Add to cart</button>
                            	<a role="button" href="<?php $product_details["document"] ? $product_details["document"]: '' ?>" class="btn btn-secondary" style="height: auto;padding: .375rem .75rem">Document</a>
                        </div>

                        <div class="product-details-cati-tag mt-35">
                            <ul>
                                <li class="categories-title">Brand :</li>
                                <li><a href="/products?brand_id=<?= $product_details['brand_id'] ?>"><?= $product_details['brand_name'] ?></a></li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Category :</li>
                                <li><a href="/products?category_id=<?= $product_details['category_id'] ?>"><?= $product_details['category_name'] ?></a></li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Features :</li>
                                <?php foreach($product_details['features_arr'] as $feature): ?>
                                	<li><a href="#" data-toggle="tooltip" data-placement="top" title="<?= $feature['description'] ?>" onclick="return false;"><?= $feature['feature_name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Status :</li>
                                <li>
    								<?= ($product_details['status'] == 1) ? 'Coming soon' : ($product_details['status'] == 2) ? 'Ready' : 'Discontinued'?>
    							</li>
                            </ul>
                        </div>
                        <div class="product-details-cati-tag mtb-10">
                            <ul>
                                <li class="categories-title">Unit in stock :</li>
                                <li>
    								<?= $product_details['unit_in_stock']?> unit(s)
    							</li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#specs">
                        	Technical Specifications
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if($product_details['description']): ?>
<div class='container'>
	<div class="product-description-review">
		<div class="description-review-title">
			<h3>Description</h3>
		</div>
		<div class="description-review-text">
			<p>
				<?= $product_details['description'] ?>	
			</p>
		</div>
	</div>
</div>
<?php endif; ?>
    <!-- Modal -->
    <div class="modal fade" id="specs" tabindex="-1" role="dialog" aria-labelledby="modal_specs" aria-hidden="true">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title" id="modal_specs">Technical Specifications</h5>
    				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
    				</button>
    			</div>
    			<div class="modal-body">
    				<table class="table">
    					<thead>
    						<tr>
    							<th>Feature</th>
    							<th>Specs</th>
    						</tr>
    					</thead>
    					<tbody>
    						<tr>
    							<th scope="row">Brand</th>
    							<td><?= $product_details["brand_name"] ?></td>
    						</tr>
    						<tr>
    							<th scope="row">Category</th>
    							<td><?=$product_details["category_name"]  ?></td>
    						</tr>
    						<tr>
    							<th scope="row">Power Consumption</th>
    							<td><?=$product_details["apower_consumption"] ? $product_details["apower_consumption"] : '' ?> kW/h</td>
    						</tr>
    						<tr>
    							<th scope="row">Cooling capacity</th>
    							<td><?=$product_details["cooling_capacity"] ? $product_details["cooling_capacity"] :''?> BTU</td>
    						</tr>
    						<tr>
    							<th scope="row">Have inverter ?</th>
    							<td><?=$product_details['inverter'] ? 'Yes' : 'No'  ?></td>
    						</tr>
    						<tr>
    							<th scope="row">2 ways conditioner ?</th>
    							<td><?=$product_details['n_ways']==2 ? '2 ways' : '1 way'  ?></td>
    						</tr>

    						<tr>
    							<th scope="row">Warranty</th>
    							<td><?=$product_details['warranty_period'] ? $product_details['warranty_period']: ''?> months</td>
    						</tr>
    						<tr>
    							<th scope="row">Country of origin</th>
    							<td><?=$product_details['country_of_origin'] ? $product_details['country_of_origin'] : '' ?></td>
    						</tr>
    						<tr>
    							<th scope="row">Status</th>
    							<td>
    								<?= ($product_details['status'] == 1) ? 'Coming soon' : ($product_details['status'] == 2) ? 'Ready' : 'Discontinued'?> 
    							</td>
    						</tr>
    					</tbody>
    				</table>
    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
    			</div>
    		</div>
    	</div>
    </div>
<?php include "partials/user.footer.php"; ?>
