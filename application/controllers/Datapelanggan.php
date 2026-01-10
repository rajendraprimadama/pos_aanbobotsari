<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapelanggan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pelanggan');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataPelanggan'] = $this->M_pelanggan->select_all();
 		
		$data['page'] 		= "Pelanggan";
		$data['judul'] 		= "Data Pelanggan";
		$data['deskripsi'] 	= "Manage Data Pelanggan";

		$data['modal_tambah_pelanggan'] = show_my_modal('modals/modal_tambah_pelanggan', 'tambah-pelanggan', $data);

		$this->template->views('pelanggan/home', $data);
	}

	public function tampil() {
		$data['dataPelanggan'] = $this->M_pelanggan->select_all();
		$this->load->view('pelanggan/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('nama', 'Nama Pelanggan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pelanggan->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data pelanggan Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data pelanggan Gagal ditambahkan', '20px');
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
		$data['dataPelanggan'] = $this->M_pelanggan->select_by_id($id);

		echo show_my_modal('modals/modal_update_pelanggan', 'update-pelanggan', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('nama', 'Nama Pelanggan', 'trim|required');
		$this->form_validation->set_rules('point', 'Jumlah Point', 'trim|required|integer');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pelanggan->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data pelanggan Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data pelanggan Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_pelanggan->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data pelanggan Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data pelanggan Gagal dihapus', '20px');
		}
	}
}

/* End of file Posisi.php */
/* Location: ./application/controllers/Posisi.php */