<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('role') == 1){
			$this->session->unset_userdata('user');
			redirect(site_url('login'));
		}else{
			$this->session->unset_userdata('user');
			redirect(site_url());
		}
	}
}