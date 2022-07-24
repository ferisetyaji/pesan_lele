<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('user')){
			redirect(site_url('login'));
		}
	}
	
	public function view_admin($content, $side = null, $data = array(), $btn = null, $alink = null, $exel = null)
	{
		$layout['btn_alink'] = site_url($alink);
		$layout['btn_add'] = $btn;
		$layout['exel'] = $exel;
		$layout['btn_side'] = $side;
		$layout['content'] = $this->load->view($content, $data, true);
		$this->load->view('layout/admin_layout', $layout);
	}

	public function view_public($content, $title, $data = array())
	{
		$layout['title'] = $title;
		$layout['content'] = $this->load->view($content, $data, true);
		$layout['menu'] = 1;
		$this->load->view('layout/public_layout1', $layout);
	}
}