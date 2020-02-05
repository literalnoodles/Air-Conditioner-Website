<?php include 'partials/admin.header.php'; ?>
<?php
if ($action == 'add') {
  $fullname = "";
  $address = "";
  $city = "";
  $status = "";
  $phone = "";
  $note = "";
  $order_id = "";
  $details = [];
}
?>
<!-- Main content -->
<section class="content">
  <form method="POST" action="/admin/update-section?page=<?= $section_name ?>&action=<?= $action ?>">
    <!-- form content -->
    <?php if ($action == 'edit') : ?>
      <input type='hidden' name='order_id' value='<?= $order_id ?>'>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Contact</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="inputName">Full Name</label>
              <input type="text" id="inputName" class="form-control" name="fullname" placeholder="Nguyen Van A" value="<?= $fullname ?>" required>
            </div>
            <div class="form-group">
              <label for="inputCountry">Address</label>
              <input type="text" id="inputAddress" class="form-control" placeholder="so 10 pho Tran Hung Dao..." name="address" value="<?= $address ?>">
            </div>
            <div class="form-group">
              <label for="inputCountry">City</label>
              <input type="text" id="inputCity" class="form-control" placeholder="Ha Noi..." name="city" value="<?= $city ?>">
            </div>
            <div class="form-group">
              <label for="inputStatus">Status</label>
              <select name="status" id="inputStatus" class="form-control" required>
                <option <?= ($status === ""  ? "selected" : "") ?> value="" disabled hidden>Select a status...</option>
                <option <?= ($status === "1" ? "selected" : (($status > 1) ? "disabled hidden" : "")) ?> value="1">Confirming</option>
                <option <?= ($status === "2" ? "selected" : (($status > 2) ? "disabled hidden" : "")) ?> value="2">Packing</option>
                <option <?= ($status === "3" ? "selected" : (($status > 3) ? "disabled hidden" : "")) ?> value="3">Delivering</option>
                <option <?= ($status === "4" ? "selected" : (($status > 4) ? "disabled hidden" : "")) ?> value="4">Complete</option>
                <?php if ($action == "edit") : ?>
                  <option <?= ($status === "5" ? "selected" : "") ?> value="5">Cancel</option>
                <?php endif; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputPhone">Phone number</label>
              <input type="tel" id="inputPhone" class="form-control" placeholder="1800-588-855" name="phone" value="<?= $phone ?>">
            </div>
            <div class="form-group">
              <label for="inputNote">Note</label>
              <textarea id="inputNote" class="form-control" name="note" placeholder="Note" rows="2"><?= $note ?></textarea>
            </div>
          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-8">
        <?php if ($action == 'add') : ?>
          <div class="card card-secondary product-card">
            <div class="card-header">
              <h3 class="card-title">Order details</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputProduct">Product</label>
                <select name="details[0][product_id]" class="product-ajax form-control" style="width: 100%" required>
                </select>
                <span class="quantity-Left"></span>
              </div>
              <div class="form-group">
                <label>Quantity</label>
                <input type="number" min="1" class="form-control" placeholder="123 ..." name="details[0][quantity]" value="" required>
              </div>
              <div class="form-group">
                <label>Price</label>
                <div class="input-group">
                  <input type="number" min="0" class="form-control" placeholder="200000000 ..." name="details[0][unit_price]" value="" required>
                  <div class="input-group-append">
                    <span class="input-group-text">vnd</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Discount</label>
                <div class="input-group">
                  <input type="number" min="0" max="100" class="form-control" placeholder="100 ..." name="details[0][discount]" value="">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body-->
          </div>
          <!-- /.card -->
        <?php endif; ?>
        <?php if ($action == 'edit') : ?>
          <?php foreach ($details as $index => $item) : ?>
            <div class="card card-secondary product-card">
              <div class="card-header">
                <h3 class="card-title">Order details</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="inputProduct">Product</label>
                  <select name="details[<?= $index ?>][product_id]" class="product-ajax form-control" style="width: 100%" required>
                    <option value="<?= $item['product_id'] ?>" selected="selected"><?= $item['product_name'] ?></option>
                  </select>
                  <span class="quantity-Left"></span>
                </div>
                <div class="form-group">
                  <label>Quantity</label>
                  <input type="number" min="1" class="form-control" placeholder="123 ..." name="details[<?= $index ?>][quantity]" value="<?= $item['quantity'] ?>" required>
                </div>
                <div class="form-group">
                  <label>Price</label>
                  <div class="input-group">
                    <input type="number" min="0" class="form-control" placeholder="200000000 ..." name="details[<?= $index ?>][unit_price]" value="<?= $item['unit_price'] ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">vnd</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Discount</label>
                  <div class="input-group">
                    <input type="number" min="0" max="100" class="form-control" placeholder="100 ..." name="details[<?= $index ?>][discount]" value="<?= $item['discount'] ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif ?>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="/admin?page=orders" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Save Changes" class="btn btn-success float-right">
        <a class="btn btn-primary float-right" href="#" id="btnAdd" role="button">Add more product</a>
      </div>
    </div>
    <!-- /.form content -->
  </form>
</section>
<!-- /.content -->
<?php include 'partials/admin.footer.php'; ?>