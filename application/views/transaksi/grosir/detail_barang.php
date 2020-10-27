<?php 
$b = $brg->row_array();
?> 
<table>
    <input type="hidden" name="v_id_barang_grosir" id="v_id_barang_grosir" value="<?php echo $b['id_brg']; ?>">

    <tr>
        <th style="width:200px;"></th>
        <th></th>
        <th>Satuan</th>
        <th>Harga(Rp)</th>
        <th>Jumlah</th>
    </tr>
    <tr>
        <td style="width:200px;"></td>
        <td style="width:380px;"></td>
        <td><select class="form-control SelectSatuan v_satuan_grosir" name="v_satuan_grosir" id="v_satuan_grosir" data-category="grosir">
            <option value="PCS" data-harga="<?php echo $b['pcs_hrgjual_grosir']; ?>">PCS</option>
            <option value="RTG" data-harga="<?php echo $b['renteng_hrgjual_grosir']; ?>">RTG</option>
            <option value="PAX" data-harga="<?php echo $b['pax_hrgjual_grosir']; ?>">PAK</option>
            <option value="DUS" data-harga="<?php echo $b['dus_hrgjual_grosir']; ?>">DUS</option>
        </select></td>
        <td>
            <input type="text" name="v_hrg_jual_grosir" id="v_hrg_jual_grosir" value="<?php echo number_format($b['pcs_hrgjual_grosir']);?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm v_hrg_jual_grosir" readonly>
        </td>
        <td>
            <input type="number" name="v_qty_grosir" id="v_qty_grosir" value="1" min="1" class="form-control input-sm AddBarang v_qty_grosir" style="width:90px;margin-right:5px;" data-category="grosir" required>
        </td>
        <td><button type="button" class="btn btn-sm btn-primary btn-act" data-action="add-cart" data-category="grosir">Ok</button></td>
    </tr>
</table>