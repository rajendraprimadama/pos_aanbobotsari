<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Nota</title>
    
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="invoice-box" >
        <table cellpadding="0" cellspacing="0">
            <tr class="top" >
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <h3 style="width:100%; max-width:300px; size: 30px" >Penjualan</h3>
                                <!-- <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;"> -->
                            </td>
                            
                            <td>
                                <?php 
                                date_default_timezone_set('asia/jakarta');
                                echo date("j M Y G:i:s")."<br>";
                                $options = "";
                                foreach ($datatransaksi as $key => $value) {
                                    ?>
                                    <?php echo "No nota ".$key->jual_nofak."<br>"?>
                                    <?php echo "Kasir ".$key->jual_user_id;?>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>


            <tr class="heading">
                <td>

                </td>

                <td>

                </td>

                <td>

                </td>
                <td>

                </td>
            </tr>

            <tr class="details">
             <?php
             foreach ($datatransaksi as $dtransaksi) {
              ?>
              <td><?php echo $dtransaksi->nama; ?></td>
              <td ><?php echo $dtransaksi->qty; ?></td>
              <td ><?php echo "Rp " . number_format($dtransaksi->harjul, 0, ",", "."); ?></td>
              <?php
          }
          ?>
      </tr>

      <tr class="heading">
        <td>

        </td>

        <td>

        </td>
        <td>

        </td>
    </tr>

    <tr class="item">
        <td>
            Total Item
        </td>
        <?php
        foreach ($datatransaksi as $dtransaksi) {
            ?>
            <td><?php echo $dtransaksi->qty; ?></td>
            <?php
        }
        ?>
        <?php
        foreach ($datatransaksi as $dtransaksi) {
          ?>
          <td><?php echo "Rp " . number_format($dtransaksi->total, 0, ",", "."); ?></td>
          <?php
      }
      ?>
  </tr>
  <tr class="item">
    <td>
        Tunai
    </td>

    <td>

    </td> 
    <?php
    foreach ($datatransaksi as $dtransaksi) {
      ?>
      <td><?php echo "Rp " . number_format($dtransaksi->bayar, 0, ",", ".");?></td>
      <?php
  }
  ?>
</tr>

<tr class="item">
    <td>
       Kembalian
    </td>

    <td>

    </td> 
    <?php
    foreach ($datatransaksi as $dtransaksi) {
      ?>
      <td><?php echo "Rp " . number_format(((int)$dtransaksi->bayar-(int)$dtransaksi->total), 0, ",", ".");?></td>
      <?php
  }
  ?>
</tr>

</table>
</div>
</body>
</html>
