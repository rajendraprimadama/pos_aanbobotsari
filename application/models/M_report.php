<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_report extends CI_Model {
    function getDataPenjualan($param){
        $startDate = $param['startdate'];
        $endDate = $param['enddate'];
        $pelanggan = $param['pelanggan'];
        
        $where_pelanggan = "";
        if (!empty($pelanggan)) {
            // Menggunakan escape untuk keamanan dari SQL Injection
            $where_pelanggan = " AND data_jual.id_pelanggan = " . $this->db->escape($pelanggan);
        }

        // 2. Masukkan variabel $where_pelanggan ke dalam query
        $query = $this->db->query("
                                    SELECT
                                        `data_jual`.`jual_nofak` AS NO_Transaksi,
                                        `data_jual`.`jual_tanggal` AS DATE,
                                        SUM(`data_detail_jual`.`d_jual_qty`) AS Qty,
                                        SUM(`data_detail_jual`.`d_jual_barang_harpok`) AS Total_HargaBeli,
                                        `data_jual`.`jual_total` AS Total_HargaJual,
                                        `data_jual`.`jum_modal` AS Modal,
                                        `data_jual`.`jum_keuntungan` AS Keuntungan,
                                        `data_jual`.`jual_keterangan` AS Keterangan,
                                        `data_jual`.`jum_point` AS jum_point,
                                        `data_pelanggan`.`nama` AS pelanggan_nama
                                    FROM `data_jual`
                                    INNER JOIN `data_detail_jual`
                                    ON `data_jual`.`jual_nofak` = `data_detail_jual`.`d_jual_nofak`
                                    LEFT JOIN data_pelanggan 
                                    ON data_jual.id_pelanggan = data_pelanggan.id
                                    WHERE DATE(`data_jual`.jual_tanggal) BETWEEN '".date('Y-m-d',strtotime($startDate))."' AND '".date('Y-m-d',strtotime($endDate))."'
                                    $where_pelanggan
                                    GROUP BY `data_detail_jual`.`d_jual_nofak`
                                    ORDER BY `data_jual`.jual_tanggal DESC
                                ");

        return $query->result();
    }
    
    function getDetailTransaksi($param){
        $query = $this->db->query("
                                    SELECT 
                                        `data_jual`.`jual_nofak` AS NO_Transaksi, 
                                        `data_jual`.`jual_tanggal` AS DATE,
                                        `data_detail_jual`.`d_jual_barang_id` AS ID_Barang,
                                        `data_detail_jual`.`d_jual_barang_nama` AS Nama_Barang,
                                        `data_detail_jual`.`d_jual_barang_satuan` AS Satuan,
                                        `data_detail_jual`.`d_jual_qty` AS Qty,
                                        `data_detail_jual`.`d_jual_barang_harpok` AS Harga_Beli,
                                        `data_detail_jual`.`d_jual_barang_harjul` AS Harga_Jual,
                                        `data_detail_jual`.`d_jual_total` AS Total,
                                        `data_jual`.`jual_keterangan` AS Keterangan
                                    FROM `data_detail_jual`
                                    INNER JOIN `data_jual` 
                                    ON `data_detail_jual`.`d_jual_nofak`  = `data_jual`.`jual_nofak`
                                    WHERE `data_jual`.`jual_nofak` = '".$param."'
                                    ORDER BY `data_detail_jual`.d_jual_id DESC
                                ");

        return $query->result();
    }
}