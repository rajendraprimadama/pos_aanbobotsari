<script type="text/javascript">
    $(document).ready(function(){
        _page.init();
    });

    const _page = {
        init: () => {

            if(cekElement('#v_nama_barang_retail')){
                $('#v_nama_barang_retail').select2({
                    ajax: {
                        url: `<?php echo base_url(); ?>Autocomplete`,
                        dataType: 'json',
                        data: function (params) {
                            return {
                                Search: params.term
                            };
                        },
                        processResults: function (data, params) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text : `${item.nama_brg}`,
                                        id: item.id_brg,
                                    }
                                })
                            }
                        },
                        cache: true,
                    },
                    minimumInputLength: 3,
                    placeholder: "Cari nama barang"
                });
            }

            if(cekElement('#v_nama_barang_grosir')){
                $('#v_nama_barang_grosir').select2({
                    ajax: {
                        url: `<?php echo base_url(); ?>Autocomplete`,
                        dataType: 'json',
                        data: function (params) {
                            return {
                                Search: params.term
                            };
                        },
                        processResults: function (data, params) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text : `${item.nama_brg}`,
                                        id: item.id_brg,
                                    }
                                })
                            }
                        },
                        cache: true,
                    },
                    minimumInputLength: 3,
                    placeholder: "Cari nama barang"
                });
            }
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
                        myAlert('success',respon.message, respon.url);
                        window.open("<?php echo base_url(); ?>Datatransaksi/print_nota/"+respon.id_transaksi, '_blank');
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
                        myAlert('success',respon.message, respon.url);
                        window.open("<?php echo base_url(); ?>Datatransaksi/print_nota/"+respon.id_transaksi, '_blank');
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
                    })
                    break;

                case 'add-cart':
                    _logic.cart(element);
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
                        }
                        else {
                            $(`#v_kode_barang_${category}`).val('').focus();
                            myAlert('warning', 'Data tidak ditemukan');
                        }
                        console.log(kode_brg);
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
                        masking();
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
            let jml_bayar = reform($(`#v_jml_bayar_${category}`).val());
            let kembalian = parseFloat(jml_bayar) - parseFloat(jml_belanja);
            
            $(`#v_kembalian_${category}`).val(FormatNumber(kembalian));
        },

        updateQty: (element) => {
            let category = $(element).attr('data-category');
            let id = $(element).attr('data-index');
            let qty = $(`#v_list_qty_${category}`).val();
            let harga = $(element).attr('data-harga');

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
                        _page.submit();
                    }
                });
        }
    }

    const _myEvent = (() => {
        $(document).on('change', '.barcodeScan', function(){
            _logic.barcode(this);
        })

        $(document).on('change', '.SearchBarang', function(){
            _logic.SearchBarang(this);
        })

        $(document).on('change', '.SelectSatuan', function(){
            _logic.satuan(this);
        })

        $(document).on('keypress', '.SelectSatuan', function(event){
            if(event.which==13){
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