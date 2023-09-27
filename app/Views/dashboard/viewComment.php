<?=$this->extend('themes/bootstrapTheme')?>

<?=$this->section('content')?>

<?= $this->include('dashboard/navbar') ?>

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <a href="<?= base_url('dashboard/home') ?>" class="btn btn-warning btn-sm float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form class="form-height" action="<?= base_url('dashboard/addComment/'.$file['id']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <textarea name="description" class="form-control" required placeholder="Enter Comment" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary px-4 float-end">Add Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
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
        <!-- Comments -->
        <div class="my-5">
            <?php foreach($comments as $comment): ?>
                <div class="col-md-12 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p><?= $comment['description'] ?></p>
                            <div class="blockquote-footer"><cite title="Source Title"><?= $comment['firstName'] ?> <?= $comment['lastName'] ?></cite></div>
                            </blockquote>
                            <div class="float-end">
                                <form class="d-inline" action="<?= $file['id']?>/addLike/<?= $comment['id'] ?>" method="POST">
                                    <button type="submit" class="btn btn-primary">Like</button>
                                </form>
                                <div class="d-inline mx-2"><?= $comment['rating'] ?></div>
                                <form class="d-inline" action="<?= $file['id']?>/addDislike/<?= $comment['id'] ?>" method="POST">                                
                                    <button type="submit" class="btn btn-warning">Dislike</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?=$this->endSection()?>