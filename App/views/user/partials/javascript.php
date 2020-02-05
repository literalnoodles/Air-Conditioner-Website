<?php include(dirname(__FILE__) . "/custom_javascript/toastr.javascript.php"); ?>
<?php if ($path == '/get_access?action=reg') include(dirname(__FILE__) . '/custom_javascript/register.javascript.php'); ?>
<?php if ($path == '/get_access?action=change_password') include(dirname(__FILE__) . '/custom_javascript/change_password.javascript.php'); ?>
<?php if ($short_path == '/product-details') include(dirname(__FILE__) . '/custom_javascript/product-details.javascript.php'); ?>
<?php if ($short_path == '/products') include(dirname(__FILE__) . '/custom_javascript/products.javascript.php'); ?>
<?php if ($short_path == '/view-cart') include(dirname(__FILE__) . '/custom_javascript/cart.javascript.php'); ?>
<?php if ($short_path == '/checkout') include(dirname(__FILE__) . '/custom_javascript/checkout.javascript.php'); ?>
<?php if ($short_path == '/contact') include(dirname(__FILE__) . '/custom_javascript/contact.javascript.php'); ?>
<?php if ($short_path == '/') include(dirname(__FILE__) . '/custom_javascript/homepage.javascript.php'); ?>
<script>
	$(document).ready(function() {
		show_cart();
		show_compare();
		$('body').on('click', '#delete-item', function() {
			delete_item($(this).data('itemDelete'));
			show_cart();
		});
		$('body').on('click', '.del-compare', function() {
			$id = $(this).data('item');
			data = sessionStorage.getItem('compare');
			compare = JSON.parse(data);
			for (iter in compare) {
				if (compare[iter].product_id == $id) {
					compare.splice(iter, 1);
				}
			}
			sessionStorage.setItem('compare', JSON.stringify(compare));
			show_compare();
		});
	})

	// tooltip
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})

	//cart
	function add_to_cart(product_data) {
		//add product to local storage
		if (product_data.count === 0) {
			$.alert({
				title: 'Notification',
				content: 'Select amount before add to cart !'
			})
			return;
		}
		if (product_data.count == undefined) product_data.count = 1;
		data = localStorage.getItem('cart');
		if (data == undefined) {
			cart = [];
		} else {
			cart = JSON.parse(data);
		}
		var i = 0;
		for (; i < cart.length; i++) {
			if (cart[i].product_id == product_data.product_id) {
				cart[i].count += product_data.count;
				break;
			}
		}
		if (i == cart.length) {
			cart.push(product_data);
		}
		localStorage.setItem('cart', JSON.stringify(cart));
		$.alert({
			title: 'Success',
			content: 'Item successfully added to your cart!',
		});
		// console.log(product_data);
	}

	function add_to_compare(product_id) {
		data = sessionStorage.getItem('compare');
		if (data == null) {
			compare = [];
		} else {
			compare = JSON.parse(data);
		}
		var i = 0;
		if (compare.length > 2) {
			$.alert({
				title: "Sorry :(",
				content: "You can only compare maximum 3 items"
			});
			return;
		}
		for (; i < compare.length; i++) {
			if (compare[i].product_id == product_id) {
				$.alert({
					title: "Sorry :(",
					content: "This product is already in the compare list"
				})
				break;
			}
		}
		if (i == compare.length) {
			//get product information
			$.ajax({
				url: "/user/ajax_process?type=product_info",
				method: "POST",
				data: {
					"product_id": product_id
				},
				success: function(result) {
					var data = JSON.parse(result);
					compare.push(data);
					sessionStorage.setItem('compare', JSON.stringify(compare));
					$.alert({
						title: 'Success',
						content: 'Added product to compare!',
					});
					show_compare();
				}
			});
		}
	}

	function show_compare() {
		generate_comptable();
		data = sessionStorage.getItem('compare');
		if (data == null) {
			compare = [];
		} else {
			compare = JSON.parse(data);
		}
		for (item of compare) {
			release = item.release_date ? (new Date(item.release_date)).getFullYear() : '';
			features = [];
			for (feature of item.features_arr) {
				features.push(`- &nbsp${feature.feature_name}`);
			}
			$('#tblCompare thead tr').append(`
				<th>
					<a class='del-compare' data-item='${item.product_id}' href="#">Remove <span>x</span></a>
					<img style="max-width:180px" src="${item.picture}" alt="">
					<p>${item.product_name} </p>
					<span>$${item.unit_price*(100-item.discount)/100}</span>
				</th>
			`);
			$('#trShortDes').append(`
				<td class="compare-dec compare-common">
					${item.short_description ? item.short_description : '' }
				</td>
			`)
			$('#trBrand').append(`
				<td class="compare-dec compare-common">
					${item.brand_name}
				</td>
			`)
			$('#trCategory').append(`
				<td class="compare-dec compare-common">
					${item.category_name}
				</td>
			`)
			$('#trAvpower').append(`
				<td class="compare-dec compare-common">
					${item.apower_consumption ? item.apower_consumption+' kW/h' : ''}
				</td>
			`)
			$('#trCoolingCap').append(`
				<td class="compare-dec compare-common">
					${item.cooling_capacity ? item.cooling_capacity+' BTU' : ''}
				</td>
			`);
			$('#trCoolingRange').append(`
				<td class="compare-dec compare-common">
					${item.effective_range ? item.effective_range+' m2' : ''}
				</td>
			`);
			$('#tr2ways').append(`
				<td class="compare-dec compare-common">
					${item.n_ways== 1 ? 'No' : 'Yes'}
				</td>
			`);
			$('#trInverter').append(`
				<td class="compare-dec compare-common">
					${item.inverter == 0 ? 'No' : 'Yes'}
				</td>
			`);
			$('#trEnergy').append(`
				<td class="compare-dec compare-common">
					${gen_label(item.energy_label)}
				</td>
			`);
			$('#trReleaseDate').append(`
				<td class="compare-dec compare-common">
					${release}
				</td>
			`);
			$('#trCountry').append(`
				<td class="compare-dec compare-common">
					${item.country_of_origin ? item.country_of_origin : ''}
				</td>
			`);
			$('#trFeatures').append(`
				<td class="compare-dec compare-common">
					${features.join("<br>")}
				</td>
			`);
		}
	}

	function generate_comptable() {
		$('#tblCompare').html(`
			<thead>
				<tr>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr id="trShortDes">
					<td class="compare-title">
						<h4>Description </h4>
					</td>
				</tr>
				<tr id="trBrand">
					<td class="compare-title">
						<h4>Brand </h4>
					</td>
				</tr>
				<tr id="trCategory">
					<td class="compare-title">
						<h4>Category </h4>
					</td>
				</tr>
				<tr id="trAvpower">
					<td class="compare-title">
						<h4>Power Consumption </h4>
					</td>
				</tr>
				<tr id="trCoolingCap">
					<td class="compare-title">
						<h4>Cooling capacity </h4>
					</td>
				</tr>
				<tr id="trCoolingRange">
					<td class="compare-title">
						<h4>Cooling range </h4>
					</td>
				</tr>
				<tr id="tr2ways">
					<td class="compare-title">
						<h4>2-ways ? </h4>
					</td>
				</tr>
				<tr id="trInverter">
					<td class="compare-title">
						<h4>Have inverter ? </h4>
					</td>
				</tr>
				<tr id="trEnergy">
					<td class="compare-title">
						<h4>Energy Label </h4>
					</td>
				</tr>
				<tr id="trReleaseDate">
					<td class="compare-title">
						<h4>Release Date </h4>
					</td>
				</tr>
				<tr id="trCountry">
					<td class="compare-title">
						<h4>Country of origin </h4>
					</td>
				</tr>
				<tr id="trFeatures">
					<td class="compare-title">
						<h4>Features </h4>
					</td>
				</tr>
			</tbody>
		`)
	}

	function show_cart() {
		data = localStorage.getItem('cart');
		if (data == undefined) {
			cart = [];
		} else {
			cart = JSON.parse(data);
		}
		// console.log(cart);
		var count = 0;
		var subtotal = 0;
		for (var i = 0; i < cart.length; count += cart[i].count, subtotal += cart[i].count * (100 - cart[i].discount) / 100 * cart[i].unit_price, i++);
		cart_html = "";
		for (item of cart) {
			cart_html += `
			<li class="single-product-cart">
	            <div class="cart-img">
	                <a href="#" onclick="return false;"><img style="width:85px;" src="${item.picture}" alt=""></a>
	            </div>
	            <div class="cart-title" style="margin-top:5px">
	                <h5><a href="/product-details?product_id=${item.product_id}">${item.product_name}</a></h5>
	                <span>$${item.unit_price*(100-item.discount)/100} x ${item.count}</span>
	            </div>
	            <div class="cart-delete">
	                <a style="margin-top:5px" id="delete-item" data-item-delete='${item.product_id}' href="#" onclick="return false;"><i class="ti-trash"></i></a>
	            </div>
	        </li>
			`
		}
		cart_html += `
		<li class="cart-space">
            <div class="cart-sub">
                <h4>Subtotal</h4>
            </div>
            <div class="cart-price">
                <h4>$${subtotal}</h4>
            </div>
        </li>
        <li class="cart-btn-wrapper">
            <a class="cart-btn btn-hover" href="/view-cart">view cart</a>
            <a class="cart-btn btn-hover" href="/checkout">checkout</a>
        </li>
		`

		$("#cart-count").html(`${count}`);
		$("#cart-details").html(cart_html);
	}

	function delete_item(product_id) {
		data = localStorage.getItem('cart');
		if (data == undefined) {
			cart = [];
		} else {
			cart = JSON.parse(data);
		}
		var i = 0;
		for (; i < cart.length; i++) {
			if (cart[i].product_id == product_id) {
				cart.splice(i, 1);
				break;
			}
		}
		localStorage.setItem('cart', JSON.stringify(cart));
		$.alert({
			title: 'Success',
			content: 'Item successfully removed from your cart!',
			animateFromElement: false,
			typeAnimated: false
		});
	}

	function change_amount_item(product_id, new_amount) {
		data = localStorage.getItem('cart');
		if (data == undefined) {
			cart = [];
		} else {
			cart = JSON.parse(data);
		}
		var i = 0;
		for (; i < cart.length; i++) {
			if (cart[i].product_id == product_id) {
				cart[i].count = new_amount;
				break;
			}
		}
		localStorage.setItem('cart', JSON.stringify(cart));
	}

	function cart_button(status, unit_in_stock, item) {
		switch (status) {
			case 1:
				return `<button type="button" onclick="this.blur();" class="btn btn-outline-secondary btn-cart mb-30 disabled">Coming soon</button>`;
			case 2:
				if (unit_in_stock > 0) {
					return `<button type="button" onclick="this.blur();" class="btn btn-secondary btn-cart mb-30" data-product='{
	                	"product_id":"${item['product_id']}",
	                	"product_name":"${item['product_name']}",
	                	"unit_price":"${item['unit_price']}",
	                	"discount":"${item['discount']}",
	                	"picture":"${item['picture']}"
	                	}'>Add to cart</button>`;
				} else {
					return `<button type="button" onclick="this.blur();" class="btn btn-outline-secondary btn-cart mb-30 disabled">Out of stock</button>`;
				}
				case 3:
					return `<button type="button" onclick="this.blur();" class="btn btn-outline-danger btn-cart mb-30 disabled">Discontinued</button>`
		}
	}

	function gen_label(label) {
		html = '';
		var i = 0;
		for (; i < label; i++) {
			html += "<i class='fas fa-star'></i>"
		};
		for (i = label; i < 5; i++) {
			html += "<i class='far fa-star'></i>";
		}
		return html;
	}

	function cut_text(text) {
		if (text != null && text.length > 70) {
			pos = text.indexOf(" ", 70);
			return `${text.substr(0, pos)}<span style='display:none' class='t-hide'>${text.substr(pos)}</span><a style='color:black' href="#" onclick='return false;' class='dot'> (See more...)</a>`
		}
		return text;
	}


</script>