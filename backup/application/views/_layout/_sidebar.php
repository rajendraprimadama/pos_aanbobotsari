<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/profil1.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">LIST MENU</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'Kategori') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Datakategori'); ?>">
          <i class="fa fa-tasks"></i>
          <span>Kategori Barang</span>
        </a>
      </li>

      <li <?php if ($page == 'Databarang') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Databarang'); ?>">
          <i class="fa fa-suitcase"></i>
          <span>Data Barang</span>
        </a>
      </li>

      <!-- on development -->
      <?php if($userdata->authority_level == "DEVELOPER"){ ?>
        <li <?php if ($page == 'Datacustomer') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Datacustomer'); ?>">
            <i class="fa fa-group"></i>
            <span>Data Customer</span>
          </a>
        </li>

        <li <?php if ($page == 'Datasupplier') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Datasupplier'); ?>">
            <i class="fa fa-truck"></i>
            <span>Data Supplier</span>
          </a>
        </li>
        
        <li <?php if ($page == 'Datatransaksi') {echo 'class="active"';} ?>>
          <a href="<?php echo base_url('Datatransaksi'); ?>">
            <i class="fa fa-area-chart"></i>
            <span>Laporan</span>
          </a>
        </li>
      <?php } ?>

      <li <?php if ($page == 'Datakaryawan') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Datakaryawan'); ?>">
          <i class="fa fa-street-view"></i>
          <span>Data Karyawan</span>
        </a>
      </li>

      <li <?php if ($page == 'Datatransaksi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Datatransaksi'); ?>">
          <i class="fa fa-laptop"></i>
          <span>Penjualan</span>
        </a>
      </li>

<<<<<<< HEAD
      <li class="treeview <?php if ($page == 'Datareport/penjualan' || $page == 'Datareport/keuntungan') {echo 'active';} ?>">
=======
      <li class="treeview <?php if ($page == 'Datareport/penjualan' || $page == 'Datareport/keuntungan' || $page=='Datareport/transaksi') {echo 'active';} ?>">
>>>>>>> e028e507bf6ebc909ff7a577017c4df7014c3d5b
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($page == 'Datareport/penjualan'){ echo 'active'; } ?>">
              <a href="<?php echo base_url('Datareport/penjualan'); ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li class="<?php if($page == 'Datareport/keuntungan'){ echo 'active'; } ?>">
              <a href="<?php echo base_url('Datareport/keuntungan'); ?>"><i class="fa fa-circle-o"></i> Keuntungan</a></li>
          </ul>
        </li>
      <!-- end on development -->


    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>