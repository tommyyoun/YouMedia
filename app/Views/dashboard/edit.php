<?=$this->extend('themes/bootstrapTheme')?>

<?=$this->section('content')?>

<?= $this->include('dashboard/navbar') ?>

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit File
                            <a href="<?= base_url('dashboard/home') ?>" class="btn btn-warning btn-sm float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form class="form-height" action="<?= base_url('dashboard/update/'.$file['id']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>File Name</label>
                                        <input type="text" name="name" value="<?= $file['name'] ?>" class="form-control" required placeholder="Enter File Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" required placeholder="Enter Description" rows="3"><?= $file['description'] ?></textarea>
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
                                    <button type="submit" class="btn btn-primary px-4 float-end">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <!-- Images -->
                <?php if ( $file['fileType'] == "jpg" || $file['fileType'] == "jpeg" || $file['fileType'] == "png" || $file['fileType'] == "gif") 
                    {
                        echo "<img src='" . base_url() . "/uploads/".$file['fileName'] . "' class='w-100 h-100' =alt='image'>";
                    }
                ?>

                <!-- Audios -->
                <?php if ( $file['fileType'] == "mp3") 
                    {
                        echo "<audio controls>";
                        echo "<source src='" . base_url() . "/uploads/".$file['fileName'] . "' height='100px' width='100px' type='audio/mpeg'>";
                        echo "</audio>";
                    }
                ?>
                <?php if ( $file['fileType'] == "wav") 
                    {
                        echo "<audio controls>";
                        echo "<source src='" . base_url() . "/uploads/".$file['fileName'] . "' type='audio/wav'>";
                        echo "</audio>";
                    }
                ?>
                
                <!-- Videos -->
                <?php if ( $file['fileType'] == "mp4") 
                    {
                        echo "<video class='w-100 h-100' controls>";
                        echo "<source src='" . base_url() . "/uploads/".$file['fileName'] . "' type='video/mp4'>";
                        echo "</video>";
                    }
                ?>
            </div>
        </div>
    </div>

<?=$this->endSection()?>