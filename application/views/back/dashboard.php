<!-- Navbar -->

<!-- /.navbar -->
<div class="content-wrapper">
  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard <sup><?= $this->session->id_user; ?> </sup></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $tiket_wait ?></h3>

              <p> Menunggu Respon</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-half"></i>
            </div>
            <a href="<?= base_url('tiket') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $tiket_proses ?></h3>
              <p>Proses Pengerjaan</p>
            </div>
            <div class="icon">
              <i class="fa fa-paper-plane"></i>
            </div>
            <a href="<?= base_url('tiket') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $tiket_selesai ?></h3>

              <p>Tiket Success</p>
            </div>
            <div class="icon">
              <i class="fa fa-calendar-check"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $user ?></h3>

              <p>Karyawan</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?= base_url('karyawan') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->