<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {
	public function select_all() {
		$data = $this->db->get('data_pelanggan'); //merujuk database

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM data_pelanggan WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {

		$this->db->insert('data_pelanggan',[
			'nama' => $data['nama']
		]);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('data_pelanggan', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE data_pelanggan SET point='" .$data['point']."', nama = '" .$data['nama']."'
		 WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM data_pelanggan WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('data_pelanggan', $nama);
		$data = $this->db->get('data_pelanggan');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('data_pelanggan');

		return $data->num_rows();
	}

	function getPelanggan($param){
        
        $query = $this->db->query("
                                    SELECT *    
                                    FROM `data_pelanggan`
                                    WHERE nama LIKE '%".$param."%'
                                    ORDER BY nama ASC
                                ");

		return $query->result();
	}

	public function update_point_from_transaksi($id, $point) {
		$sql = "UPDATE data_pelanggan 
				SET point = point + " . (int)$point . " 
				WHERE id = " . $this->db->escape($id);

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */