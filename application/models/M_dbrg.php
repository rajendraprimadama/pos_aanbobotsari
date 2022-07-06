<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dbrg extends CI_Model {
	var $table = 'data_barang'; //nama tabel dari database
    var $column_order = array(null, 'id_brg','barcode_brg','nama_brg','kategori',
	'hrg_beli_pcs','hrg_beli_renteng','hrg_beli_pax','hrg_beli_dus',
	'pcs_hrgjual_retail','renteng_hrgjual_retail','pax_hrgjual_retail','dus_hrgjual_retail',
	'pcs_hrgjual_grosir','renteng_hrgjual_grosir','pax_hrgjual_grosir','dus_hrgjual_grosir','keterangan'); //field yang ada di table user
    var $column_search = array('barcode_brg','nama_brg','kategori'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order

	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }





	# region old
	public function select_all() {
		// $data = $this->db->get('data_barang'); //merujuk database
		$sql = "SELECT data_barang.*, data_kategori.kategori AS kategori FROM data_barang INNER JOIN data_kategori on data_barang.kategori = data_kategori.id ORDER BY id DESC";
		// $sql = "SELECT * FROM data_barang ORDER BY id DESC LIMIT 1000";
		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM data_barang WHERE id = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO data_barang 
		(id_brg,barcode_brg,nama_brg,kategori,
		hrg_beli_pcs,hrg_beli_renteng,hrg_beli_pax,hrg_beli_dus,
		pcs_hrgjual_retail,renteng_hrgjual_retail,pax_hrgjual_retail,dus_hrgjual_retail,
		pcs_hrgjual_grosir,renteng_hrgjual_grosir,pax_hrgjual_grosir,dus_hrgjual_grosir,keterangan) 
		VALUES(
		'" .$this->generateID($data['v_namabrg'])."',
		'" .$data['v_barcode']."',	
		'" .$data['v_namabrg']."',
		'" .$data['v_kategori'] ."',
		'" .$this->saveInt($data['v_hrgbeli_pcs'])."',
		'" .$this->saveInt($data['v_hrgbeli_renteng'])."',
		'" .$this->saveInt($data['v_hrgbeli_pax'])."',
		'" .$this->saveInt($data['v_hrgbeli_dus'])."',
		'" .$this->saveInt($data['v_pcs_hrgjual_retail'])."',
		'" .$this->saveInt($data['v_renteng_hrgjual_retail'])."',
		'" .$this->saveInt($data['v_pax_hrgjual_retail'])."',
		'" .$this->saveInt($data['v_dus_hrgjual_retail'])."',
		'" .$this->saveInt($data['v_pcs_hrgjual_grosir'])."',
		'" .$this->saveInt($data['v_renteng_hrgjual_grosir'])."',
		'" .$this->saveInt($data['v_pax_hrgjual_grosir'])."',
		'" .$this->saveInt($data['v_dus_hrgjual_grosir'])."',
		'" .$data['v_keterangan']."'
		)";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('data_barang', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE data_barang SET 
					nama_brg='" . $data['v_namabrg'] ."',
					kategori='" .$data['v_kategori'] ."',
					hrg_beli_pcs='" .$this->saveInt($data['v_hrgbeli_pcs']) ."',
					hrg_beli_renteng='" .$this->saveInt($data['v_hrgbeli_renteng']) ."',
					hrg_beli_pax='" .$this->saveInt($data['v_hrgbeli_pax']) ."',
					hrg_beli_dus='" .$this->saveInt($data['v_hrgbeli_dus']) ."',
					pcs_hrgjual_retail='" .$this->saveInt($data['v_pcs_hrgjual_retail']) ."',
					renteng_hrgjual_retail='" .$this->saveInt($data['v_renteng_hrgjual_retail']) ."',
					pax_hrgjual_retail='" .$this->saveInt($data['v_pax_hrgjual_retail']) ."',
					dus_hrgjual_retail='" .$this->saveInt($data['v_dus_hrgjual_retail']) ."',
					pcs_hrgjual_grosir='" .$this->saveInt($data['v_pcs_hrgjual_grosir']) ."',
					renteng_hrgjual_grosir='" .$this->saveInt($data['v_renteng_hrgjual_grosir']) ."',
					pax_hrgjual_grosir='" .$this->saveInt($data['v_pax_hrgjual_grosir']) ."',
					dus_hrgjual_grosir='" .$this->saveInt($data['v_dus_hrgjual_grosir']) ."',
					keterangan = '".$data['v_keterangan']."'
				WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM data_barang WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nmbrg', $Namabarang);
		$data = $this->db->get('data_barang');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('data_barang');

		return $data->num_rows();
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

	private function generateID($param)
    {
        $generate_id = '';

		$param = str_replace(' ','',$param);
		$perix_param = substr($param,0,3);
		$sql = "SELECT id_brg FROM data_barang WHERE id_brg LIKE '%$perix_param%' order by id_brg DESC limit 1";
		$data = $this->db->query($sql);
		$result = $data->result();

		$last_id = isset($result[0]->id_brg) ? $result[0]->id_brg : false;
		
        if(!empty($last_id)){
			$new_id = substr($last_id, 3) + 1;
			$new_id = str_pad($new_id, 5, '0', STR_PAD_LEFT);
			$generate_id = $perix_param. $new_id;
        }
        else{
            $generate_id = $perix_param . '00001';
		}
		
        return $generate_id;
	}
	
	function getDataBarang($param){
        
        $query = $this->db->query("
                                    SELECT *    
                                    FROM `data_barang`
                                    WHERE nama_brg LIKE '%".$param."%'
                                    ORDER BY nama_brg ASC
                                ");

		return $query->result();
	}
	
	function isExistBarcode($param){
		try{

			$data = $this->db->where('barcode_brg',$param)->get('data_barang');

			if ($data->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}
		catch (Exception $e) {
			throw $e;
		}
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */