<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model {
	public function last($table, $id, $cols = 'DESC')
	{
		$this->db->order_by($id, $cols);
		$query = $this->db->get($table);
		return $query->row();
	}

	public function read($table, $id = array())
	{
		if(empty($id)){
			$query = $this->db->get($table)->result();
		}else{
			$query = $this->db->get_where($table, $id)->row();
		}

		return $query;
	}

	public function read2($table, $id = array(), $id1 = array())
	{
		$this->db->where($id1);
		$this->db->where($id);
		$query = $this->db->get($table)->row();

		return $query;
	}

	public function position($table, $field, $val, $id = array())
	{
		if(empty($id)){
			$data = $this->read_array($table);
		}else{
			$data = $this->read_id_array($table, $id);
		}

		$i = 0;
		$row = '';
		foreach($data as $d_item){
			$i++;
			if($d_item[$field] == $val){
				$row = $i;
			}
		}

		return $row;
	}

	public function read_array($table, $id = array())
	{
		if(empty($id)){
			$query = $this->db->get($table)->result_array();
		}else{
			$query = $this->db->get_where($table, $id)->row_array();
		}

		return $query;
	}

	public function readby($table, $id, $pos = 'DESC')
	{
		$this->db->order_by($id, $pos);
		$query = $this->db->get($table)->result();
		return $query;
	}

	public function read_id($table, $id = array(), $idby = '', $pos = 'DESC')
	{
		if(!empty($idby)){
			$this->db->order_by($idby, $pos);
		}
		$query = $this->db->get_where($table, $id);
		return $query->result();
	}

	public function read_id_array($table, $id = array(), $idby = '')
	{
		if(!empty($idby)){
			$this->db->order_by($idby, 'DESC');
		}
		$query = $this->db->get_where($table, $id);
		return $query->result_array();
	}

	public function read_id2($table, $id = array(), $id1 = array())
	{
		$this->db->where($id1);
		$this->db->where($id);
		$q = $this->db->get($table)->result();
		return $q;
	}

	public function read_id3($table, $id = array(), $id1 = array(), $id2 = array())
	{
		$this->db->where($id2);
		$this->db->where($id1);
		$this->db->where($id);
		$q = $this->db->get($table)->result();
		return $q;
	}

	public function read_g($table, $g, $id = array())
	{
		$this->db->group_by($g);
		if(!empty($id)){
			$this->db->where($id);
		}
		$q = $this->db->get($table)->result();
		return $q;
	}

	public function total($id, $tgl)
	{
		$q = $this->db->select_sum('jumlah_terjual')
				->from('penjualan')
				->where('id_obat', $id)
				->like('tanggal', $tgl)
				->get()
				->row();
		return $q;
	}

	public function bulan()
	{
		$awal_tgl = date_create($this->M_crud->last('penjualan', 'tanggal', 'ASC')->tanggal);
		$akhir_tgl = date_create($this->M_crud->last('penjualan', 'tanggal', 'DESC')->tanggal);
		$hasil_tgl = date_diff($awal_tgl, $akhir_tgl);
		
		if($hasil_tgl->y != 0){
			$th = $hasil_tgl->y * 12;
			$hh = $hasil_tgl->m;
			$hasil_tgl = $th + $hh;
		}else{
			$hasil_tgl = $hasil_tgl->m;
		}

		return $hasil_tgl;
	}

	public function update($table, $fields = array(), $id = array(), $id1 = array())
	{
		if(!empty($id1)){
			$this->db->where($id1);
		}
		$this->db->where($id);
		$this->db->update($table, $fields);
	}

	public function delete($table, $id = array(), $urls = '')
	{
		if(!empty($id)){
    		$this->db->delete($table, $id);
    		redirect(site_url($urls));
    	}
	}

	public function status($table, $fields = array(), $id = array(), $urls = '')
	{
		$this->update($table, $fields, $id);
		redirect(site_url($urls));
	}
}