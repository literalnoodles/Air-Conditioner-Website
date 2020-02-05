<script>
	$(document).ready(function() {
		// page_count=7;
		// setup_paging(page_count);
		update_products();
		$(".filter").click(function() {
			filter_elem = $(this);
			input = filter_elem.find('input');
			check_box = $(this).find('span');
			if (filter_elem.hasClass('active')) {
				filter_elem.removeClass('active');
				$(check_box).html("<i class='far fa-square'></i>");
				// remove filter from session
				$.ajax({
					url: "/update-filter?action=remove",
					method: "POST",
					data: {
						key: input.attr('name'),
						value: input.val()
					},
					success: function(result) {
						update_products();
						// console.log(result);
					}
				});
			} else {
				filter_elem.addClass('active');
				$(check_box).html("<i class='far fa-check-square'></i>");
				//add filter to session
				$.ajax({
					url: "/update-filter?action=add",
					method: "POST",
					data: {
						key: input.attr('name'),
						value: input.val()
					},
					success: function(result) {
						update_products();
						// console.log(result);
					}
				});
			}

		})

		$('#slider-range').on("slidechange", function(event, ui) {
			// price_low = ui['values'][0];
			// price_high = ui['values'][1];
			$.ajax({
				url: "/update-filter?action=change",
				method: "POST",
				data: {
					key: 'price_filter',
					value: JSON.stringify(ui['values'])
				},
				success: function(result) {
					update_products();
					// console.log(result);
				}
			});
		});

		$('#sort').on('change', function() {
			$.ajax({
				url: "/update-filter?action=change",
				method: "POST",
				data: {
					key: 'sort',
					value: $("#sort").val()
				},
				success: function(result) {
					update_products();
					// console.log(result);
				}
			});
		});

		$('body').on('click', '.btn-cart:not(.disabled)', function() {
			add_to_cart($(this).data('product'));
			show_cart();
		});

		$('body').on('click','.compare',function(){
			add_to_compare($(this).data('pid'));
		})

		update_filter();
		update_filter_box();

		$("body").on('click','.dot',function(){
			dots = $(this);
			hide = dots.prev('.t-hide');
			if (dots.html()==" (See more...)"){
				dots.prev('.t-hide').show();
				dots.html(' (See less...)');
			}else{
				dots.prev('.t-hide').hide();
				dots.html(' (See more...)');
			}
			
		})
	});


	function update_products(page = 1) {
		$.ajax({
			url: "/update-products",
			method: "POST",
			data: {
				page
			},
			success: function(result) {
				var data = JSON.parse(result);
				$("#count_results").html(data['results_number'] ? data['results_number'] : '0');
				setup_paging(data['results_number']);
				setup_grid(data['products_details']);
				setup_modal(data['products_details']);
			}
		});
	}

	function update_filter() {
		var filter = <?= json_encode($_SESSION['filter']) ?>;
		for (filter_key in filter) {
			for (id of filter[filter_key]) {
				$(`[name=${filter_key}][value='${id}']`).closest('li').addClass('active');
			}
		}
	}

	function update_filter_box() {
		$(".filter span").html("<i class='far fa-square'></i>");
		$(".filter.active span").html("<i class='far fa-check-square'></i>");
	}

	function setup_paging(results_number) {
		page_size = 12;
		page_count = Math.ceil(results_number / page_size);
		$("#paging").html("");
		var paging_html = `
			<li class="page-item disabled" data-page='prev'>
				<a class="page-link" href="#" onclick="this.blur();return false;"><i class="fas fa-chevron-left"></i></a>
			</li>
		`;
		if (page_count <= 6) {
			for (var i = 1; i <= page_count; i++) {
				paging_html += `
					<li class="page-item" data-page='${i}'>
						<a class="page-link" href="#" onclick="this.blur();return false;">${i}</a>
					</li>
				`;
			};
		} else {
			for (var i = 1; i <= 5; i++) {
				paging_html += `
					<li class="page-item" data-page='${i}'>
						<a class="page-link" href="#" onclick="this.blur();return false;">${i}</a>
					</li>
				`;
			};
			paging_html += `
				<li class="page-item disabled">
					<a class="page-link" href="#" onclick="this.blur();return false;">...</a>
				</li>
				<li class="page-item" data-page='${page_count}'>
					<a class="page-link" href="#" onclick="this.blur();return false;">${page_count}</a>
				</li>

			`;
		}
		paging_html += `
			<li class="page-item ${page_count<=1 ? "disabled" : "" }" data-page='next'>
				<a class="page-link" href="#" onclick="this.blur();return false;"><i class="fas fa-chevron-right"></i></a>
			</li>
		`;
		$("#paging").html(paging_html);

		$("#paging li").filter(function() {
			return $(this).data('page') == '1';
		}).addClass("active");

		$("#paging").off('click').on("click", "li:not(.disabled)", function() {
			// var text = $(this).text().trim();
			var data_page = $(this).data('page');
			var active_page = parseInt($("#paging li.active").data('page'));
			var c_page;
			// if (text=="Previous"){
			// 	c_page = active_page-1;
			// }else if (text=="Next"){
			// 	c_page = active_page+1;
			// }else{
			// 	c_page = parseInt(text);
			// }
			if (data_page == "prev") {
				c_page = active_page - 1;
			} else if (data_page == "next") {
				c_page = active_page + 1;
			} else {
				c_page = parseInt(data_page);
			}
			update_paging(c_page, page_count);
			// update_products(c_page);
			$.ajax({
				url: "/update-products",
				method: "POST",
				data: {
					page: c_page
				},
				success: function(result) {
					var data = JSON.parse(result);
					setup_grid(data['products_details']);
					setup_modal(data['products_details']);
				}
			});


			// $("#grid-sidebar1").html("");
		});
	}

	function update_paging(c_page, page_count) {
		//showing the first page
		var paging_html = `
			<li class="page-item ${c_page==1 ? 'disabled' : ''}" data-page='prev'>
				<a class="page-link" href="#" href="#" onclick="this.blur();return false;"><i class="fas fa-chevron-left"></i></a>
			</li>
			<li class="page-item" data-page='1'>
				<a class="page-link" href="#" href="#" onclick="this.blur();return false;">1</a>
			</li>
		`;
		if (c_page <= 4) {
			for (var i = 2; i <= c_page; i++) {
				paging_html += `
					<li class="page-item" data-page='${i}'>
						<a class="page-link" href="#" onclick="this.blur();return false;">${i}</a>
					</li>
				`;
			};
		} else {
			paging_html += `
				<li class="page-item disabled">
					<a class="page-link" href="#" onclick="this.blur();return false;">...</a>
				</li>
			`;
			for (var i = c_page - 2; i <= c_page; i++) {
				paging_html += `
					<li class="page-item" data-page='${i}'>
						<a class="page-link" href="#" onclick="this.blur();return false;">${i}</a>
					</li>
				`;
			};
		}
		if (c_page >= page_count - 3) {
			for (var i = c_page + 1; i <= page_count; i++) {
				paging_html += `
					<li class="page-item" data-page='${i}'>
						<a class="page-link" href="#" onclick="this.blur();return false;">${i}</a>
					</li>
				`;
			};
		} else {
			for (var i = c_page + 1; i <= c_page + 2; i++) {
				paging_html += `
					<li class="page-item" data-page='${i}'>
						<a class="page-link" href="#" onclick="this.blur();return false;">${i}</a>
					</li>
				`;
			};
			paging_html += `
				<li class="page-item disabled">
					<a class="page-link" href="#" onclick="this.blur();return false;">...</a>
				</li>
				<li class="page-item" data-page='${page_count}'>
					<a class="page-link" href="#" onclick="this.blur();return false;">${page_count}</a>
				</li>
			`;
		}
		// showing the last page
		paging_html += `
			<li class="page-item ${c_page==page_count ? 'disabled' : ''}" data-page='next'>
				<a class="page-link" href="#" onclick="this.blur();return false;"><i class="fas fa-chevron-right"></i></a>
			</li>
		`;
		$("#paging").html(paging_html);
		$("#paging li").filter(function() {
			return $(this).data('page') == `${c_page}`;
		}).addClass("active");
	}

	function setup_grid(data) {
		grid1_html = '';
		grid2_html = '';

		for (item of data) {
			grid1_html += `
				<div class="col-lg-6 col-md-6 col-xl-3 text-center">
				    <div class="product-wrapper mb-10">
				        <div class="product-img">
				            <a href="/product-details?product_id=${item['product_id']}">
				                <img src="${item['picture']== null ? '' : item['picture']}" alt="">
				            </a>
				            <div class="product-action">
								<a class="animate-top compare" onclick="return false;" title="Compare" data-pid="${item['product_id']}" href="#">
									<i class="pe-7s-ticket"></i>
				                </a>
				                <a class="animate-top" title="Quick View" onclick="return false;" data-toggle="modal" data-target="#modal${item['product_id']}" href="#">
				                    <i class="pe-7s-look"></i>
				                </a>
				            </div>
				        </div>
				        <div class="product-content">
				            <h4 class="text-truncate"><a href="/product-details?product_id=${item['product_id']}">${item['product_name']}</a></h4>`
			if (!item['discount']) {
				grid1_html += `<span>$${item["unit_price"]}</span>`;
			} else {
				grid1_html += `<span>$${item["unit_price"]*(100-item["discount"])/100}</span>
            		&nbsp<strike>$${item["unit_price"]}</strike>`;
			}
			grid1_html += `
				        </div>
						${cart_button(item['status'],item['unit_in_stock'],item)}
				    </div>
				    	
				</div>
			`
		}

		for (item of data) {
			grid2_html += `
				<div class="col-lg-12 col-xl-6">
	                <div class="product-wrapper mb-30 single-product-list product-list-right-pr mb-60">
	                    <div class="product-img list-img-width">
	                        <a href="/product-details?product_id=${item['product_id']}">
	                            <img src="${item['picture']== null ? '' : item['picture']}" alt="">
	                        </a>
	                        <div class="product-action-list-style">
								<a class="animate-top compare" onclick="return false;" title="Compare" data-pid="${item['product_id']}" href="#">
									<i class="pe-7s-ticket"></i>
				                </a>
	                            <a class="animate-top" title="Quick View" onclick="return false;" data-toggle="modal" data-target="#modal${item["product_id"]}" href="#">
	                                <i class="pe-7s-look"></i>
	                            </a>
	                        </div>
	                    </div>
	                	<div class="product-content-list">
	                    	<div class="product-list-info">
	                        	<h4 class="d-inline-block text-truncate" style="max-width: 250px;"><a href="/product-details?product_id=${item['product_id']}">${item["product_name"]}</a></h4>`;
			if (!item['discount']) {
				grid2_html += `<span>$${item["unit_price"]}</span>`;
			} else {
				grid2_html += `<span>$${item["unit_price"]*(100-item["discount"])/100}<strike style='font-weight:normal;'>&nbsp$${item["unit_price"]}</strike></span>`;
			}
			grid2_html += `<p>${cut_text(item["short_description"])} </p>
	                    	</div>
	                		<div class="product-list-cart-wishlist">
	                		${cart_button(item['status'],item['unit_in_stock'],item)}

                    		</div>
                		</div>
	            	</div>
	        	</div>`
		}

		$("#grid1").html(grid1_html);
		$("#grid2").html(grid2_html);
	}

	function setup_modal(data) {
		modal_data = "";

		for (item of data) {
			modal_data +=
				`
			<div class="modal fade" id="modal${item["product_id"]}" tabindex="-1" role="dialog" aria-hidden="true">
		      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span class="pe-7s-close" aria-hidden="true"></span>
		      	</button>
		      	<div class="modal-dialog modal-quickview-width" role="document">
		        	<div class="modal-content">
		              	<div class="modal-body">
		                  	<div class="qwick-view-left">
		                      	<div class="quick-view-learg-img">
		                          	<div class="quick-view-tab-content tab-content">
		                              <div class="tab-pane active show fade" id="modal1" role="tabpanel">
		                                  	<img src="${item['picture']== null ? '' : item['picture']}" alt="">
		                              	</div>
		                         	</div>
		                      	</div>
		                  	</div>
		                  	<div class="qwick-view-right">
		                    	<div class="qwick-view-content">
		                          	<h3>${item["product_name"]}</h3>
		                          	<div class="price">
		    `
			if (item['discount']) {
				modal_data +=
					`
			    	<span class="new">$${item["unit_price"]*(100-item["discount"])/100}</span>
			        <span class="old">$${item["unit_price"]}</span>
			    `
			} else {
				modal_data +=
					`
    				<span class="new">$${item["unit_price"]}</span>
    			`
			}
			modal_data +=
				`
              	</div>
              
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
                        	<td>${item["brand_name"]}</td>
                    	</tr>
                    	<tr>
                        	<th scope="row">Category</th>
                        	<td>${item["category_name"]}</td>
                    	</tr>
                      	<tr>
                        	<th scope="row">Power Consumption</th>
                        	<td>${item["apower_consumption"] ? item["apower_consumption"] : ''} kW/h</td>
                    	</tr>
                    	<tr>
                        	<th scope="row">Cooling capacity</th>
                        	<td>${item["cooling_capacity"] ? item["cooling_capacity"] :''} BTU</td>
                    	</tr>
                        <tr>
                            <th scope="row">Have inverter ?</th>
                            <td>${item['inverter'] ? 'Yes' : 'No'}</td>
                        </tr>
                        <tr>
                            <th scope="row">2 ways conditioner ?</th>
                            <td>${item['n_ways']==2 ? '2 ways' : '1 way'}</td>
                        </tr>
                        <tr>
                            <th scope="row">Energy label</th>
                        <td>
			`
			if (item['energy_label']) {
				for (var i = 0; i < item['energy_label']; i++) {
					modal_data += "<i class='fas fa-star'></i>";
				}
				for (var i = item['energy_label']; i < 5; i++) {
					modal_data += "<i class='far fa-star'></i>";
				}
			}
			modal_data +=
				`
			                                </td>
			                                </tr>
			                                <tr>
			                                	<th scope="row">Warranty</th>
			                                	<td>${item['warranty_period'] ? item['warranty_period']: ''} months</td>
			                                </tr>
			                                <tr>
			                                	<th scope="row">Country of origin</th>
			                                	<td>${item['country_of_origin'] ? item['country_of_origin'] : ''}</td>
			                                </tr>
			                                <tr>
			                                    <th scope="row">Unit in stock</th>
			                                    <td>
			                                    ${item['unit_in_stock']}
			                                    </td>
			                                </tr>
		                            	</tbody>
		                          	</table>
		                          	<p>For more information about this product you can check out the document or visit this <span><a href="/product-details?product_id=${item['product_id']}"><b>link</b></a></span></p>
		                          	${cart_button(item['status'],item['unit_in_stock'],item)}
		                          	<a role="button" href="${item["document"] ? item["document"]: '' }" class="btn btn-info btn-document mb-30">Document</a>
		                      	</div>
		                  	</div>
		              	</div>
		          	</div>
		      	</div>
		  	</div>
			`
		}
		$("#products-modals").html(modal_data);
	}

</script>