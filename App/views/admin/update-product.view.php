<?php include 'partials/admin.header.php';?>
<?php
  if ($action=='add'){
    $picture="";
    $document="";
    $product_name="";
    $country_of_origin="";
    $unit_price="";
    $unit_in_stock="";
    $discount="";
    $status="";
    $brand_id="";
    $category_id="";
    $features_arr=[];
    $apower_consumption="";
    $effective_range="";
    $n_ways="";
    $inverter="";
    $energy_label="";
    $release_date="";
    $warranty_period="";
    $short_description="";
    $description="";
  }
?>
    <!-- Main content -->
    <section class="content">
      <form method="POST" action="/admin/update-section?page=<?=$section_name?>&action=<?=$action?>" enctype="multipart/form-data">
      <!-- form content -->
      <?php if ($action=='edit'):?>
        <input type='hidden' name='product_id' value='<?=$product_id?>'>
        <input type="hidden" id='picture' name="picture" value="<?=$picture?>">
        <input type="hidden" id='document' name="document" value="<?=$document?>">
      <?php endif; ?>
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General information</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Product Name</label>
                <input type="text" id="inputName" class="form-control" name="product_name" 
                  placeholder="Example: Samsung Inverter 1.5 HP AR13MVFHGWKNSV ..." 
                  value="<?=$product_name?>" required>
              </div>

              <div class="form-group">
                <label for="inputCountry">Country of origin</label>
                <input type="text" id="inputCountry" class="form-control" placeholder="Japan, Korean ..." name="country_of_origin" value="<?=$country_of_origin?>">
              </div>

              <div class="form-group">
                <label for="inputPrice">Unit price</label>
                <div class='input-group'>
                  <input type="number" id="inputPrice" min="0" class="form-control" placeholder="123 ..." name="unit_price" value="<?=$unit_price?>">
                  <div class="input-group-append">
                      <span class="input-group-text">$</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="inputDiscount">Discount</label>
                <div class='input-group'>
                  <input type="number" id="inputDiscount" min="0" max="100" class="form-control" placeholder="50 ..." name="discount" value="<?=$discount?>">
                  <div class="input-group-append">
                      <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="inputStock">Unit in stock</label>
                <input type="number" id="inputStock" min="0" class="form-control" placeholder="123 ..." name="unit_in_stock" required value="<?=$unit_in_stock?>">
              </div>

              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select name="status" id="inputStatus" class="form-control" required>
                  <option <?= ($status == "" ? "selected" : "") ?> value="" disabled hidden>Select a status...</option>
                  <option <?= ($status == "1" ? "selected" : "") ?> value="1">Coming soon</option>
                  <option <?= ($status == "2" ? "selected" : "") ?> value="2">Ready</option>
                  <option <?= ($status == "3" ? "selected" : "") ?> value="3">Discontinued</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputBrand">Brand</label>
                <select name="brand_id" id="inputBrand" class="form-control" required>
                  <option <?= ($brand_id == "" ? "selected" : "") ?> value="">Select a brand...</option>
                  <?php foreach ($all_brands as $brand ): ?>
                    <option <?= ($brand_id == $brand["brand_id"] ? "selected" : "") ?> value=<?= $brand["brand_id"]; ?>><?= $brand["brand_name"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputCategory">Category</label>
                <select name="category_id" id="inputCategory" class="form-control" required>
                  <option <?= ($category_id == "" ? "selected" : "") ?> value="">Select a category...</option>
                  <?php foreach ($all_categories as $category ): ?>
                    <option <?= ($category_id == $category["category_id"] ? "selected" : "") ?> value=<?= $category["category_id"]; ?>><?= $category["category_name"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputFeature">Feature</label>
                <select name="features_arr[]" id="inputFeature" class="form-control" multiple>
                  <?php foreach ($all_features as $feature ): ?>
                  <option <?= (in_array($feature["feature_id"],$features_arr) ? "selected" : "") ?> value=<?= $feature["feature_id"]; ?>><?= $feature["feature_name"]; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="inputShDescription">Short description</label>
                <textarea id="inputShDescription" class="form-control" name="short_description" placeholder="Short description" rows="4"><?=$short_description?></textarea>
              </div>

              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea id="inputDescription" class="form-control" name="description"><?=$description?></textarea>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-4">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Product Details</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputConsumption">Average Power Consumption</label>
                <div class='input-group'>
                  <input type="number" id="inputConsumption" min="0" class="form-control" placeholder="0.9" step="0.1" name="apower_consumption" value="<?=$apower_consumption?>">
                  <div class="input-group-append">
                      <span class="input-group-text">kW/h</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="inputCapacity">Cooling capacity</label>
                <div class='input-group'>
                  <input type="number" id="inputCapacity" min="0" class="form-control" placeholder="11500" name="cooling_capacity" value="<?=$cooling_capacity?>">
                  <div class="input-group-append">
                      <span class="input-group-text">BTU</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="inputRange">Effective cooling range</label>
                <div class='input-group'>
                  <input type="number" id="inputRange" min="0" class="form-control" placeholder="15" name="effective_range" value="<?=$effective_range?>">
                  <div class="input-group-append">
                      <span class="input-group-text">m<sup>2</sup></span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="inputNWays">Type(1 or 2 ways)</label>
                <select name="n_ways" id="inputNWays" class="form-control" required>
                  <option <?= ($n_ways == "" ? "selected" : "") ?> value="" disabled hidden>Select a type...</option>
                  <option <?= ($n_ways == "1" ? "selected" : "") ?> value="1">1 way Airconditioner</option>
                  <option <?= ($n_ways == "2" ? "selected" : "") ?> value="2">2 ways Airconditioner</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputInverter">Have inverter ?</label>
                <select name="inverter" id="inputInverter" class="form-control" required>
                  <option <?= ($inverter == "" ? "selected" : "") ?> value="" disabled hidden>Select a type...</option>
                  <option <?= ($inverter == "0" ? "selected" : "") ?> value="0">No</option>
                  <option <?= ($inverter == "1" ? "selected" : "") ?> value="1">Yes</option>
                </select>
              </div>

              <div class="form-group">
                <label for="inputLabel">Energy Label</label>
                <div class='input-group'>
                  <input type="number" id="inputLabel" min="0" max="5" class="form-control" placeholder="5" name="energy_label" value="<?=$energy_label?>">
                  <div class="input-group-append">
                      <span class="input-group-text"><i class="far fa-star"></i></span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="inputDate">Release date</label>
                <input type="date" name="release_date" class="form-control" id="inputDate" value="<?=date_format(date_create($release_date),'Y-m-d')?>" min="2010-01-01">
              </div>

              <div class="form-group">
                <label for="inputWarranty">Warranty Period</label>
                <div class='input-group'>
                  <input type="number" id="inputWarranty" min="0" class="form-control" placeholder="15" name="warranty_period" value="<?=$warranty_period?>">
                  <div class="input-group-append">
                      <span class="input-group-text">month(s)</span>
                  </div>
                </div>
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
              <?php if($action=="edit"): ?>
                <div class="form-group">
                  <table class="table">
                    <thead>
                      <th>File Type</th>
                      <th style="width: 70%">File Name</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php if ($picture): ?>
                      <tr>
                        <td>Picture</td>
                        <td><?=$picture;?></td>
                        <td>
                          <div class='btn-group btn-group-sm'>  
                            <a class='btn btn-info' href="<?=$picture;?>" target="_blank"><i class="fas fa-eye"></i></a>
                            <button type="button" class='btn btn-danger' id='del_picture'><i class="fas fa-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                      <?php endif;?>
                      <?php if ($document): ?>
                        <tr>
                          <td>Document</td>
                          <td><?=$document;?></td>
                          <td>
                            <div class='btn-group btn-group-sm'>  
                              <a class='btn btn-info' href="<?=$document;?>" target="_blank"><i class="fas fa-eye"></i></a>
                              <button type="button" class='btn btn-danger' id='del_document'><i class="fas fa-trash"></i></button>
                            </div>
                          </td>
                        </tr>
                      <?php endif;?>
                    </tbody>
                  </table>
                </div>
              <?php endif;?>
              <div class="form-group">
                <label for="inputPicture">Upload new picture</label>
                <div class="custom-file">
                  <input type="file" accept="image/*" class="custom-file-input" id="inputPicture" name="picture">
                  <label class="custom-file-label" for="inputPicture">
                    <?php echo 'Choose picture (no bigger than 1Mb)' ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputDocument">Upload new document</label>
                <div class="custom-file">
                  <input type="file" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" class="custom-file-input" id="inputDocument" name="document">
                  <label class="custom-file-label" for="inputDocument">
                    <?php echo 'Choose document (no bigger than 1Mb)' ?>
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
          <a href="/admin?page=products" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
      <!-- /.form content -->
      </form>
    </section>
    <!-- /.content -->
<?php include 'partials/admin.footer.php';?>