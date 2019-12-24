<?php include 'partials/admin.header.php';?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              	<div class="col-8">
              	  <h3 class="card-title">All active brands</h3>	
              	</div>
              	<!-- add brand -->
              	<div class="col-4">
                  <a class="btn-sm btn-primary float-sm-right" href="/admin?page=brands&action=add" role="button">Add a new brand</a>
              	</div>
              	<!-- /add brand -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_brands" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Brand Name</th>
                  <th>Description</th>
                  <th>Address</th>
                  <th>Phone number</th>
                  <th>Logo</th>
                  <th>Action</th>
                  <!-- <th>Action</th> -->
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

