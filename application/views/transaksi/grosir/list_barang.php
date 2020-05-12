<?php $i = 1; ?>
<table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
    <thead>
    <tr>
        <th>Kode Barcode</th>
        <th>Nama Barang</th>
        <th style="text-align:center;">Satuan</th>
        <th style="text-align:center;">Harga(Rp)</th>
        <th style="text-align:center;">Qty</th>
        <th style="text-align:center;">Sub Total</th>
        <th style="width:100px;text-align:center;">Aksi</th>
    </tr>
    </thead> 
    <tbody>

    <?php 
    $isTotal = 0;
    if(count($this->cart->contents())*1>0):
    foreach ($this->cart->contents() as $items): 
        if($items['category'] == 'grosir'):
        echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <tr>
            <?php $isIndex = $items['rowid']; ?>
            <td><?=$items['id'];?></td>
            <td><?=$items['name'];?></td>
            <td style="text-align:center;"><?=$items['satuan'];?></td>
            <td style="text-align:right;"><?php echo $items['amount'] ? number_format($items['amount']) : 0;?></td>
            <td style="text-align:center;" width="10%">
                <input type="number" id="v_list_qty_grosir" value="<?php echo number_format($items['qty']); ?>" min="1" class="form-control input-sm changeQty <?php echo $isIndex ?>" data-category="grosir" data-index="<?php echo $isIndex ?>" data-harga="<?php echo $items['amount']; ?>">
            </td>
            <td style="text-align:right;"><?php echo number_format($items['subtotal']);?></td>
            <td style="text-align:center;">
                <button class="btn btn-danger btn-sm btn-act" data-action="remove-barang" data-category="grosir" data-index="<?php echo $isIndex ?>"><i class="fa fa-close"></i> Hapus</button>
            </td>
        </tr>
        
    <?php
    $i++; $isTotal += $items['subtotal'];
        endif;
    endforeach;
    else:
        ?>
        <tr><td class="text-center" colspan="100%">Tidak ada barang</td></tr>
        <?php
    endif;
    ?>
    </tbody>
</table>

<form method="post" id="formAction_grosir">
    <input type="hidden" name="category" value="grosir">
    <table>
    <tr>
        <td style="width:760px;" rowspan="2">
            <button type="submit" class="btn btn-info btn-lg"> Bayar</button>
            <button type="button" class="btn btn-danger btn-lg btn-act" data-action="reset" data-category="grosir"> Reset</button>
        </td>
        <th style="width:140px;">Total Belanja(Rp)</th>
        <th style="text-align:right;width:140px;">
        <input type="text" name="v_total_bayar_grosir" id="v_total_bayar_grosir" value="<?php echo number_format($isTotal);?>" class="form-control input-sm v_total_bayar_grosir" style="text-align:right;margin-bottom:5px;" readonly></th>
    </tr>
    <tr>
        <th>Tunai(Rp)</th>
        <th style="text-align:right;">
        <input type="text" id="v_jml_bayar_grosir" name="v_jml_bayar_grosir" class="v_jml_bayar_grosir form-control input-sm FormatKey calculate" data-category="grosir" style="text-align:right;margin-bottom:5px;" required></th>
    </tr>
    <tr>
        <td></td>
        <th>Kembalian(Rp)</th>
        <th style="text-align:right;">
        <input type="text" id="v_kembalian_grosir" name="v_kembalian_grosir" class="v_kembalian_grosir form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly required></th>
    </tr>

    </table>
</form>