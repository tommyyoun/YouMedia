<?=$this->extend('themes/bootstrapTheme')?>

<?=$this->section('content')?>

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Files
                            <a href="<?= base_url('dashboard/home') ?>" class="btn btn-warning btn-sm float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form class="form-height" action="<?= base_url('dashboard/store') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>File Name</label>
                                        <input type="text" name="name" class="form-control" required placeholder="Enter File Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" required placeholder="Enter Description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>File</label>
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary px-4 float-end">Save</button>
                                    <?php if(isset($error)):?>
                                        <div class="alert alert-warning float-start">
                                            <?= $error ?>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?=$this->endSection()?>