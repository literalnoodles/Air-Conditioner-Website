<script>
	$(document).ready(function(){
		var btn = $('#btn-cart');
		switch (<?= $product_details['status'] ?>) {
			case 1:
				btn.html('Coming soon');
				btn.addClass('disabled');
				break;
			case 2:
				if (<?= $product_details['unit_in_stock'] ?> > 0){
					btn.data('product',{
						product_id: "<?= $product_details['product_id'] ?>",
						product_name: "<?= $product_details['product_name'] ?>",
						unit_price: "<?= $product_details['unit_price'] ?>",
						discount: "<?= $product_details['discount'] ?>",
						picture: "<?= $product_details['picture'] ?>"
					});
					btn.html('Add to cart');
				}else{
					btn.html('Out of stock');
					btn.addClass('disabled');
				}
				break;
			case 3:
				btn.addClass('disabled');
				btn.html('Discontinued');
				break;
			default:
		}
		$('body').on('click', '#btn-cart:not(.disabled)', function() {
			product_details = $(this).data('product');
			product_details.count = parseInt($("#product-amount").val());
			add_to_cart(product_details);
			show_cart();
		});
	})
	
</script>