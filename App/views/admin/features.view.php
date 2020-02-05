<?php include 'partials/admin.header.php';?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              	<div class="col-8">
              	  <h3 class="card-title">All features</h3>	
              	</div>
              	<!-- add brand -->
              	<div class="col-4">
                  <a class="btn-sm btn-primary float-sm-right" href="#" onclick="Add()" role="button">Add a new feature</a>
              	</div>
              	<!-- /add brand -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tbl_brands" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Feature name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
              <!-- modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-title">Add feature</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="FeatureName" class="col-form-label">Feature Name</label>
                        <input type="text" class="form-control" name="feature_name" id="FeatureName" required />
                      </div>
                      <div class="form-group">
                        <label for="Description" class="col-form-label">Description</label>
                        <textarea class="form-control" name="description" id="Description"></textarea>
                      </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" id="btnSave" class="btn btn-primary" onclick="Save()">Save</button>
                    </div>

                  </div>
                </div>
              </div>
               <!-- /.modal -->
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