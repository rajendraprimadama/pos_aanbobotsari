<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
	}
	
	public function index() {
		$session = $this->session->userdata('status');

		if ($session == '') {
			$this->load->view('login');
		} else {
			redirect('Databarang');
		}
	}

	public function login() {
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$data = $this->M_auth->login($username, $password);

			if ($data == false) {
				$this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
				redirect('Auth');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata($session);

				# check to reset data transaksi

				if(in_array(date('d'), ['1', '15'])) 
				{
					$is_tgl = date('Y-m-d');
					$check = $this->db->query('select * from log_delete_transaksi where DATE(created_date) = "'.$is_tgl.'"');
	
					// if (count($check->result()) <= 0) {
					if (count($check->result()) <= 0) {
	
						# select data
						$transaksi = $this->db->query('select * from data_jual where DATE(jual_tanggal) = "'.$is_tgl.'"')->result();
	
						$first = reset($transaksi);
						$last = end($transaksi);
	
						# insert into log
						$sql = "INSERT INTO log_delete_transaksi 
								(id_transaksi_mulai, id_transaksi_selesai, created_at) 
								VALUES(
								'" .$first->jual_nofak."',
								'" .$last->jual_nofak."',	
								'" .$data->id."'
								)";
	
						$this->db->query($sql);
	
						# delete
						$this->db->query('delete from log_delete_transaksi where DATE(created_date) < CURDATE()');
					}
				}

				if($data->authority_level == "KASIR") {
					redirect('Datatransaksi');
				}
				else {
					redirect('Databarang');
				}
			}
		} else {
			$this->session->set_flashdata('error_msg', validation_errors());
			redirect('Auth');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Auth');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */