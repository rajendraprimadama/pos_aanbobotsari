<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autocomplete extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_dbrg');
		$this->load->model('M_pelanggan');
    }
    
    public function index() {
        $param 	= $this->input->get('Search');
        $result = $this->M_dbrg->getDataBarang($param);
        echo json_encode($result);
    }

    public function pelanggan() {
        $param 	= $this->input->get('Search');
        $result = $this->M_pelanggan->getPelanggan($param);
        echo json_encode($result);
    }
}