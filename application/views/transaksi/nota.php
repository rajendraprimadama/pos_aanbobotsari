
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Nota Penjualan</title>
    <style type="text/css">
      @page {
        size: auto;
        margin: 0;
        margin-top: 0;
        padding: 0;
        height:0px !important;
    }
    * {
        font-size: 18px;
        font-family: 'Calibri';
    }

    td,
    th,
    tr,
    table {
        /* border-top: 1px solid black; */
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 60%;
        max-width: 60%;
    }

    td.quantity,
    th.quantity {
        width: 8%;
        max-width: 8%;
        word-break: break-all;
    }

    td.price,
    th.price {
        width: 22%;
        max-width: 22%;
        word-break: break-all;
        /* margin-left: 20px; */
        text-align: right;
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 350px;
        max-width: 300px;
    }


</style>
</head>
<?php 
$b=$datatransaksi->row_array();
?>
<body>
    <div class="ticket" style="margin-top: 0px">
       <!--  <img src="./logo.png" alt="Logo"> -->
       <p class="centered" style="font-size: 19px">Toko <strong>AAN</strong> Bobotsari
        <br>(Grosir dan Ecer)
        <br><strong>No tlp</strong> 081804862182
        <br><strong>No wa</strong> 085701621774    </p>
        <table>
            <thead>
                <tr>
                    <td class="text-right" colspan="100%"><b>Tgl.</b> <?php echo date('d M Y H:i:s'); ?></td>
                </tr>
                <tr>
                    <td class="text-left"><?php echo $b['jual_nofak'];?></td>
                    <td colspan="3" style="text-align: right"><b>Kasir:</b> <?php echo ucfirst($userdata->nama); ?></td>
                </tr>
                <tr style="border-top: 1px solid black">
                    <th class="description"></th>
                    <th class="quantity"></th>
                    <th class="quantity"></th>
                    <th class="price"></th>
                </tr>
                <tr style="border-top: 1px solid black">
                    <th class="description"></th>
                    <th class="quantity"></th>
                    <th class="quantity"></th>
                    <th class="price"></th>
                </tr>
                <tr style="border-bottom: 10px solid white">
                    <th class="description"></th>
                    <th class="quantity"></th>
                    <th class="quantity"></th>
                    <th class="price"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=0;
                foreach ($datatransaksi->result_array() as $i) {
                    $no++;

                    $nabar=$i['d_jual_barang_nama'];
                    $satuan=$i['d_jual_barang_satuan'];

                    $harjul=$i['d_jual_barang_harjul'];
                    $qty=$i['d_jual_qty'];
                    $diskon=$i['d_jual_diskon'];
                    $total=$i['d_jual_total'];
                    ?>
                    <tr>
                        <td class="description"><?php echo $nabar;?></td>
                        <td class="quantity"><?php echo $qty;?></td>
                        <td class="satuan"><?php echo $satuan;?></td>
                        <td class="price"><?php echo number_format($total);?></td>
                    </tr>
                <?php }?>
            </tbody>
            <tfoot>
                <tr style="border-top: 1px solid black">
                    <th class="description"></th>
                    <th class="quantity"></th>
                    <th class="quantity"></th>
                    <th class="price"></th>
                </tr>
                <tr style="border-top: 1px solid black">
                    <th class="description"></th>
                    <th class="quantity"></th>
                    <th class="quantity"></th>
                    <th class="price"></th>
                </tr>
                <tr class="total">
                    <td class="description"><b>Total</b></td>
                    <td class="quantity"></td>
                    <td class="satuan"></td>
                    <td class="price"><b><?php echo number_format($b['jual_total']);?></b></td>
                </tr>
                <tr>
                    <td class="description"><b>Bayar</b></td>
                    <td class="quantity"></td>
                    <td class="satuan"></td>
                    <td class="price"><b><?php echo number_format($b['jual_jml_uang']);?></b></td>
                </tr>
                <tr>
                    <td class="description"><b>Kembalian</b></td>
                    <td class="quantity"></td>
                    <td class="satuan"></td>
                    <td class="price"><b><?php echo number_format($b['jual_kembalian']);?></b></td>
                </tr>
            </tfoot>
        </table>
        <p class="centered">Terimakasih atas kunjunganya!
            <br></p>
        </div>
    </body>
    <script type="text/javascript">
    //     window.onload = function(){
    //       window.print();
    //       //window.location.href = '<?php echo base_url(); ?>Datatransaksi';
    //       window.onafterprint = function(e){
    //         closePrintView();
    //     };
    //     function closePrintView() {
    //         window.location.href = '<?php echo base_url(); ?>Datatransaksi';   
    //     }
    // };
</script>
</html>