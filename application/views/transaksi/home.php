<?php $this->load->view('_layout/_meta'); ?>
<?php $this->load->view('_layout/_css'); ?>
<?php $this->load->view('_layout/transaksi'); ?>

<div class="box skin-blue sidebar-mini sidebar-collapse" id="halaman">

    <div class="box-header" style="padding-top:0px">
        <div class="col-md-30">
            <section class="content">
                <div class="row">
                    <div class="col-md-30">
                        <?php $this->load->view('_layout/_header_transaksi'); ?>
                    </div>

                    <div class="col-md-30">
                        <!-- Custom Tabs -->
                        <script src="<?php echo base_url(); ?>assets/bootstrap/js/typeahead.min.js"></script>
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="tabKasir active" id="tab1" data-category="retail"><a href="#tab_1" data-toggle="tab">Jual Ecer</a></li>
                                <li class="tabKasir" id="tab2" data-category="grosir"><a href="#tab_2" data-toggle="tab">Jual Grosir</a></li>
                            </ul>
                            <div class="tab-content" style="padding-top:0px">
                                <div class="tab-pane tabKasir active" id="tab_1">
                                    <div class="header-barang">
                                        <?php $this->load->view('transaksi/retail/header_barang'); ?>
                                    </div>
                                    <hr>
                                    
                                    <div class="content-list-barang-retail">
                                        <?php $this->load->view('transaksi/retail/list_barang'); ?>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane tabKasir" id="tab_2">
                                    <div class="header-barang">
                                        <?php $this->load->view('transaksi/grosir/header_barang'); ?>
                                    </div>
                                    <hr>

                                    <div class="content-list-barang-grosir">
                                        <?php $this->load->view('transaksi/grosir/list_barang'); ?>
                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
            </section>
        </div>
    </div>
</div>

<!-- region js -->
<?php $this->load->view('transaksi/plugin'); ?>
<?php $this->load->view('_layout/_js'); ?>