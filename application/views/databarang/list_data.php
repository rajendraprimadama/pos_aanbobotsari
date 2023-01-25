<?php
  $no = 1;
  foreach ($dataBarang as $data_barang) {
    ?>
    <tr>
      <td class="text-center"><strong><?php echo $no; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->barcode_brg; ?></strong></td>
      <td class="text-left"><strong><?php echo $data_barang->nama_brg; ?></strong></td>
      <td class="text-left"><strong><?php echo $data_barang->kategori; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->hrg_beli_pcs; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->hrg_beli_renteng; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->hrg_beli_pax; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->hrg_beli_dus; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->pcs_hrgjual_retail; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->renteng_hrgjual_retail; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->pax_hrgjual_retail; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->dus_hrgjual_retail; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->pcs_hrgjual_grosir; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->renteng_hrgjual_grosir; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->pax_hrgjual_grosir; ?></strong></td>
      <td class="text-center"><strong><?php echo $data_barang->dus_hrgjual_grosir; ?></strong></td>
      <td><strong><?php echo $data_barang->keterangan; ?></strong></td>
      <td class="text-center">
        <div class="btn-group" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item update-dataBarang" data-id="<?php echo $data_barang->id; ?>"><i class="glyphicon glyphicon-repeat text-info"></i> Update</a></li>
              <li role="separator" class="divider"></li>
              <li><a class="dropdown-item konfirmasiHapus-barang" data-id="<?php echo $data_barang->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign text-danger"></i> Delete</a></li>
            </ul>
          </div>
        </div>
      </td>
    </tr>
    <?php
    $no++;
  }
?>