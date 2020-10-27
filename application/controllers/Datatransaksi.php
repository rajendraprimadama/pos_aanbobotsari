<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatransaksi extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_dtransaksi');
		$this->load->model('M_barang');
		$this->load->model('M_penjualan');
	}

	public function index() {
        $data['userdata'] = $this->userdata;
        if ($this->input->get('term', TRUE) != "") {
			$suggestions = $this->M_barang->get_item_search_suggestions($this->input->get('term'),"15");
			echo implode("\n",$suggestions);
		}
		$data['page'] = "Datatransaksi";
		$data['judul'] = "Data Transaksi";
		$data['deskripsi'] = "Manage Data Transaksi";
//home transaksi
		$this->load->view('transaksi/home', $data);
    }

    function get_barang(){
        $isKode = $this->input->post('kode_brg');
        $isCategory = $this->input->post('category');
		$data['brg'] = $this->M_barang->get_barang($isKode);
		$barang = (object)$data['brg']->row_array();
		
		$respon = [
			"exist" => property_exists($barang,'id_brg'),
			"content" => $this->load->view('transaksi/'.$isCategory.'/detail_barang',$data, true),
			"nama_brg" => property_exists($barang,'nama_brg') ? $barang->nama_brg : '',
			"id_brg" => property_exists($barang,'id_brg') ? $barang->id_brg : ''
		];

		echo json_encode($respon);	
	}

	function get_barang_by_id(){
        $isId = $this->input->post('id_brg');
		$isCategory = $this->input->post('category');
		$data['brg']=$this->M_barang->get_barang_id($isId);
		$barang = (object)$data['brg']->row_array();
		
		$respon = [
			"content" => $this->load->view('transaksi/'.$isCategory.'/detail_barang',$data, true),
			"barcode" => property_exists($barang,'barcode_brg') ? $barang->barcode_brg : ''
		];

		echo json_encode($respon);	
	}

	function add_to_cart(){
		$isCategory = $this->input->post('category');
		$kobar=$this->input->post('kode_brg');
		$produk=$this->M_barang->get_barang_id($kobar);
		$i=$produk->row_array();

		#filter harga beli
		$satuan = strtolower($this->input->post('satuan'));
		if($satuan=="rtg"){
			$satuan="renteng";
		}
		$harga_beli = $i['hrg_beli_'.$satuan];
		$data = [
			'id'       => $i['id_brg'].'-'.$this->input->post('satuan'),
			'category' => $isCategory,
			'name'     => $i['nama_brg'],
			'satuan'   => $this->input->post('satuan')=="PAX" ? "PAK" : $this->input->post('satuan'),
			'harpok'   => $harga_beli,
			'price'    => str_replace(",", "", $this->input->post('hrg_jual')),
			'qty'      => $this->input->post('qty'),
			'amount'	  => str_replace(",", "", $this->input->post('hrg_jual'))
		];

		$this->cart->insert($data);
		$this->load->view('transaksi/'.$isCategory.'/list_barang');
	}

	function remove(){
		$isCategory = $this->input->post('category');
		$id = $this->input->post('id');
		$this->cart->update(array(
			'rowid'      => $id,
			'qty'     => 0,
			'subtotal'  => 0
		));
		$this->load->view('transaksi/'.$isCategory.'/list_barang');
	}

	function update_qty(){
		$isCategory = $this->input->post('category');
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$harga = $this->input->post('harga');
		$this->cart->update(array(
			'rowid'      => $id,
			'qty'     => $qty,
			'subtotal'  => $harga * $qty
		));

		$this->load->view('transaksi/'.$isCategory.'/list_barang');
	}

	function simpan_penjualan(){
		$category = $this->input->post('category');
		$total = str_replace(",", "",$this->input->post('v_total_bayar_'.$category));
		$jml_uang = str_replace(",", "", $this->input->post('v_jml_bayar_'.$category));
		$kembalian = (float)$jml_uang - (float)$total;

		if(!empty($total) && !empty($jml_uang) && (float)$total > 0 && (float)$jml_uang > 0){
			if((float)$kembalian < 0){
				$respon = [
					'respon' => 'error',
					'message' => 'Jumlah Uang yang anda masukan Kurang!'
				];

			}else{
				$nofak = $this->M_penjualan->get_nofak();
				$order_proses = $this->M_penjualan->simpan_penjualan($nofak,$total,$jml_uang,$kembalian,$category);
				$data['datatransaksi'] = $this->M_penjualan->cetak_faktur($nofak);
				$data['userdata'] = $this->userdata;
				if($order_proses){
					$this->cart->destroy();

					$respon = [
						'respon' => 'success',
						'message' => 'Berhasil bayar',
						'url' => base_url('Datatransaksi'),
						'id_transaksi' => $nofak
					];
					
				}else{
					$respon = [
						'respon' => 'error',
						'message' => 'Gagal transaksi'
					];
				}
			}

		}else{
			$respon = [
				'respon' => 'error',
				'message' => 'Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!'
			];
		}

		echo json_encode($respon);
	}

	function print_nota(){
		$param = $this->uri->segment(3);
		// $data['header_transaksi'] = $this->M_penjualan->header_transaksi($param);
		$data['datatransaksi'] = $this->M_penjualan->cetak_faktur($param);
		$data['userdata'] = $this->userdata;

		$this->load->view('transaksi/nota', $data);
	}

	function reset_cart(){
		$isCategory = $this->input->post('category');
		$this->cart->destroy();
		
		$this->load->view('transaksi/'.$isCategory.'/list_barang');
	}
}