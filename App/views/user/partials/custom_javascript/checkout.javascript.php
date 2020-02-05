<script>
	$(document).ready(function(){
		show_order();
		$("#btn-submit").on("click",function(){
			check_unit_qty(function(response){
				result = JSON.parse(response);
				if (result.status == false){
					$.alert({
						title: 'Notification',
						content: `${result.msg}!`,
					});
				}else{
					submit_order();
				}
			});
		})
	})

	function show_order(){
		all_orders = $("#tbl-orders").find('tbody');
		discount = 0;
		total = 0;
		data = localStorage.getItem('cart');
		if (data == undefined){
			cart = [];
		}else{
			cart = JSON.parse(data);
		}
		for (item of cart){
			discount += item.discount/100*item.unit_price*item.count;
			total += (100-item.discount)/100*item.unit_price*item.count;
			all_orders.append(`
				<tr class="cart_item">
					<td class="product-name">
						${item.product_name}<strong class="product-quantity"> × ${item.count}</strong>
					</td>
					<td class="product-total">
						<span class="amount">$${item.unit_price*item.count}</span>
					</td>
				</tr>
			`)
		}
		$("#tbl-orders").find('tfoot').append(`
				<tr class="cart-subtotal">
                    <th>Discount</th>
                    <td><span class="amount">($${discount ? discount : 0})</span></td>
                </tr>
                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">$${total}</span></strong>
                    </td>
                </tr>	
			`)
	}

	function total_per_item(price,discount,count) {
		return price*(100-discount)/100*count;
	}

	function show_user_info() {
		console.log(`<?= var_dump(isset($_SESSION['user'])); ?>`)
	}

	function generate_cart_input(){
		data = localStorage.getItem('cart');
		if (data == undefined){
			cart = [];
		}else{
			cart = JSON.parse(data);
		}
		var i = 0;
		for (;i<cart.length;i++){
			$("#order-form").append(`
				<input type="hidden" name="cart[${i}][product_id]" value="${cart[i].product_id}">
				<input type="hidden" name="cart[${i}][unit_price]" value="${cart[i].unit_price}">
				<input type="hidden" name="cart[${i}][discount]" value="${cart[i].discount}">
				<input type="hidden" name="cart[${i}][quantity]" value="${cart[i].count}">
			`)
		}
	}

	function check_unit_qty(handle_result){
		data = localStorage.getItem('cart');
		if (data == undefined){
			cart = [];
		}else{
			cart = JSON.parse(data);
		}
		check_cart=[];
		for (item of cart){
			check_cart.push({
				"product_name":item.product_name,
				"product_id":item.product_id,
				"quantity":item.count
			})
		}
		$.ajax({
			data:{
				check_cart:JSON.stringify(check_cart)
			},
			method: 'POST',
			url: '/user/ajax_process?type=checkout&action=check_cart',
			success: function(response){
				handle_result(response);
			}
		})
	}

	function submit_order(){
		all_items = []
		data = localStorage.getItem('cart');
		if (data == undefined){
			cart = [];
		}else{
			cart = JSON.parse(data);
		}
		var i = 0;
		for (;i<cart.length;i++){
			all_items.push({
				"product_id":cart[i].product_id,
				"unit_price":cart[i].unit_price,
				"discount":cart[i].discount,
				"quantity":cart[i].count
			});
		}
		$.ajax({
			data:{
				"fullname":$("input[name='fullname']").val(),
				"address":$("input[name='address']").val(),
				"city":$("input[name='city']").val(),
				"phone":$("input[name='phone']").val(),
				"email":$("input[name='email']").val(),
				"status":1,
				"note":$("textarea[name='note']").val(),
				"cart": all_items
			},
			method: 'POST',
			url: '/user/ajax_process?type=checkout&action=request_order',
			success: function(response){
				result = JSON.parse(response);
				if (result==true){
					localStorage.removeItem('cart');
					$.confirm({
						title: 'Thank you!',
						content: 'Your order has been received !',
						type: 'green',
						typeAnimated: true,
						buttons: {
							continue: {
								text: 'Continue shopping',
								btnClass: 'btn-green',
								action: function(){
									location.href = "/products"
								}
							},
							close: function () {
							}
						}
					});
				}else{
					$.confirm({
						title: 'Encountered an error!',
						content: 'Something went wrong with your order, please contact shop owner for more information!',
						type: 'red',
						typeAnimated: true,
						buttons: {
							tryAgain: {
								text: 'Try again',
								btnClass: 'btn-red',
								action: function(){
								}
							},
							close: function () {
							}
						}
					});
				}
				// handle_result(response);
			}
		})
		
	}
</script>