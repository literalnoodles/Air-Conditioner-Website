<?php include 'partials/admin.header.php';?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              	<div class="col-8">
              	  <h3 class="card-title">All active categories</h3>	
              	</div>
              	<!-- add category -->
              	<div class="col-4">
                  <a class="btn-sm btn-primary float-sm-right" href="/admin?page=categories&action=add" role="button">Add a new category</a>
              	</div>
              	<!-- /add category -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_categories" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>Category Name</th>
                  <th>Description</th>
                  <th>Picture</th>
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