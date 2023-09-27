<?= $this->extend('themes/bootstrapTheme') ?>

<?= $this->section('content') ?>

<?= $this->include('dashboard/navbar') ?>

<div class="container pt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Files
                        <a href="<?= base_url('dashboard/upload') ?>"
                            class="btn btn-primary btn-sm float-end">Upload</a>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>File Type</th>
                                <th>Preview</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($files as $file): ?>
                                <tr>
                                    <td>
                                        <?= $file['id'] ?>
                                    </td>
                                    <td>
                                        <?= $file['name'] ?>
                                    </td>
                                    <td>
                                        <?= $file['description'] ?>
                                    </td>
                                    <td>
                                        <?= $file['fileType'] ?>
                                    </td>
                                    <td>
                                        <!-- Audios -->
                                        <?php if ($file['fileType'] == "mp3") {
                                            echo "<audio controls>";
                                            echo "<source src='" . base_url() . "/uploads/" . $file['fileName'] . "' height='100px' width='100px' type='audio/mpeg'>";
                                            echo "</audio>";
                                        }
                                        ?>
                                        <?php if ($file['fileType'] == "wav") {
                                            echo "<audio controls>";
                                            echo "<source src='" . base_url() . "/uploads/" . $file['fileName'] . "' type='audio/wav'>";
                                            echo "</audio>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('dashboard/edit/' . $file['id']) ?>"
                                            class="btn btn-success btn-sm">Edit</a>
                                        <a href="<?= base_url('dashboard/delete/' . $file['id']) ?>"
                                            class="btn btn-danger btn-sm">Delete</a>
                                        <a href="<?= base_url('dashboard/viewComment/' . $file['id']) ?>"
                                            class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>