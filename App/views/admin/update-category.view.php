<?php include 'partials/admin.header.php';?>
<?php
  if ($action=='add'){
    $category_name="";
    $description="";
    $picture="";
  }
?>
    <!-- Main content -->
    <section class="content">
      <form method="POST" action="/admin/update-section?page=<?=$section_name?>&action=<?=$action?>" enctype="multipart/form-data">
      <!-- form content -->
      <?php if ($action=='edit'):?>
        <input type='hidden' name='category_id' value='<?=$category_id?>'>
        <input type="hidden" id='picture' name="picture" value="<?=$picture?>">
      <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
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
                <label for="inputCategory">Category Name</label>
                <input type="text" id="inputCategory" class="form-control" name="category_name" placeholder="Portable, Ductless-Split ..." value="<?=$category_name?>" required>
              </div>
              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea id="inputDescription" class="form-control" name="description" placeholder="Category description" rows="8"><?=$description?></textarea>
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
              <?php if($picture): ?>
              <div class="form-group">
                <table class="table">
                  <thead>
                    <th style="width: 90%">File Name</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?=$picture?></td>
                      <td>
                        <div class='btn-group btn-group-sm'>  
                          <a class='btn btn-info' href="<?=$picture?>" target="_blank"><i class="fas fa-eye"></i></a>
                          <button type="button" class='btn btn-danger' id='del_picture'><i class="fas fa-trash"></i></button>
                          <!-- <a class='btn btn-danger' href="#" target="_blank"><i class="fas fa-trash"></i></a> -->
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <?php endif;?>
              <div class="form-group">
                <label for="inputFile">Upload new picture</label>
                <div class="custom-file">
                  <input type="file" accept="image/*" class="custom-file-input" id="inputFile" name="picture">
                  <label class="custom-file-label" for="inputFile">
                    <?php if(!$picture) echo 'Choose file (no bigger than 1Mb)' ?>
                  </label>
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
          <a href="/admin?page=categories" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
      <!-- /.form content -->
      </form>
    </section>
    <!-- /.content -->
<?php include 'partials/admin.footer.php';?>