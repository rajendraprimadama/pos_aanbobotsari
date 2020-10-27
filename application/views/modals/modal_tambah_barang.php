<form id="form-tambah-barang" method="POST">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-center text-bold">Tambah Data Barang</h3>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="input-group form-group">
                            <span class="input-group-addon" id="sizing-addon2">
                            <i class="glyphicon glyphicon-barcode"></i>
                            </span>
                            <input type="text" class="form-control onlyNumber v_barcode" placeholder="Barcode" name="v_barcode" id="v_barcode" aria-describedby="sizing-addon2" autofocus>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="input-group form-group">
                            <span class="input-group-addon" >Jenis</span>
                            <select id='kategori' name="v_kategori" style='width: 100%;' class="form-control">
                            <?php
                                foreach ($dataKategori as $key => $value) {
                            ?>
                                <option value='<?php echo $value->id; ?>'><?php echo $value->kategori;?></option>
                                <!--masih menyimpan value dari tabel kategori belum menyimpan id dari tabel kategori ke tabel barang-->
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="input-group form-group">
                    <span class="input-group-addon" id="sizing-addon2">
                        <i class="glyphicon glyphicon-folder-close"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Nama Barang" name="v_namabrg" aria-describedby="sizing-addon2">
                    </div>

                    <div class="form-group">
                    <fieldset>
                        <legend class="custom text-uppercase">Harga beli</legend>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group form-group bg-info">
                            <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-usd"></i> -->
                                PCS
                            </span>
                            <input type="text" class="form-control onlyNumber text-right v_hrgbeli_pcs" data-category="pcs" placeholder="0.00" name="v_hrgbeli_pcs" aria-describedby="sizing-addon2" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group form-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-usd"></i> -->
                                RTG
                            </span>
                            <input type="text" class="form-control onlyNumber text-right v_hrgbeli_renteng" data-category="renteng" placeholder="0.00" name="v_hrgbeli_renteng" aria-describedby="sizing-addon2" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group form-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-usd"></i> -->
                                PAK
                            </span>
                            <input type="text" class="form-control onlyNumber text-right v_hrgbeli_pax" data-category="pax" placeholder="0.00" name="v_hrgbeli_pax" aria-describedby="sizing-addon2" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group form-group">
                            <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-usd"></i> -->
                                DUS
                            </span>
                            <input type="text" class="form-control onlyNumber text-right v_hrgbeli_dus" data-category="dus" placeholder="0.00" name="v_hrgbeli_dus" aria-describedby="sizing-addon2" maxlength="10">
                            </div>
                        </div>
                        </div>
                    </fieldset>
                    </div>

                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <fieldset>
                            <legend class="custom text-uppercase">harga jual retail</legend>
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tag"></i> -->
                                PCS
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="pcs" placeholder="0.00" name="v_pcs_hrgjual_retail" aria-describedby="sizing-addon2" maxlength="10">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tag"></i> -->
                                RTG
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="renteng" placeholder="0.00" name="v_renteng_hrgjual_retail" aria-describedby="sizing-addon2" maxlength="10">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tag"></i> -->
                                PAK
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="pax" placeholder="0.00" name="v_pax_hrgjual_retail" aria-describedby="sizing-addon2" maxlength="10">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tag"></i> -->
                                DUS
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="dus" placeholder="0.00" name="v_dus_hrgjual_retail" aria-describedby="sizing-addon2" maxlength="10">
                            </div>
                            </fieldset>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <fieldset>
                            <legend class="custom text-uppercase">harga jual grosir</legend>
                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tags"></i> -->
                                PCS
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="pcs" placeholder="0.00" name="v_pcs_hrgjual_grosir" aria-describedby="sizing-addon2" maxlength="10">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tags"></i> -->
                                RTG
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="renteng" placeholder="0.00" name="v_renteng_hrgjual_grosir" aria-describedby="sizing-addon2" maxlength="10">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tags"></i> -->
                                PAK
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="pax" placeholder="0.00" name="v_pax_hrgjual_grosir" aria-describedby="sizing-addon2" maxlength="10">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-addon" id="sizing-addon2">
                                <!-- <i class="glyphicon glyphicon-tags"></i> -->
                                DUS
                                </span>
                                <input type="text" class="form-control onlyNumber text-right sell" data-category="dus" placeholder="0.00" name="v_dus_hrgjual_grosir" aria-describedby="sizing-addon2" maxlength="10">
                            </div>
                            </fieldset>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <textarea class="form-control v_keterangan" id="v_keterangan" name="v_keterangan" placeholder="Keterangan" rows="1"></textarea>
                    </div>

                    <div class="form-msg"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <div class="col-md-6">
            <button type="button" class="form-control btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
          </div>
          <div class="col-md-6">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Simpan</button>
          </div>
        </div>
    </div>
</form>

<!-- region js -->
<script type="text/javascript">
  $(document).ready(function(){

    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });

    $(document).on('change', '.v_hrgbeli_pcs', function(event){
        event.preventDefault();
        var arrObj = [
          'v_pcs_hrgjual_retail',
          'v_pcs_hrgjual_grosir',
        ];

        arrObj.forEach((item) => {
          $(`input[name=${item}]`).val('')
        })
    })

    $(document).on('change', '.v_hrgbeli_pax', function(event){
        event.preventDefault();
        var arrObj = [
          'v_pax_hrgjual_retail',
          'v_pax_hrgjual_grosir',
        ];

        arrObj.forEach((item) => {
          $(`input[name=${item}]`).val('')
        })
    })

    $(document).on('change', '.v_hrgbeli_dus', function(event){
        event.preventDefault();
        var arrObj = [
          'v_dus_hrgjual_retail',
          'v_dus_hrgjual_grosir',
        ];

        arrObj.forEach((item) => {
          $(`input[name=${item}]`).val('')
        })
    })

    $(document).on('change', '.sell', function(event){
      event.preventDefault();
      CheckSell(this) 
    })
  })

  const CheckSell = (param) => {
    let isCategory = $(param).attr('data-category');
    let buy = parseFloat(reform($(`input[name=v_hrgbeli_${isCategory}]`).val()))
    let sell = parseFloat(reform($(param).val()))
    
    if (buy==0 || buy.length==0) {
      myAlert('error',`Harga beli ${isCategory} tidak boleh kosong atau 0`)
      $(param).val('')
    }
    else {
      if (sell < buy) {
        myAlert('error',`Harga jual ${isCategory} tidak boleh lebih kecil dari harga beli ${isCategory}`)
        $(param).val('')
      }
    }
  }
</script>