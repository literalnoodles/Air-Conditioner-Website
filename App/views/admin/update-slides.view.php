<?php include 'partials/admin.header.php'; ?>
<section class="content">
    <form method="POST" action="/admin/update-slides" enctype="multipart/form-data">
        <!-- form content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Slides</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php if (isset($slides)) : ?>
                                <table class="table">
                                    <thead>
                                        <th class="text-center align-middle" style="width: 70%">Slide</th>
                                        <th class="text-center align-middle">Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($slides as $slide) : ?>
                                            <tr>
                                                <td class="text-center align-middle"><img style="max-height: 100px" src="<?= $slide['path'] ?>" alt=""></td>
                                                <td class="text-center align-middle">
                                                    <div class='btn-group btn-group-sm'>
                                                        <a class='btn btn-info' href="<?= $slide['path'] ?>" target="_blank"><i class="fas fa-eye"></i></a>
                                                        <button type="button" data-slideid="<?= $slide['slide_id']; ?>" class='slide-delete btn btn-danger'><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="inputFile">Upload new slide</label>
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" multiple id="inputFile" name="slides[]">
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
                <a href="/admin" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Save Changes" class="btn btn-success float-right">
            </div>
        </div>
        <!-- /.form content -->
    </form>
</section>
<?php include 'partials/admin.footer.php'; ?>