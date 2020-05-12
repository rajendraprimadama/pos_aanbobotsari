<?php
class M_penjualan extends CI_Model{

	function hapus_retur($kode){
		$hsl=$this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
		return $hsl;
	}

	function tampil_retur(){
		$hsl=$this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
		return $hsl;
	}

	function simpan_retur($kobar,$nabar,$satuan,$harjul,$qty,$keterangan){
		$hsl=$this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
		return $hsl;
	}

	function simpan_penjualan($nofak,$total,$jml_uang,$kembalian,$category){
		$idadmin = $this->userdata->nama;
		
		$this->db->query(
			"INSERT INTO data_jual 
			(jual_nofak,jual_total,jual_jml_uang,jual_kembalian,jual_user_id,jual_keterangan) 
			VALUES ('$nofak','$total','$jml_uang','$kembalian','$idadmin','$category')
			");

		$isModal = 0;
		foreach ($this->cart->contents() as $item) {
			if($item['category'] == $category) {
				$data=array(
					'd_jual_nofak' 			=>	$nofak,
					'd_jual_barang_id'		=>	substr($item['id'], 0, -4),
					'd_jual_barang_nama'	=>	$item['name'],
					'd_jual_barang_satuan'	=>	$item['satuan'],
					'd_jual_barang_harpok'	=>	$item['harpok'],
					'd_jual_barang_harjul'	=>	$item['amount'],
					'd_jual_qty'			=>	$item['qty'],
					'd_jual_diskon'			=>	0,
					'd_jual_total'			=>	$item['subtotal']
				);
				$isModal += $item['harpok']*$item['qty'];
				$this->db->insert('data_detail_jual',$data);
			}
		}
		$keuntungan = $total - $isModal;

		#update header
		$this->db->query(
			"UPDATE data_jual SET
			jum_modal = $isModal,
			jum_keuntungan = $keuntungan
			WHERE jual_nofak = $nofak
			");

		return true;
	}
	function get_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM data_jual WHERE DATE(jual_tanggal)=CURDATE()");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		return date('dmy').$kd;
	}

	function select_nota($nofak) {
		$sql = " SELECT 
		data_jual.jual_nofak AS id,
		data_detail_jual.d_jual_barang_nama AS nama, 
		data_detail_jual.d_jual_barang_satuan AS satuan,
		data_jual.jual_tanggal AS tanggal, 
		data_jual.jual_total AS total, 
		data_jual.jual_jml_uang AS bayar, 
		data_jual.jual_kembalian AS kembalian, 
		data_jual.jual_user_id AS user,
		data_detail_jual.d_jual_qty AS qty,
		data_detail_jual.d_jual_barang_harjul AS harjul
		FROM data_jual, data_detail_jual 
		WHERE data_jual.jual_nofak = data_detail_jual.d_jual_nofak and data_jual.jual_nofak='$nofak'";
		
		$data = $this->db->query($sql);
		return $data->result();
	}

	function cetak_faktur($nofak){
		$hsl=$this->db->query(
			"SELECT 
				jual_nofak,
				DATE_FORMAT(jual_tanggal,'%d/%m/%Y %H:%i:%s') AS jual_tanggal,
				jual_total,
				jual_jml_uang,
				jual_kembalian,
				jual_keterangan,

				d_jual_barang_nama,
				d_jual_barang_satuan,
				d_jual_barang_harjul,
				d_jual_qty,
				d_jual_diskon,
				d_jual_total 
			FROM data_jual 
			JOIN data_detail_jual 
			ON jual_nofak=d_jual_nofak 
			WHERE jual_nofak='$nofak'
		");

		return $hsl;
	}
	
}