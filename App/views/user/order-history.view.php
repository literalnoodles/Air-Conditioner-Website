<?php include "partials/user.header.php"; ?>
<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="text-center pb-40">
            <h2>Your order history</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-12 col-lg-8 col-xl-8 ml-auto mr-auto text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Products</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders_history as $order) : ?>
                            <tr>
                                <td><?= $order['order_date']; ?></td>
                                <td><?= $order['order_items'] ?></td>
                                <td><?= $order['status']==1 ? 'Confirming' : $order['status']==2 ? 'Packing' : $order['status']==3 ? 'Delivering' : 'Complete' ?></td>
                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "partials/user.footer.php"; ?>