<?php include 'partials/admin.header.php';?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              	<div class="col-8">
              	  <h3 class="card-title">All products</h3>	
              	</div>
              	<!-- add product -->
              	<div class="col-4">
                  <a class="btn-sm btn-primary float-sm-right" href="/admin?page=products&action=add" role="button">Add a new product</a>
              	</div>
              	<!-- /add product -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_products" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Brand Name</th>
                  <th>Category</th>
                  <th>Unit in stock</th>
                  <th>Picture</th>
                  <th>Status</th>
                  <th>Discount</th>
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

