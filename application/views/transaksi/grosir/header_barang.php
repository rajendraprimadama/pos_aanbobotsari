<div class="header-barang">
    <table>
        <tr>
            <th>Kode Barcode</th>
            <th>Nama Barang</th>
        </tr>
        <tr>
            <th>
                <input type="text" name="v_kode_barang_grosir" id="v_kode_barang_grosir" class="form-control input-sm fontKeyUp onlyNumber v_kode_barang_grosir barcodeScan" data-category="grosir">
            </th>
            <th>
                <select class="form-control form-control-sm select2-search SearchBarang v_nama_barang_grosir" id="v_nama_barang_grosir" name="v_nama_barang_grosir" data-category="grosir" style="width:380px;margin-right:5px;">
                    <option value='' disabled selected>-- Select --</option>
                </select>
            </th>
        </tr>

        <!-- untuk appent detail transaksi -->
        <div id="detail_barang_grosir" style="position:absolute;">
        </div>
    </table>
</div>