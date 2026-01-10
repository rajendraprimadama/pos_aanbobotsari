<?php
  $no = 1;
  foreach ($dataPelanggan as $data_pelanggan) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $data_pelanggan->nama; ?></td>
      <td class="text-center"><?php echo $data_pelanggan->point; ?></td>
      <td class="text-center">
        <button class="btn btn-warning update-dataPelanggan" data-id="<?php echo $data_pelanggan->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
        <button class="btn btn-danger konfirmasiHapus-pelanggan" data-id="<?php echo $data_pelanggan->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>