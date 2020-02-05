<?php 
    use App\Models\product;
    $product_id = filter_input(INPUT_POST,'product_id');
    echo json_encode((new product)->load_details($product_id));
?>