<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepala_pimpinan extends MY_Controller {

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
			'table' => 'kepala_pimpinan',
			'role' => '1',
			'fields' => array(
				'field' => array('nama_lengkap', 'username', 'jenis_kelamin', 'alamat'),
				'field_hidden' => array('password'),
				'field_id' => 'id_kepala_pimpinan'
			),
			'url' => site_url('kepala_pimpinan'),
			'option' => array(
				'sp' => array('tambah'),
				'aksi' => array('edit', 'delete')
			)
		));

		$data = $this->crud->read();
		$this->load->view('layout/admin_layout', $data);
	}

	public function tambah_kepala_pimpinan()
	{
		$this->crud->set_crud(array(
			'table' => 'kepala_pimpinan',
			'field_form' => array(
				'nama_lengkap' => array('type' => 'text'),
				'username' => array('type' => 'text'),
				'password' => array('type' => 'password'),
				'jenis_kelamin' => array(
					'type' => 'select',
					'option' => array('Laki - laki', 'Perempuan')
				),
				'alamat' => array('type' => 'textarea')
			),
			'url' => site_url('kepala_pimpinan')
		));

		$data = $this->crud->add();
		$this->load->view('layout/admin_layout', $data);
	}

	public function edit_kepala_pimpinan($id)
	{
		$this->crud->set_crud(array(
			'table' => 'kepala_pimpinan',
			'field_form' => array(
				'nama_lengkap' => array('type' => 'text'),
				'username' => array('type' => 'text'),
				'password' => array('type' => 'password'),
				'jenis_kelamin' => array(
					'type' => 'select',
					'option' => array('Laki - laki', 'Perempuan')
				),
				'alamat' => array('type' => 'textarea')
			),
			'field_update' => array('id_kepala_pimpinan' => $id),
			'url' => site_url('kepala_pimpinan')
		));

		$data = $this->crud->update();
		$this->load->view('layout/admin_layout', $data);
	}
}