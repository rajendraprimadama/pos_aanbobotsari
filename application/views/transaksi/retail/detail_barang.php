<?php 
$b = $brg->row_array();
?> 
<table>
    <input type="hidden" name="v_id_barang_retail" id="v_id_barang_retail" value="<?php echo $b['id_brg']; ?>">
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
        <td><select class="form-control SelectSatuan v_satuan_retail" name="v_satuan_retail" id="v_satuan_retail" data-category="retail">
            <option value="PCS" data-harga="<?php echo $b['pcs_hrgjual_retail']; ?>">PCS</option>
            <option value="RTG" data-harga="<?php echo $b['renteng_hrgjual_retail']; ?>">RTG</option>
            <option value="PAX" data-harga="<?php echo $b['pax_hrgjual_retail']; ?>">PAK</option>
            <option value="DUS" data-harga="<?php echo $b['dus_hrgjual_retail']; ?>">DUS</option>
        </select></td>
        <td>
            <input type="text" name="v_hrg_jual_retail" id="v_hrg_jual_retail" value="<?php echo number_format($b['pcs_hrgjual_retail']);?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm v_hrg_jual_retail" readonly>
        </td>
        <td>
            <input type="number" name="v_qty_retail" id="v_qty_retail" value="1" min="1" class="form-control input-sm AddBarang v_qty_retail" style="width:90px;margin-right:5px;" data-category="retail" required>
        </td>
        <td><button type="button" class="btn btn-sm btn-primary btn-act" data-action="add-cart" data-category="retail">Ok</button></td>
    </tr>
</table>