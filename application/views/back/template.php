<?php $this->load->view('back/template/meta'); ?>

    <?php $this->load->view('back/template/header'); ?>
    
    <?php $this->load->view('back/template/sidebar'); ?>
    <script src="<?= base_url() ?>assets/back/plugins/jquery/jquery.min.js"></script>
<?php echo $contents; ?>
    <?php $this->load->view('back/template/footer'); ?>


<!-- ./wrapper -->
<?php $this->load->view('back/template/script'); ?>