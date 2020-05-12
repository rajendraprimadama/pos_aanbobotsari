<div class="header-barang">
    <table>
        <tr>
            <th>Kode Barcode</th>
            <th>Nama Barang</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="v_kode_barang_retail" id="v_kode_barang_retail" class="form-control input-sm fontKeyUp onlyNumber v_kode_barang_retail barcodeScan" data-category="retail">
            </th>
            <th>
                <select class="form-control form-control-sm select2-search SearchBarang v_nama_barang_retail" id="v_nama_barang_retail" name="v_nama_barang_retail" data-category="retail" style="width:380px;margin-right:5px;">
                    <option value='' disabled selected>-- Select --</option>
                </select>
            </th>
        </tr>

        <!-- untuk appent detail transaksi -->
        <div id="detail_barang_retail" style="position:absolute;">
        </div>
    </table>
</div>