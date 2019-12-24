<?php include 'partials/admin.header.php';?>
    <!-- Main content -->
    <section class="content">
      <form method="POST" action="/admin/add-brand" enctype="multipart/form-data">
      <!-- form content -->
      <div class="row">
        <div class="col-md-7">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Brand Name</label>
                <input type="text" id="inputName" class="form-control" name="brand_name" placeholder="Samsung, Daikin ..." required>
              </div>
              <div class="form-group">
                <label for="inputCountry">Country</label>
                <input type="text" id="inputCountry" class="form-control" placeholder="Japan, Korean ..." name="country">
              </div>
              <div class="form-group">
                <label for="inputWebsite">Website</label>
                <input type="text" id="inputWebsite" class="form-control" placeholder="https://www.example.com ..." name="website">
              </div>
              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea id="inputDescription" class="form-control" name="description" placeholder="Brand description" rows="8"></textarea>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-5">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Contact</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputAdress">Address</label>
                <input type="text" id="inputAdress" class="form-control" placeholder="Address of supplier" name="address">
              </div>
              <div class="form-group">
                <label for="inputPhone">Phone number</label>
                <input type="tel" id="inputPhone" class="form-control" placeholder ="1800-588-855" name="phone_number">
              </div>
              <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder ="example@gmail.com" name="email">
              </div>
              <div class="form-group">
                <label for="inputFax">Fax</label>
                <input type="text" id="inputFax" class="form-control" placeholder ="+xx (xxx) xxx-xxxx" name="fax">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Files</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputFile">Brand logo</label>
                <!-- <input type="file" id="inputFile" class="form-control-file"> -->
                <div class="custom-file">
                  <input type="file" accept="image/*" class="custom-file-input" id="inputFile" name="logo">
                  <label class="custom-file-label" for="inputFile">Choose file (no bigger than 1Mb)</label>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="/admin?page=brands" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
      <!-- /.form content -->
      </form>
    </section>
    <!-- /.content -->
<?php include 'partials/admin.footer.php';?>