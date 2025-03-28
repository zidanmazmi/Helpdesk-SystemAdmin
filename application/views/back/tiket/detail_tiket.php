<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"></div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h5>No.Tiket : <?= $tiket->no_tiket ?></h5>
                    </div>

                    <div class="invoice p-3 mb-3">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-ticket-alt"></i> HELPDESK SYSTEM
                                    <small class="float-right">Date: <?= $tiket->tgl_dftr ?></small>
                                </h4>
                            </div>
                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <b>From</b><br>
                                <strong><?= $tiket->username ?></strong><br>
                                NIK: <?= $tiket->nik ?><br>
                                Jabatan: <?= $tiket->jabatan ?><br>
                                Divisi: <?= $tiket->divisi ?><br>
                                Email: <?= $tiket->email ?><br>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Status Tiket</b>:
                                <?php
                                if ($tiket->sts_tiket == '0') {
                                    echo '<span class="badge badge-warning"> Waiting...</span>';
                                } elseif ($tiket->sts_tiket == '1') {
                                    echo '<span class="badge badge-secondary"> Response..</span>';
                                } elseif ($tiket->sts_tiket == '2') {
                                    echo '<span class="badge badge-success"> Proses...</span>';
                                } else {
                                    echo '<span class="badge badge-primary"> Solver</span>';
                                }
                                ?>
                                <br>
                                <br>
                                <br>
                                <b>No.Tiket:</b> <?= $tiket->no_tiket ?><br>
                                <b>Pengajuan Laporan :</b>
                                <?php
                                if ($tiket->sts_tiket == '3') {
                                    echo $tiket->tgl_dftr;
                                } else {
                                    echo '- -';
                                }
                                ?> <br>
                                <b>Laporan Selesai :</b>
                                <?php
                                if ($tiket->sts_tiket == '3') {
                                    echo $tiket->waktu_tanggapan;
                                } else {
                                    echo '- -';
                                }
                                ?>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <label for="">Keluhan User / Karyawan</label>
                                <input type="text" value="<?= $tiket->judul_tiket ?>" readonly class="form-control mb-3">
                                <label for="">Deskripsi</label>
                                <textarea rows="6" readonly class="form-control mb-3"><?= $tiket->deskripsi ?></textarea>
                            </div>

                            <div class="col-6">
                                <label for="">Tanggapan Teknisi</label>
                                <textarea rows="9" readonly class="form-control mb-3"><?= $tiket->tanggapan ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p class="lead">Foto Komplain / Keluhan</p>
                                <img src="<?= base_url('assets/images/tiket/' . $tiket->gambar_tiket); ?>" width="250px">
                            </div>

                            <div class="col-6">
                                <p class="lead">Foto Tanggapan</p>
                                <img src="<?= base_url('assets/images/tanggapan/' . $tiket->gambar_tanggapan); ?>" width="250px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>