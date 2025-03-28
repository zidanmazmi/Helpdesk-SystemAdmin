<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mr-1"> Edit Karyawan |
                        </h3>
                        <p class="lead"><?= $user->username; ?> <a href="<?= base_url('karyawan') ?>" class="btn btn-warning btn-sm float-right"> Back</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <?= validation_errors() ?>
                        <form action="<?= base_url('karyawan/update_karyawan') ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="hidden" name="id_user" class="form-control" placeholder="Id_user" value="<?= $user->id_user; ?>">
                                <input type="text" name="nik" class="form-control" placeholder="NIK" value="<?= $user->nik; ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $user->username; ?>">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="email" value="<?= $user->email; ?>" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <select name="jabatan_id" class="form-control">
                                    <option>--Pilih Jabatan--</option>
                                    <?php foreach ($jabatan as $key => $row) {
                                    ?>
                                        <option value="<?= $row->id_jabatan ?>" <?= $row->id_jabatan == $user->jabatan_id ? "selected" : null ?>>
                                            <?= $row->jabatan ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <select name="divisi_id" class="form-control">
                                    <option>--Pilih divisi--</option>
                                    <?php foreach ($divisi as $key => $row) {
                                    ?>
                                        <option value="<?= $row->id_divisi ?>" <?= $row->id_divisi == $user->divisi_id ? "selected" : null ?>>
                                            <?= $row->divisi ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <select name="sts_user" class="form-control">
                                    <option value=""> Status User</option>
                                    <option value="1" <?= $user->sts_user == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= $user->sts_user == '0' ? 'selected' : '' ?>>Non-Active</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <select name="lvl_user" class="form-control">
                                    <option value=""> Level User</option>
                                    <option value="1" <?= $user->lvl_user == '1' ? 'selected' : '' ?>>ADMIN</option>
                                    <option value="2" <?= $user->lvl_user == '2' ? 'selected' : '' ?>>USER</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm float-left mr-3 ml-3"> Save</button>
                            <button type="reset" class="btn btn-danger btn-sm float-left mr-3 ml-3"> Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>