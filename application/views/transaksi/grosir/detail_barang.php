<?php 
$b = $brg->row_array();
?> 
<table class="table">
    <input type="hidden" name="v_id_barang_grosir" id="v_id_barang_grosir" value="<?php echo $b['id_brg']; ?>">
    <tr>
        <th style="border-top: none !important; background-color:#FFFF00; font-size:15px">Satuan</th>
        <th style="border-top: none !important; background-color:#FFFF00; font-size:15px">Harga(Rp)</th>
        <th style="border-top: none !important; background-color:#FFFF00; font-size:15px" colspan="2">Jumlah</th>
    </tr>
    <tr>
        <td><select class="form-control form-control-sm SelectSatuan v_satuan_grosir" name="v_satuan_grosir" id="v_satuan_grosir" data-category="grosir">
            <option value="PCS" data-harga="<?php echo $b['pcs_hrgjual_grosir']; ?>">PCS</option>
            <option value="RT" data-harga="<?php echo $b['renteng_hrgjual_grosir']; ?>">RENTENG</option>
            <option value="PAX" data-harga="<?php echo $b['pax_hrgjual_grosir']; ?>">PAK</option>
            <option value="DUS" data-harga="<?php echo $b['dus_hrgjual_grosir']; ?>">DUS</option>
        </select></td>
        <td>
            <input type="text" name="v_hrg_jual_grosir" id="v_hrg_jual_grosir" value="<?php echo number_format($b['pcs_hrgjual_grosir']);?>" class="form-control input-sm v_hrg_jual_grosir" readonly>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-act" data-action="quantityChange" data-category="grosir" data-type="minus" data-for="header">
                        <i class="glyphicon glyphicon-minus"></i>
                    </button>
                </span>
                <input type="number" name="v_qty_grosir" id="v_qty_grosir" value="1" min="1" class="form-control input-sm AddBarang v_qty_grosir" style="width:90px;margin-right:5px;" data-category="grosir" required>
                <span class="input-group-btn">
                    <button class="btn btn-success btn-act" data-action="quantityChange" data-category="grosir" data-type="plus" data-for="header">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </span>
            </div>
        </td>
        <td style="width:20%">
            <button type="button" class="btn btn-sm btn-primary btn-act" data-action="add-cart" data-category="grosir" style="width:100%">Ok</button>
        </td>
    </tr>
</table>