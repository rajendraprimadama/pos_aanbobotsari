<script type="text/javascript">
    $(document).ready(function(){
        _page.init();
        $('.barcodeScan').focus();
    });

    const _page = {
        init: () => {
            $('.SearchBarang').each(function() {
                if (!$(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2({
                        ajax: {
                            url: `<?php echo base_url(); ?>Autocomplete`,
                            dataType: 'json',
                            data: params => ({ Search: params.term }),
                            processResults: data => ({
                                results: $.map(data, item => ({ text: item.nama_brg, id: item.id_brg }))
                            }),
                            cache: true,
                        },
                        minimumInputLength: 3,
                        placeholder: "Cari nama barang"
                    });
                }
            });

            // Inisialisasi Pelanggan (Retail & Grosir)
            $('.v_pelanggan_retail, .v_pelanggan_grosir').each(function() {
                if (!$(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2({
                        ajax: {
                            url: `<?php echo base_url(); ?>Autocomplete/pelanggan`,
                            dataType: 'json',
                            data: params => ({ Search: params.term }),
                            processResults: data => ({
                                results: $.map(data, item => ({ text: item.nama, id: item.id }))
                            }),
                            cache: true,
                        },
                        minimumInputLength: 3,
                        placeholder: "Cari pelanggan"
                    });
                }
            });
        },

        submit: () => {
            $('#formAction_retail').submit(function(e) {
                var data = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url().'Datatransaksi/simpan_penjualan'?>',
                    data: data,
                    beforeSend: function(){
                        myLoad('start','#formAction_retail');
                    }
                })
                .done(function(data) {
                    myLoad('end','#formAction_retail');
                    respon = JSON.parse(data);
                    if(respon.respon == "error") {
                        myAlert('warning',respon.message);
                    }
                    else {
                        //myAlert('success',respon.message, respon.url);
                        location.replace("<?php echo base_url(); ?>Datatransaksi/print_nota/"+respon.id_transaksi);
                    }
                })
                e.preventDefault();
            });

            $('#formAction_grosir').submit(function(e) {
                var data = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '<?php echo base_url().'Datatransaksi/simpan_penjualan'?>',
                    data: data,
                    beforeSend: function(){
                        myLoad('start','#formAction_grosir');
                    }
                })
                .done(function(data) {
                    myLoad('end','#formAction_grosir');
                    respon = JSON.parse(data);
                    if(respon.respon == "error") {
                        myAlert('warning',respon.message);
                    }
                    else {
                        //myAlert('success',respon.message, respon.url);
                        location.replace("<?php echo base_url(); ?>Datatransaksi/print_nota/"+respon.id_transaksi);
                    }
                })
                e.preventDefault();
            });
        }
    }

    const _logic = {
        app: (element) => {
            switch ($(element).attr('data-action')){
                case 'remove-barang':
                    let category = $(element).attr('data-category');
                    let id = $(element).attr('data-index');
                    $.ajax({
                        method: "POST",
                        url: "<?php echo base_url('Datatransaksi/remove'); ?>",
                        data: {
                            'category': category,
                            'id': id
                        }
                    })
                    .done(function(data) {
                        $(`.content-list-barang-${category}`).empty().html(data);
                        masking();
                        _page.init();
                        _page.submit();
                    })
                    break;

                case 'add-cart':
                    _logic.cart(element);
                    break;

                case 'reset':
                    _logic.reset_cart(element);
                    break;

                case 'quantityChange':
                    _logic.quantityChangebyButton(element);
                    break;

                default:
                    myAlert('warning','Action not declared');
                    break;
            }
        },

        barcode: (element) => {
            let category = $(element).attr('data-category');
            let kode_brg = $(`.v_kode_barang_${category}`).val();

            if(kode_brg.length >= 5) {
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'Datatransaksi/get_barang';?>",
                    data: {
                        'kode_brg': kode_brg,
                        'category': category
                    },
                    success: function(msg){
                        respon = JSON.parse(msg);

                        if (respon.exist) {
                            let content = `<option value="${respon.id_brg}" selected>${respon.nama_brg}</option>`;
                            $(`#v_nama_barang_${category}`).empty().html(content);
                            $(`#detail_barang_${category}`).empty().html(respon.content);
                            $(`#v_satuan_${category}`).focus();
                            _page.init();
                            
                        }
                        else {
                            $(`#v_kode_barang_${category}`).val('').focus();
                            myAlert('warning', 'Data tidak ditemukan');
                        }
                    }
                });
            }
        },

        SearchBarang: (element) => {
            let category = $(element).attr('data-category');
            let id_brg = $(`.v_nama_barang_${category}`).val();

            $.ajax({
                type: "POST",
                url : "<?php echo base_url().'Datatransaksi/get_barang_by_id';?>",
                data: {
                    'id_brg': id_brg,
                    'category': category
                },
                success: function(msg){
                    respon = JSON.parse(msg);

                    $(`#detail_barang_${category}`).empty().html(respon.content);
                    $(`#v_kode_barang_${category}`).val(respon.barcode);
                    _page.init();
                }
            });
        },

        satuan: (element) => {
            let category = $(element).attr('data-category');
            let harga =  $(`.v_satuan_${category}`).find(':selected').attr('data-harga');

            $(`#v_hrg_jual_${category}`).val(FormatNumber(harga))
        },

        cart: (element) => {
            let category = $(element).attr('data-category');
            let id = $(`#v_id_barang_${category}`).val();
            let nama_brg = $(`#v_nama_brg_${category}`).val();
            let satuan = $(`#v_satuan_${category}`).val();
            let qty = $(`#v_qty_${category}`).val();
            let hrg_jual = $(`#v_hrg_jual_${category}`).val();

            if (qty > 0) {
                let kobar = {
                    'category': category,
                    'kode_brg': id,
                    'nama_brg': nama_brg,
                    'satuan': satuan,
                    'qty': qty,
                    'hrg_jual': hrg_jual
                };
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'Datatransaksi/add_to_cart';?>",
                    data: kobar,
                    success: function(msg){
                        $(`.content-list-barang-${category}`).empty().html(msg);
                        $(`#v_kode_barang_${category}`).val('').focus();
                        $(`#v_nama_barang_${category} option`).remove();
                        $(`#detail_barang_${category}`).empty();
                        _logic.disabledTab(category);
                        masking();
                        _page.init();
                        _page.submit();
                    }
                });
            }
            else {
                myAlert('warning', 'Jumlah barang tidak boleh kosong');
                $(`#v_qty_${category}`).focus()
            }
        },

        calculate: (element) => {
            let category = $(element).attr('data-category');
            let jml_belanja = reform($(`#v_total_bayar_${category}`).val());
            let jml_bayar = reform($(`#v_jml_bayar_${category}`).val() ?? 0);
            let jml_diskon = reform($(`#v_jml_diskon_${category}`).val());
            let jml_packing = reform($(`#v_jml_packing_${category}`).val());
            let kembalian = (isNaN(parseFloat(jml_bayar)) ? 0 : parseFloat(jml_bayar)) - (parseFloat(jml_belanja) - (isNaN(parseFloat(jml_diskon)) ? 0 : parseFloat(jml_diskon)) + (isNaN(parseFloat(jml_packing)) ? 0: parseFloat(jml_packing)));
            let total_belanja = parseFloat(jml_belanja) - (isNaN(parseFloat(jml_diskon)) ? 0 : parseFloat(jml_diskon)) + (isNaN(parseFloat(jml_packing)) ? 0: parseFloat(jml_packing));
            

            $(`#v_jml_total_${category}`).val(FormatNumber(total_belanja));
            $(`#v_kembalian_${category}`).val(FormatNumber(kembalian));
        },

        updateQty: (element) => {
            let category = $(element).attr('data-category');
            let id = $(element).attr('data-index');
            let qty = $(`#v_list_qty_${category}.${id}`).val();
            // let harga = $(element).attr('data-harga');
            let harga = $(`#v_list_qty_${category}.${id}`).attr('data-harga');

            $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'Datatransaksi/update_qty';?>",
                    data: {
                        'category': category,
                        'id': id,
                        'qty': qty,
                        'harga': harga
                    },
                    success: function(msg){
                        $(`.content-list-barang-${category}`).empty().html(msg);
                        $(`#v_kode_barang_${category}`).val('').focus();
                        $(`#v_nama_barang_${category} option`).remove();
                        $(`#detail_barang_${category}`).empty();
                        masking();
                        _page.init();
                        _page.submit();
                    }
                });
        },
        
        reset_cart: (element) => {
            let category = $(element).attr('data-category');
            $.ajax({
                type: "POST",
                url : "<?php echo base_url().'Datatransaksi/reset_cart';?>",
                data: {
                    category: category
                },
                success: function(msg){
                    $(`.content-list-barang-${category}`).empty().html(msg);
                    $(`#v_kode_barang_${category}`).val('').focus();
                    $(`#v_nama_barang_${category} option`).remove();
                    $(`#detail_barang_${category}`).empty();
                    $('.tabKasir').removeClass('disabled').find('a').attr("data-toggle","tab");
                    masking();
                    _page.init();
                    _page.submit();
                }
            });
        },

        disabledTab: (param) => {
            if(param=="retail"){
                $('#tab2').addClass('disabled').find('a').removeAttr("data-toggle");
                $('#tab1').removeClass('disabled').find('a').attr("data-toggle","tab");
            }
            else {
                $('#tab1').addClass('disabled').find('a').removeAttr("data-toggle");
                $('#tab2').removeClass('disabled').find('a').attr("data-toggle","tab");
            }
        },

        quantityChangebyButton: (element) => {
            let forThis = $(element).attr('data-for');
            let category = $(element).attr('data-category');
            let index = $(element).attr('data-index');
            let isQty = forThis==="header" ? $(`#v_qty_${category}`).val() : $(`#v_list_qty_${category}.${index}`).val();

            if($(element).attr('data-type')=="minus"){
                if(parseInt(isQty)<=1){
                    myAlert('warning','Quantity harus lebih besar dari 0')
                }
                else {
                    if(forThis==="header"){
                        $(`#v_qty_${category}`).val(parseInt(isQty)-1);
                    }
                    else{
                        $(`#v_list_qty_${category}.${index}`).val(parseInt(isQty)-1).trigger('change');
                    }
                }
            }
            
            else if($(element).attr('data-type')=="plus"){
                if(forThis==="header"){
                    $(`#v_qty_${category}`).val(parseInt(isQty)+1);
                }
                else{
                    $(`#v_list_qty_${category}.${index}`).val(parseInt(isQty)+1).trigger('change');
                }
            }

        }
    }

    const _myEvent = (() => {
        $(document).on('keyup', '.barcodeScan', function(event){
            if (event.keyCode == 13) {
                _logic.barcode(this);
            }
        })

        $(document).on('change', '.SearchBarang', function(){
            _logic.SearchBarang(this);
        })

        $(document).on('change', '.SelectSatuan', function(){
            _logic.satuan(this);
        })

        $(document).on('keypress', '.SelectSatuan', function(event){
            if(event.which==13){
                event.preventDefault();
                $('.AddBarang').focus();
            }
        })

        $(document).on('keypress', '.AddBarang', function(event){
            if(event.which==13){
                _logic.cart(this);
            }
        })

        $(document).on('click', '.btn-act', function(){
            _logic.app(this);
        })
         
        $(document).on('keyup', '.calculate', function(){
            _logic.calculate(this);
        })

        $(document).on('change', '.changeQty', function(){
            _logic.updateQty(this);
        })        

        _page.submit();
    })();
</script>