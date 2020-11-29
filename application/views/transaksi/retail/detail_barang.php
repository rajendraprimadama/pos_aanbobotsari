<?php 
$b = $brg->row_array();
?> 
<table class="table">
    <input type="hidden" name="v_id_barang_retail" id="v_id_barang_retail" value="<?php echo $b['id_brg']; ?>">
    <tr>
        <th style="border-top: none !important; background-color:#98FB98; font-size:15px">Satuan</th>
        <th style="border-top: none !important; background-color:#98FB98; font-size:15px">Harga(Rp)</th>
        <th style="border-top: none !important; background-color:#98FB98; font-size:15px" colspan="2">Jumlah</th>
    </tr>
    <tr>
        <td>
            <select class="form-control form-control-sm SelectSatuan v_satuan_retail" name="v_satuan_retail" id="v_satuan_retail" data-category="retail">
                <option value="PCS" data-harga="<?php echo $b['pcs_hrgjual_retail']; ?>">PCS</option>
                <option value="RT" data-harga="<?php echo $b['renteng_hrgjual_retail']; ?>">RENTENG</option>
                <option value="PAX" data-harga="<?php echo $b['pax_hrgjual_retail']; ?>">PAK</option>
                <option value="DUS" data-harga="<?php echo $b['dus_hrgjual_retail']; ?>">DUS</option>
            </select>
        </td>
        <td>
            <input type="text" name="v_hrg_jual_retail" id="v_hrg_jual_retail" value="<?php echo number_format($b['pcs_hrgjual_retail']);?>" class="form-control input-sm v_hrg_jual_retail" readonly>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-act" data-action="quantityChange" data-category="retail" data-type="minus" data-for="header">
                        <i class="glyphicon glyphicon-minus"></i>
                    </button>
                </span>
                <input type="number" name="v_qty_retail" id="v_qty_retail" value="1" min="1" class="form-control input-sm AddBarang v_qty_retail" data-category="retail" required>
                <span class="input-group-btn">
                    <button class="btn btn-success btn-act" data-action="quantityChange" data-category="retail" data-type="plus" data-for="header">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                </span>
            </div>
        </td>
        <td style="width:20%">
            <button type="button" class="btn btn-sm btn-primary btn-act" data-action="add-cart" data-category="retail" style="width:100%">Ok</button>
        </td>
    </tr>
</table>