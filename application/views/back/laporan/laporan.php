<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row mt-2">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Filter Laporan </h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('laporan/print_laporan') ?>" method="post" target="_blank">
                            <div class="form-group">
                                <label> Tanggal Awal </label>
                                <input type="date" name="tgl_awal" id="tgl_awal" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> Tanggal Akhir </label>
                                <input type="date" name="waktu_tanggapan" id="waktu_tanggapan" value="<?= date('Y-m-d') ?>" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"> Print</button>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>