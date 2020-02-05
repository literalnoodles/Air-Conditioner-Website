<?php include "dataTables.javascript.php"; ?>
<?php include "toast.javascript.php" ?>
<script src='/plugins/select2/select2.min.js'></script>
<?php if (!isset($action)) : ?>
	<script>
		$(document).ajaxComplete(function() {
			$(".update-status").off('click').click(function() {
				var btn = $(this);
				var order_id = btn.val();
				var status = btn.closest('td').prev().find("select").val();
				if (confirm("Do you want to change the status of this order ?")) {
					$.ajax({
						url: `/admin/ajax_process?type=orders&action=update_status&order_id=${order_id}&new_status=${status}`,
						type: 'post',
						success: function(result) {
							alert(result);
						}
					});
					//reload datatables
					$("#tbl_orders").DataTable().ajax.reload();
				};
			});
		});
	</script>
<?php endif; ?>
<?php if (isset($action)) : ?>
	<script>
		function load_product() {
			$(".product-ajax").select2({
				placeholder: "Select a product",
				ajax: {
					url: '/admin/ajax_process?type=orders&data=products',
					type: 'post',
					dataType: 'json',
					delay: 250,
					data: function(params) {
						return {
							searchTerm: params.term
						};
					},
					processResults: function(response) {
						return {
							results: response
						};
					},
					cache: true
				}
			});
		}

		function get_info() {
			$(".product-ajax").change(function() {
				var product_input = this;
				var quant = $(product_input.closest('div')).find('.quantity-Left');
				var order_quantity = $(product_input.closest('div')).next().find('input');
				var order_price = $(product_input.closest('div')).next().next().find('input');
				var order_discount = $(product_input.closest('div')).next().next().next().find('input');
				// var a = product_input.closest('div').find('.quantity-Left');
				$.ajax({
					url: "/admin/ajax_process?type=orders&data=products_quantity&product_id=" + product_input.value,
					success: function(result) {
						quant.html("Unit in stock: " + result);
						order_quantity.attr('max', result);
					}
				});
				$.ajax({
					url: "/admin/ajax_process?type=orders&data=products_price&product_id=" + product_input.value,
					success: function(result) {
						order_price.val(result);
					}
				});
				$.ajax({
					url: "/admin/ajax_process?type=orders&data=products_discount&product_id=" + product_input.value,
					success: function(result) {
						order_discount.val(result);
					}
				});

			});
		}

		$(document).ready(function() {
			load_product();
			get_info();
			$("#btnAdd").click(function() {
				var count = ($(".product-ajax").length);
				var lastProduct = $(".product-card").last();
				lastProduct.after(`
        <div class="card card-secondary product-card">
          <div class="card-header">
            <h3 class="card-title">Order details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
			      <div class="form-group">
                <label for="inputProduct">Product</label>
                <select name="details[${count}][product_id]" class="product-ajax form-control"  style="width: 100%" required>
                </select>
                <span class="quantity-Left"></span>
          	</div>
          	<div class="form-group">
              	<label>Quantity</label>
              	<input type="number" min="1" class="form-control" placeholder="123 ..." name="details[${count}][quantity]" value="" required>
            	</div>
            	<div class="form-group">
              	<label>Price</label>
                <div class="input-group">
                  <input type="number" min="0" class="form-control" placeholder="200000000 ..." name="details[${count}][unit_price]" value="" required>
                  <div class="input-group-append">
                    <span class="input-group-text">vnd</span>
                  </div>
                </div>
              </div>
            	<div class="form-group">
              	<label>Discount</label>
                <div class="input-group">
                  <input type="number" min="0" max="100" class="form-control" placeholder="100 ..." name="details[${count}][discount]" value="">
           	      <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
            </div>
        </div>
        `);
				load_product();
				get_info();
			});

		});
	</script>
<?php endif; ?>