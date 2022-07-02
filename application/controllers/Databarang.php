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
		// $data['dataBarang'] = $this->M_dbrg->select_all();
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

	public function get_data_user()
	{
		$list = $this->M_dbrg->get_datatables();
		$data = array();

		// print_r('<pre>');
		// print_r($list);
		// print_r('</pre>');
		// exit;

		$no = $_POST['start'] + 1;
		foreach ($list as $field) {
			$row = array();
			$row[] = $no;
			// $row[] = $field->id;
			// $row[] = $field->id_brg;
			$row[] = $field->barcode_brg;
			$row[] = $field->nama_brg;
			$row[] = $field->hrg_beli_pcs;
			$row[] = $field->hrg_beli_renteng;
			$row[] = $field->hrg_beli_pax;
			$row[] = $field->hrg_beli_dus;
			$row[] = $field->pcs_hrgjual_retail;
			$row[] = $field->renteng_hrgjual_retail;
			$row[] = $field->pax_hrgjual_retail;
			$row[] = $field->dus_hrgjual_retail;
			$row[] = $field->pcs_hrgjual_grosir;
			$row[] = $field->renteng_hrgjual_grosir;
			$row[] = $field->pax_hrgjual_grosir;
			$row[] = $field->dus_hrgjual_grosir;
			$row[] = $field->keterangan;
			$row[] = '<div class="btn-group" role="group" aria-label="...">
			<div class="btn-group" role="group">
			  <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="glyphicon glyphicon-cog"></i>
				<span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
				<li><a class="dropdown-item update-dataBarang" data-id="'.$field->id.'"><i class="glyphicon glyphicon-repeat text-info"></i> Update</a></li>
				<li role="separator" class="divider"></li>
				<li><a class="dropdown-item konfirmasiHapus-barang" data-id="'.$field->id.'" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign text-danger"></i> Delete</a></li>
			  </ul>
			</div>
		  </div>';
			
			$data[] = $row;

			$no++;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_dbrg->count_all(),
			"recordsFiltered" => $this->M_dbrg->count_filtered(),
			"data" => $data,
		);

		// print_r('<pre>');
		// print_r($output);
		// print_r('</pre>');
		// exit;
		echo json_encode($output);

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

	public function backup_sql()
	{
		$this->load->dbutil(); 
		$conf = [ 
			'format' => 'zip', 
			'filename' => 'backup_db.sql'
		];

		$backup = $this->dbutil->backup($conf); 
		$db_name = 'backup_db_' . date("d-m-Y_H-i-s") . '.zip'; 
		$save = APPPATH . 'database_backup/' . $db_name; 
		$this->load->helper('file'); 
		write_file($save, $backup); 
		$this->load->helper('download'); 
		force_download($db_name, $backup); 
	}
}
/* End of file Posisi.php */
/* Location: ./application/controllers/Posisi.php */