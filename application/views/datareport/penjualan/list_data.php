<?php
    $no = 1;
    $isTotalHargaJual = 0;
    $isTotalPoint = 0;
    if(count($datatable)*1>0){
        foreach ($datatable as $key => $val) {
            ?>
                <tr>
                    <td class="text-center"><?php echo $no; ?></td>
                    <td class="text-center">
                        <a href="<?php echo base_url().'Datareport/detailTransaksi/'.$val->NO_Transaksi; ?>" target="_blank"><?php echo $val->NO_Transaksi; ?></a>
                    </td>
                    <td class="text-center"><?php echo date('d M Y',strtotime($val->DATE)); ?></td>
                    <td class="text-center text-uppercase"><?php echo $val->Keterangan; ?></td>
                    <td class="text-right"><?php echo $controller->FormatNumber($val->Total_HargaJual); ?></td>
                    <td class="text-right"><?php echo $val->jum_point; ?></td>
                    <td class="text-right"><?php echo $val->pelanggan_nama; ?></td>
                </tr>
            
            <?php 
                $isTotalHargaJual += $val->Total_HargaJual;
                $isTotalPoint += $val->jum_point;
                $no++;
        }
        ?>

        <tr>
            <td class="text-uppercase text-right" colspan="4"><strong>total</strong></td>
            <td class="text-uppercase text-right"><?php echo $controller->FormatNumber($isTotalHargaJual) ?></td>
            <td class="text-uppercase text-right"><?php echo $isTotalPoint ?></td>
            <td></td>
        </tr>
    <?php
    }
    else{
        ?>
        <tr>
            <td class="text-center text-uppercase" colspan="100%">No Data</td>
        </tr>
    <?php
    }
    ?>
?>