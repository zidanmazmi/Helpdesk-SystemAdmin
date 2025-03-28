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
                        <h3 class="card-title"> Data Tiket </h3>
                        <a href="<?= base_url('tiket/add_tiket') ?>" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#form_tiket"> <i class="fa fa-ticket-alt mr-2"></i>Tambah Tiket</a>

                    </div>

                    <div class="card-body"><?= $this->session->flashdata('message'); ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Tiket</th>
                                    <th>Judul Tiket</th>
                                    <th>Status Tiket</th>
                                    <th>Konfirmasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($tiket as $row) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->no_tiket ?></td>
                                        <td><?= $row->judul_tiket ?></td>
                                        <td>
                                            <?php if ($row->sts_tiket == '0') {
                                                echo '<span class="badge badge-warning"> Waiting...</span>';
                                            } else if ($row->sts_tiket == '1') {
                                                echo '<span class="badge badge-secondary"> Response..</span>';
                                            } else if ($row->sts_tiket == '2') {
                                                echo '<span class="badge badge-success"> Proses...</span>';
                                            } else {
                                                echo '<span class="badge badge-primary"> Solver</span>';
                                            } ?>
                                        </td>
                                        <td> <?php
                                                if ($row->sts_tiket == '0') {
                                                    echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-tiket" id="select_tiket" 
                                            data-id_tiket="' . $row->id_tiket . '"
                                            data-sts_tiket="' . $row->sts_tiket . '"
                                            class="btn btn-success btn-sm justify-center "> Confirm </a>';
                                                } else if ($row->sts_tiket == '1') {
                                                    echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal-reply" id="reply_message" 
                                                    data-tiket_id="' . $row->id_tiket . '"
                                                    data-id_tiket_id="' . $row->id_tiket . '"
                                                    data-judul_tiket="' . $row->judul_tiket . '"
                                                    data-deskripsi="' . $row->deskripsi . '"
                                                    class="btn btn-warning btn-sm justify-center"> 
                                                        Reply Message </a>';
                                                } else if ($row->sts_tiket == '2') {
                                                    echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#modal_close_tiket" id="ctiket" 
                                                    data-closetiket="' . $row->id_tiket . '"
                                                    data-sts_tiket="' . $row->sts_tiket . '"
                                                    class="btn btn-primary btn-sm"> 
                                                    Selesai
                                                </a>
                                                ';
                                                } else {
                                                    echo '<span class="badge badge-success"> Done</span>';
                                                }
                                                ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('tiket/detail_tiket/' . $row->no_tiket) ?>" class=" btn btn-primary btn-sm ">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a onclick="return confirm('Yakin akan menghapus?')" href="<?= base_url('tiket/delete_tiket/' . $row->id_tiket) ?>" class=" btn btn-danger btn-sm ml-2">
                                                <i class="fa fa-trash"></i>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin konfirm tiket ini?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket_waiting') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="id_tiket" class="form-control">
                    <input type="hidden" name="sts_tiket" value="1" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="form_tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tiket') ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="no_tiket">No. Tiket</label>
                        <input type="text" name="no_tiket" value="<?= $no_tiket ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="judul_tiket">Judul Tiket</label>
                        <input type="text" name="judul_tiket" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar_tiket">Gambar</label>
                        <input type="file" name="gambar_tiket" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reply">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tanggapan Teknisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_tanggapan') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="id_tiket_id" class="form-control">
                    <input type="hidden" name="tiket_id" id="tiket_id" class="form-control">
                    <div class="form-group">
                        <label for="keluhan">Keluhan</label>
                        <input type="text" id="judul_tiket" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea name="tanggapan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar_tanggapan">Gambar Tanggapan</label>
                        <input type="file" name="gambar_tanggapan" id="gambar_tanggapan" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Reply Message</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_close_tiket">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apakah Tiket Ini Sudah Selesai ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tiket/save_close_tiket') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_tiket" id="closetiket" class="form-control">
                    <input type="hidden" name="sts_tiket" value="3" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Selesai</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '#select_tiket', function() {
            var id_tiket = $(this).data('id_tiket')
            var sts_tiket = $(this).data('sts_tiket')

            $('#id_tiket').val(id_tiket)
            $('#sts_tiket').val(sts_tiket)
        });

        $(document).on('click', '#reply_message', function() {
            var tiket_id = $(this).data('tiket_id')
            var id_tiket_id = $(this).data('id_tiket_id')
            var judul_tiket = $(this).data('judul_tiket')
            var deskripsi = $(this).data('deskripsi')

            $('#tiket_id').val(tiket_id)
            $('#id_tiket_id').val(id_tiket_id)
            $('#judul_tiket').val(judul_tiket)
            $('#deskripsi').val(deskripsi)
        });

        $(document).on('click', '#ctiket', function() {
            var closetiket = $(this).data('closetiket');
            var sts_tiket = $(this).data('sts_tiket');

            $('#closetiket').val(closetiket);
            $('#closestatus').val(sts_tiket);
        });

    })
</script>