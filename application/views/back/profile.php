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
                        <h3 class="card-title"> Profile Karyawan </h3>
                    </div>
                    <div class="card-body">
                        <?= validation_errors() ?>
                        <?= $this->session->flashdata('message'); ?>

                        <form action="<?= base_url('karyawan/update_profile') ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="hidden" name="id_user" value="<?= $karyawan->id_user ?>">
                                <input type="text" name="nik" value="<?= $karyawan->nik ?>" class="form-control" placeholder="NIK">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="username" class="form-control" value="<?= $karyawan->username ?>" placeholder="Username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="email" value="<?= $karyawan->email ?>" class="form-control" placeholder="Email">
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
                                        <option value="<?= $row->id_jabatan ?>" <?= $row->id_jabatan == $karyawan->jabatan_id ? "selected " : null ?>>
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
                                        <option value="<?= $row->id_divisi ?>" <?= $row->id_divisi == $karyawan->divisi_id ? "selected " : null ?>>
                                            <?= $row->divisi ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm float-right mr-3 ml-3"> Update</button>
                            <!-- <button type="reset" class="btn btn-danger btn-sm float-left mr-3 ml-3"> Reset</button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>