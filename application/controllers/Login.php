<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		if($this->session->has_userdata('user')){
    		if($this->session->userdata('role') == 1){
				redirect(site_url('kepala_pimpinan'));
			}else{
				redirect(site_url('produksi'));
			}
    	}

		$error = '';
		if($this->input->post('save')){
			if($this->input->post('user') == 'kepala'){
				$admin = $this->M_crud->read('kepala_pimpinan', array('username' => $this->input->post('username')));
			}else{
				$produksi = $this->M_crud->read('produksi', array('username' => $this->input->post('username')));
				var_dump($produksi);
			}
			
			$pass = $this->input->post('password');
			if(!empty($admin) || !empty($produksi)){
				if($this->input->post('user') == 'kepala'){
					if($admin->password == $pass){
						$data = array(
							'user' => $admin->id_kepala_pimpinan,
							'role' => 1
						);

						$this->session->set_userdata($data);
						redirect(site_url('penjualan'));
					}else{
						$error = '<div class="alert alert-danger alert-sm" role="alert">Password anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					}
				}else{
					if($produksi->password == $pass){
						$data = array(
							'user' => $produksi->id_produksi,
							'role' => 0
						);

						$this->session->set_userdata($data);
						redirect(site_url('penjualan'));
					}else{
						$error = '<div class="alert alert-danger alert-sm" role="alert">Password anda salah.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
					}
				}
			}else{
				$error = '<div class="alert alert-danger alert-sm" role="alert">User tidak terdaftar.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
		}

		$data['error'] = $error;
		$this->load->view('login/login_form', $data);
	}
}