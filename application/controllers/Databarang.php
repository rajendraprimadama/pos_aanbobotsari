<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Databarang extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_dbrg');
		$this->load->model('M_kategori');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataBarang'] = $this->M_dbrg->select_all();
		$data['dataKategori'] = $this->M_kategori->select_all();
 		
		$data['page'] 		= "Databarang";
		$data['judul'] 		= "Data Barang";
		$data['deskripsi'] 	= "Manage Data Barang";

		$data['modal_tambah_barang'] = show_my_modal('modals/modal_tambah_barang', 'tambah-barang', $data);

		$this->template->views('databarang/home', $data);
	}

//function yg dipanggil oelh ajax.php melalui fungsi tampilBarang()
	public function tampil() {
		$data['dataBarang'] = $this->M_dbrg->select_all();
		$this->load->view('databarang/list_data', $data);
	}

	public function prosesTambah() {
		//'variable modal','dimunculkan di tampilan validasi','required'
		$this->form_validation->set_rules('v_namabrg', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('v_kategori', 'Kategori', 'trim|required');

		$data['dataKategori'] = $this->M_kategori->select_all();

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$isExist = $this->M_dbrg->isExistBarcode($this->input->post('v_barcode'));
			
			if($isExist) {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Barang sudah ada', '15px');
			} else {

				// if(((float) $this->saveInt($data['v_hrgbeli_pcs']) > (float) $this->saveInt($data['v_pcs_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_pcs']) > (float) $this->saveInt($data['v_pcs_hrgjual_grosir']))){
				// 	$out['status'] = '';
				// 	$out['msg'] = show_err_msg('Harga Jual PCS harus lebih besar dari harga beli', '15px');
				// }
				// else if(((float) $this->saveInt($data['v_hrgbeli_pax']) > (float) $this->saveInt($data['v_pax_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_pax']) > (float) $this->saveInt($data['v_pax_hrgjual_grosir']))){
				// 	$out['status'] = '';
				// 	$out['msg'] = show_err_msg('Harga Jual PAK harus lebih besar dari harga beli', '15px');
				// }
				// else if(((float) $this->saveInt($data['v_hrgbeli_renteng']) > (float) $this->saveInt($data['v_renteng_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_renteng']) > (float) $this->saveInt($data['v_renteng_hrgjual_grosir']))){
				// 	$out['status'] = '';
				// 	$out['msg'] = show_err_msg('Harga Jual RENTENG harus lebih besar dari harga beli', '15px');
				// }
				// else if(((float) $this->saveInt($data['v_hrgbeli_dus']) > (float) $this->saveInt($data['v_dus_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_dus']) > (float) $this->saveInt($data['v_dus_hrgjual_grosir']))){
				// 	$out['status'] = '';
				// 	$out['msg'] = show_err_msg('Harga Jual DUS harus lebih besar dari harga beli', '15px');
				// }
				// else {
					$result = $this->M_dbrg->insert($data);
					if ($result > 0) {
						$out['status'] = '';
						$out['msg'] = show_succ_msg('Data Barang Berhasil ditambahkan', '15px');
					} else {
						$out['status'] = '';
						$out['msg'] = show_err_msg('Data Barang Gagal ditambahkan', '15px');
					}
				// }
			}
			
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataBarang'] = $this->M_dbrg->select_by_id($id);
		$data['dataKategori'] = $this->M_kategori->select_all();

		echo show_my_modal('modals/modal_update_barang', 'update-barang', $data);
	}

	public function prosesUpdate() {
		//cek validasi sebelum data dikirim ke model M_dbrg function update
		// $this->form_validation->set_rules('v_namabrg', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('v_kategori', 'Kategori', 'trim|required');
		// $this->form_validation->set_rules('Hrgbeli', 'Harga Beli', 'trim|required');
		// $this->form_validation->set_rules('Hrgjual', 'Harga Jual', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {

			// if(((float) $this->saveInt($data['v_hrgbeli_pcs']) > (float) $this->saveInt($data['v_pcs_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_pcs']) > (float) $this->saveInt($data['v_pcs_hrgjual_grosir']))){
			// 	$out['status'] = '';
			// 	$out['msg'] = show_err_msg('Harga Jual PCS harus lebih besar dari harga beli', '15px');
			// }
			// else if(((float) $this->saveInt($data['v_hrgbeli_pax']) > (float) $this->saveInt($data['v_pax_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_pax']) > (float) $this->saveInt($data['v_pax_hrgjual_grosir']))){
			// 	$out['status'] = '';
			// 	$out['msg'] = show_err_msg('Harga Jual PAK harus lebih besar dari harga beli', '15px');
			// }
			// else if(((float) $this->saveInt($data['v_hrgbeli_renteng']) > (float) $this->saveInt($data['v_renteng_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_renteng']) > (float) $this->saveInt($data['v_renteng_hrgjual_grosir']))){
			// 	$out['status'] = '';
			// 	$out['msg'] = show_err_msg('Harga Jual RENTENG harus lebih besar dari harga beli', '15px');
			// }
			// else if(((float) $this->saveInt($data['v_hrgbeli_dus']) > (float) $this->saveInt($data['v_dus_hrgjual_retail'])) || ((float) $this->saveInt($data['v_hrgbeli_dus']) > (float) $this->saveInt($data['v_dus_hrgjual_grosir']))){
			// 	$out['status'] = '';
			// 	$out['msg'] = show_err_msg('Harga Jual DUS harus lebih besar dari harga beli', '15px');
			// }
			// else{
				$result = $this->M_dbrg->update($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Barang Berhasil diupdate', '15px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Barang Gagal diupdate', '15px');
				}
			// }
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_dbrg->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data Barang Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Barang Gagal dihapus', '20px');
		}
	}

	public function listBarang(){
		try {
			$data['userdata'] 	= $this->userdata;
			$data['dataBarang'] = $this->M_dbrg->select_all();
			$data['page'] = "Data Barang";

			$this->load->view('databarang/kasir/list_barang', $data);
		}
		catch (Exception $e) {
			throw $e;
		}
	}

	private function saveInt($param) {
		$hasil = '';

        if($param){
            $nilai  = trim(str_replace("`", "", $param));
            $hasil  = str_replace(",", "", $nilai);
        }
        else{
            $hasil = '0';
        }

        return $hasil;
	}
}
/* End of file Posisi.php */
/* Location: ./application/controllers/Posisi.php */