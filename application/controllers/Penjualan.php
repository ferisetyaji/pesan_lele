<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/phpleb/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjualan extends MY_Controller {

	public function index()
	{
		if($this->input->post('del')){
			$this->db->delete('penjualan', array('id_penjualan' => $this->input->post('del')));

			redirect(current_url());
		}

		if($this->input->post('up')){
            $allowed_file_types = array('xls', 'xlsx');
            $fileNameCmps = explode(".", $_FILES["excel"]['name']);
            $fileExtension = strtolower(end($fileNameCmps));
            if (in_array($fileExtension, $allowed_file_types)) {
                move_uploaded_file($_FILES["excel"]["tmp_name"], "./assets/doc/".$_FILES['excel']['name']);

                $excel = './assets/doc/'.$_FILES['excel']['name'];

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($excel);
                $sheet = $spreadsheet->getActiveSheet();
                $sheet = $sheet->toArray(null, true, true ,true);
                $valid = 0;
                for($i=2; $i<=count($sheet); $i++) {
                	if(!empty($sheet[$i]['B'])){
	                	$ikan = $this->M_crud->read('ikan_lele', array('kode_ikan_lele' => $sheet[$i]['C']));
				    	if(empty($ikan)){
				    		$this->db->insert('ikan_lele', array(
				    			'kode_ikan_lele' => $sheet[$i]['B'],
				    			'nama_ikan_lele' => $sheet[$i]['C']
				    		));

				    		$kode = $this->M_crud->last('ikan_lele', 'id_ikan_lele')->kode_ikan_lele;
				    	}else{
				    		$kode = $ikan->kode_ikan_lele;
				    	}

				    	$this->db->insert('penjualan', array(
				    		'tanggal_jual' => date('Y-m-d H:i:s', strtotime($sheet[$i]['A'])),
				    		'kode_ikan_lele' => $kode,
				    		'jumlah_terjual' => $sheet[$i]['D']
				    	));

				    	$valid += 1;
				    }
                }

                if($valid > 0){
                	redirect(current_url());
                }else{
                	$data['error'] = 'Dokumen kosong';
                }
            }
        }

		$data['nn'] = $this->M_crud;
		$data['penjualan'] = $this->M_crud->read('penjualan');
		$data['ss_data'] = 'Penjualan Ikan Lele.xlsx';
		
		$this->view_admin('admin/penjualan', 'penjualan', $data, 'alink', 'penjualan/tambah_penjualan', 'excel');
	}

	public function tambah_penjualan()
	{
		$ikan = $this->M_crud->read('ikan_lele');

		$kode = [];
		foreach($ikan as $i_item){
			$kode[] = $i_item->kode_ikan_lele;
		}

		$this->crud->set_crud(array(
			'table' => 'penjualan',
			'field_form' => array(
				'tanggal_jual' => array('type' => 'date'),
				'kode_ikan_lele' => array(
					'type' => 'select',
					'option' => $kode
				),
				'jumlah_terjual' => array('type' => 'number')
			),
			'url' => site_url('penjualan')
		));

		$data = $this->crud->add();
		$this->load->view('layout/admin_layout', $data);
	}

	public function edit_penjualan($id)
	{
		$ikan = $this->M_crud->read('ikan_lele');

		$kode = [];
		foreach($ikan as $i_item){
			$kode[] = $i_item->kode_ikan_lele;
		}

		$this->crud->set_crud(array(
			'table' => 'penjualan',
			'field_form' => array(
				'tanggal_jual' => array('type' => 'date'),
				'kode_ikan_lele' => array(
					'type' => 'select',
					'option' => $kode
				),
				'jumlah_terjual' => array('type' => 'number')
			),
			'field_update' => array('id_penjualan' => $id),
			'url' => site_url('penjualan')
		));

		$data = $this->crud->update();
		$this->load->view('layout/admin_layout', $data);
	}
}