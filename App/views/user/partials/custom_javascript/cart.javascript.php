<script>
	$(document).ready(function(){
		load_cart();
		calculate_total();
		change_cart_qty();
		remove_item();
	})

	function load_cart(){
		data = localStorage.getItem('cart');
		if (data == undefined){
			cart = [];
		}else{
			cart = JSON.parse(data);
		}
		if (cart.length==0){
			$('#cart-table tbody').append(
				`
				<tr>
					<td colspan="6" align="center">You don't have any product in cart yet!</td>
				</tr>
				`
			)
			return;
		}
		for(var item of cart){
			if (item.discount) item.new_price = (item.unit_price*(100-item.discount)/100);
			$('#cart-table tbody').append(
				`
				<tr>
                    <td class="product-remove"><a data-product="${item.product_id}" class="btn-remove" href="#" onclick="return false;"><i class="pe-7s-close"></i></a></td>
                    <td class="product-thumbnail">
                        <a href="#"><img style="max-width:85px" src="${item.picture}" alt=""></a>
                    </td>
                    <td class="product-name"><a href="product-details?product_id=${item.product_id}">${item.product_name}</a></td>
                    ${price_after_discount(parseInt(item.unit_price),parseInt(item.discount))}
                    <td class="product-quantity">
                        <div class="input-group" style="justify-content: center;">
                            <button type="button" data-product="${item.product_id}" data-change="-1" onclick="this.blur();" class="btn btn-outline-secondary btn-qty btn-number-minus" style="height:unset">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class='quantity-input' name="quant" value="${item.count}" min="1">
                            <button type="button" data-product="${item.product_id}" data-change="1" onclick="this.blur();" class="btn btn-outline-success btn-qty btn-number-plus" style="height:unset">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </td>
                    <td class="product-subtotal"></td>
                </tr>
				`
			)
		}
	}

	function price_after_discount(price,discount){
		if (!discount){
			return `<td data-price='${price}' class="product-price-cart"><span class="amount">$${price}</span></td>`;
		}else{
			new_price = price*(100-discount)/100;
			return `<td data-price='${price}' data-discount='${discount}' class="product-price-cart"><span class="amount">$${new_price}</span>&nbsp(-${discount}%)</td>`
		}
	}

	function calculate_total(){
		saving = 0;
		final_result = 0;
		for (item of $(".product-subtotal")){
			qty = parseInt($(item).prevAll('.product-quantity').find('input').val());
			discount = $(item).prevAll('.product-price-cart').data('discount');
			price = $(item).prevAll('.product-price-cart').data('price');
			if (discount){
				saving += price*qty*discount/100;
			}else{
				discount = 0;
			}
			total = qty * price * (100-discount)/100;
			final_result += total;
			$(item).html(`$${total}`);
		}
		$("#saving").html(`$${saving}`);
		$("#total").html(`$${final_result}`);
	}

	function change_cart_qty(){
		$("body").on("click",".btn-qty",function(){
			change = parseInt($(this).data('change'));
			input = $(this).parent().find("input");
			old_value = parseInt(input.val());
			new_value = old_value + change;
			if (new_value<1) new_value = 1;
			input.val(new_value);
			//update change to local_storage;
			product_id = $(this).data('product');
			change_amount_item(product_id,new_value);
			calculate_total();
			show_cart();
		})
	}

	function remove_item(){
		$("body").on("click",".btn-remove",function(){
			row = $(this).closest("tr");
			product_id = $(this).data('product');
			$.confirm({
				title: 'Confirm!',
				content: 'Remove this item from your cart ?',
				buttons: {
					confirm: {
						text: 'Confirm!',
						btnClass: 'btn-blue',
						key: ['enter'],
						action: function () {
							row.remove();
							delete_item(product_id);
							show_cart();
						}
					},
					cancel: {}
				}
			});
		})
	}
</script>