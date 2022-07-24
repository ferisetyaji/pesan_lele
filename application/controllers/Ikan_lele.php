<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ikan_lele extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->has_userdata('user')){
			if($this->session->userdata('role') != 1){
				redirect(site_url('penjualan'));
			}
		}
	}

	public function index()
	{

		$this->crud->set_crud(array(
			'table' => 'ikan_lele',
			'role' => '1',
			'fields' => array(
				'field' => array('nama_ikan_lele', 'kode_ikan_lele', 'jenis_ikan_lele', 'jumlah_ikan_lele'),
				'field_hidden' => array('password'),
				'field_id' => 'id_ikan_lele'
			),
			'url' => site_url('ikan_lele'),
			'option' => array(
				'sp' => array('tambah'),
				'aksi' => array('edit', 'delete')
			)
		));

		$data = $this->crud->read();
		$this->load->view('layout/admin_layout', $data);
	}

	public function tambah_ikan_lele()
	{
		$this->crud->set_crud(array(
			'table' => 'ikan_lele',
			'field_form' => array(
				'nama_ikan_lele' => array('type' => 'text'),
				'kode_ikan_lele' => array('type' => 'text'),
				'jenis_ikan_lele' => array('type' => 'text'),
				'jumlah_ikan_lele' => array('type' => 'number')
			),
			'url' => site_url('ikan_lele')
		));

		$data = $this->crud->add();
		$this->load->view('layout/admin_layout', $data);
	}

	public function edit_ikan_lele($id)
	{
		$this->crud->set_crud(array(
			'table' => 'ikan_lele',
			'field_form' => array(
				'nama_ikan_lele' => array('type' => 'text'),
				'kode_ikan_lele' => array('type' => 'text'),
				'jenis_ikan_lele' => array('type' => 'text'),
				'jumlah_ikan_lele' => array('type' => 'number')
			),
			'field_update' => array('id_ikan_lele' => $id),
			'url' => site_url('ikan_lele')
		));

		$data = $this->crud->update();
		$this->load->view('layout/admin_layout', $data);
	}
}