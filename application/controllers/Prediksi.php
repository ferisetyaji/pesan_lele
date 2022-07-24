<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prediksi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('calc');

	}

	public function index()
	{
		if($this->input->post('ikan')){
			
			$data['prediksi'] = $this->calc->hasil($this->input->post('ikan'));
		}

		$data['ikan'] = $this->M_crud->read('ikan_lele');

		$this->view_admin('admin/prediksi', 'prediksi', $data);
	}
}