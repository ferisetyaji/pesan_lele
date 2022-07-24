<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_ikan_lele extends MY_Controller {

	public function index()
	{
		$this->crud->set_crud(array(
			'table' => 'stok_ikan_lele',
			'role' => '1',
			'fields' => array(
				'field' => array('kode_ikan_lele', 'nama_ikan_lele', 'jenis_ikan_lele', 'jumlah_kan_lele', 'bulan'),
				'field_id' => 'id_stok_ikan_lele'
			),
			'url' => site_url('stok_ikan_lele'),
			'option' => array(
				'sp' => array('tambah'),
				'aksi' => array('edit', 'delete')
			)
		));

		$data = $this->crud->read();
		$this->load->view('layout/admin_layout', $data);
	}

	public function tambah_stok_ikan_lele()
	{
		$ikan = $this->M_crud->read('ikan_lele');

		$kode = [];
		foreach($ikan as $i_item){
			$kode[] = $i_item->kode_ikan_lele;
		}

		$this->crud->set_crud(array(
			'table' => 'stok_ikan_lele',
			'field_form' => array(
				'kode_ikan_lele' => array(
					'type' => 'select',
					'option' => $kode
				),
				'nama_ikan_lele' => array('type' => 'text'),
				'jenis_ikan_lele' => array('type' => 'text'),
				'jumlah_ikan_lele' => array('type' => 'number'),
				'bulan' => array(
					'type' => 'select',
					'option' => array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')
				)
			),
			'url' => site_url('stok_ikan_lele')
		));

		$data = $this->crud->add();
		$this->load->view('layout/admin_layout', $data);
	}

	public function edit_stok_ikan_lele($id)
	{
		$ikan = $this->M_crud->read('ikan_lele');

		$kode = [];
		foreach($ikan as $i_item){
			$kode[] = $i_item->kode_ikan_lele;
		}

		$this->crud->set_crud(array(
			'table' => 'stok_ikan_lele',
			'field_form' => array(
				'kode_ikan_lele' => array(
					'type' => 'select',
					'option' => $kode
				),
				'nama_ikan_lele' => array('type' => 'text'),
				'jenis_ikan_lele' => array('type' => 'text'),
				'jumlah_ikan_lele' => array('type' => 'number'),
				'bulan' => array(
					'type' => 'select',
					'option' => array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember')
				)
			),
			'field_update' => array('id_stok_ikan_lele' => $id),
			'url' => site_url('stok_ikan_lele')
		));

		$data = $this->crud->update();
		$this->load->view('layout/admin_layout', $data);
	}
}