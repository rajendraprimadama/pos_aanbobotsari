<?php $i = 1; ?>
<table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
    <thead>
    <tr>
        <th style="background-color:yellow">Kode Barcode</th>
        <th style="background-color:yellow">Nama Barang</th>
        <th style="text-align:center; background-color:yellow">Satuan</th>
        <th style="text-align:center; background-color:yellow">Harga(Rp)</th>
        <th style="text-align:center; background-color:yellow">Qty</th>
        <th style="text-align:center; background-color:yellow">Sub Total</th>
        <th style="width:100px;text-align:center; background-color:yellow">Aksi</th>
    </tr>
    </thead> 
    <tbody>

    <?php 
    $isTotal = 0;
    if(count($this->cart->contents())*1>0):
    foreach ($this->cart->contents() as $items):
        if($items['category'] == 'retail'):
        echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <tr>
            <?php $isIndex = $items['rowid']; ?>
            <td><?=$items['id'];?></td>
            <td><?=$items['name'];?></td>
            <td style="text-align:center;"><?=$items['satuan'];?></td>
            <td style="text-align:right;"><?php echo $items['amount'] ? number_format($items['amount']) : 0;?></td>
            <td style="text-align:center;" width="13%">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-act" data-action="quantityChange" data-category="retail" data-type="minus" data-index="<?php echo $isIndex ?>">
                            <i class="glyphicon glyphicon-minus"></i>
                        </button>
                    </span>
                    <input type="number" id="v_list_qty_retail" value="<?php echo number_format($items['qty']); ?>" min="1" class="form-control input-sm changeQty <?php echo $isIndex ?>" data-category="retail" data-index="<?php echo $isIndex ?>" data-harga="<?php echo $items['amount']; ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-act" data-action="quantityChange" data-category="retail" data-type="plus" data-index="<?php echo $isIndex ?>">
                            <i class="glyphicon glyphicon-plus"></i>
                        </button>
                    </span>
                </div>
            </td>
            <td style="text-align:right;"><?php echo number_format($items['subtotal']);?></td>
            <td style="text-align:center;">
                <button class="btn btn-danger btn-sm btn-act" data-action="remove-barang" data-category="retail" data-index="<?php echo $isIndex ?>"><i class="fa fa-close"></i> Hapus</button>
            </td>
        </tr>

    <?php
    $i++; $isTotal += $items['subtotal'];
        endif;
    endforeach;
    else:
        ?>
        <tr><td class="text-center text-muted" colspan="100%">Tidak ada barang</td></tr>
        <?php
    endif;
    ?>
    </tbody>
</table>

<form method="post" id="formAction_retail">
    <input type="hidden" name="category" value="retail">
    <table>
    <tr>
        <td style="width:760px;" rowspan="2">
            <button style="width:30%" type="submit" class="btn btn-info btn-lg"> Bayar</button>
            <button style="width:30%" type="button" class="btn btn-danger btn-lg btn-act" data-action="reset" data-category="retail"> Reset</button>
        </td>
        <th style="width:140px;">Total Belanja(Rp)</th>
        <th style="text-align:right;width:140px;">
        <input type="text" name="v_total_bayar_retail" id="v_total_bayar_retail" value="<?php echo number_format($isTotal);?>" class="form-control input-sm v_total_bayar_retail" style="text-align:right;margin-bottom:5px;" readonly></th>
    </tr>
    <tr>
        <th>Tunai(Rp)</th>
        <th style="text-align:right;">
        <input type="text" id="v_jml_bayar_retail" name="v_jml_bayar_retail" class="v_jml_bayar_retail form-control input-sm FormatKey calculate" data-category="retail" style="text-align:right;margin-bottom:5px;" required></th>
    </tr>
    <tr>
        <td></td>
        <th>Kembalian(Rp)</th>
        <th style="text-align:right;">
        <input type="text" id="v_kembalian_retail" name="v_kembalian_retail" class="form-control input-sm v_kembalian_retail" style="text-align:right;margin-bottom:5px;" readonly required></th>
    </tr>

    </table>
</form>