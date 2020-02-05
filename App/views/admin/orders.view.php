<?php include 'partials/admin.header.php';?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              	<div class="col-8">
              	  <h3 class="card-title">All orders</h3>	
              	</div>
              	<!-- add brand -->
              	<div class="col-4">
                  <a class="btn-sm btn-primary float-sm-right" href="/admin?page=orders&action=add" role="button">Add a new order</a>
              	</div>
              	<!-- /add brand -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_orders" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Customer Name</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Phone number</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php include 'partials/admin.footer.php';?>

