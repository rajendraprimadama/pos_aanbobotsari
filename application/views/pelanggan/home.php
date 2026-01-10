<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-12" style="padding: 0;">
      <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-pelanggan"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data Pelanggan</button>
    </div>
    
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead class="text-uppercase">
        <tr>
          <th class="text-center" width="5%">NO</th>
          <th class="text-center">Nama Pelanggan</th>
          <th class="text-center">Point</th>
          <th class="text-center" width="20%">Aksi</th>
        </tr>
      </thead>
      <!-- isi tabel merujuk pada asset/js/ajax.php dengan id data-barang-->
      <tbody id="data-pelanggan">

      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_pelanggan; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPelanggan', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Posisi';
  $data['url'] = 'Posisi/import';
  echo show_my_modal('modals/modal_import', 'import-posisi', $data);
?>

<script type="text/javascript">

	window.onload = function() {
		
		tampilPelanggan();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}
</script>