<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calc {

    protected $CI;
    
    public function __construct()
	{
		$this->CI =& get_instance();
    }

    protected function selisih($awal_tgl, $akhir_tgl)
	{
		$awal_tgl = new DateTime($awal_tgl);
		$akhir_tgl = new DateTime($akhir_tgl);
		$hasil_tgl = $awal_tgl->diff($akhir_tgl);

		$bulan = 0;

		if($hasil_tgl->y == 0){
			$bulan = $hasil_tgl->m;
		}else{
			$bulan = ($hasil_tgl->y * 12) + $hasil_tgl->m;
		}

		$bulan = $bulan > 0 ? $bulan: 1;

		return $bulan;
	}

	protected function bulan($m)
    {
        $mn = '';
        switch ($m) {
            case '01': $mn = 'Januari'; break;
            case '02': $mn = 'Februari'; break;
            case '03': $mn = 'Maret'; break;
            case '04': $mn = 'April'; break;
            case '05': $mn = 'Mei'; break;
            case '06': $mn = 'Juni'; break;
            case '07': $mn = 'Juli'; break;
            case '08': $mn = 'Agustus'; break;
            case '09': $mn = 'September'; break;
            case '10': $mn = 'Oktober'; break;
            case '11': $mn = 'November'; break;
            case '12': $mn = 'Desember'; break;
        }
        return $mn;
    }

	public function perbulan($id)
	{
		//data penjualan perminggu
 		$awal_tgl = $this->CI->M_crud->read_id('penjualan', array('kode_ikan_lele' => $id))[0]->tanggal_jual;
 		$awal_bulan = date('Y-m', strtotime($awal_tgl->tanggal_jual));
 		$selisih = $this->selisih($awal_tgl->tanggal_jual, date('Y-m-d'));
 		$tanggal = strtotime($awal_tgl);
 		$awal_tgl = new DateTime($awal_tgl);


 		$pj_bulan = [];
 		$rata2 = [];

 		for($n = 0; $n < $selisih; $n++){

 			if($n > 0){
				$awal_tgl->add(new DateInterval('P1M'));
				$bulan = $awal_tgl->format('m');
				$tahun = $awal_tgl->format('Y');
			}else{
				$bulan = date('m', $tanggal);
				$tahun = date('Y', $tanggal);
			}

			$hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

			$pj_week = [];
			//$jt_pj = 0;
			$_hari = 1;
	 		for($m = 0; $m < 4; $m++){

	 			$total_pj = 0;

	 			if($m < 3){
		 			for($t = 0; $t < 7; $t++){
		 				$d_hari = count($_hari) > 1 ? $_hari: '0'.$_hari;
		 				$pj = $this->CI->M_crud->read2('penjualan', array('tanggal_jual' => $tahun.'-'.$bulan.'-'.$d_hari), array('kode_ikan_lele' => $id));
		 				$total_pj += $pj->jumlah_terjual;
		 				//var_dump($_hari);
		 				$_hari++;
		 				
		 			}
		 		}else{
		 			
		 			for($t1 = $_hari; $t1 <= $hari; $t1++){
		 				$pj = $this->CI->M_crud->read2('penjualan', array('tanggal_jual' => $tahun.'-'.$bulan.'-'.$_hari), array('kode_ikan_lele' => $id));
		 				$total_pj += $pj->jumlah_terjual;
		 				$_hari++;
		 			}
		 		}

		 		$pj_week[] = $total_pj;
		 		//$jt_pj += $total_pj;

	 		}

	 		$pj_bulan[$this->bulan($bulan)] = $pj_week;
	 		//$rata2[] = $jt_pj / 4;

	 	}

	 	//var_dump($pj_bulan);

	 	$data_pj = array(
	 		'pj_bulan' => $pj_bulan
	 		//'rata' => $rata2
	 	);

	 	return $data_pj;
	}

 	public function hasil($id)
 	{

 		$pj_bulan = $this->perbulan($id);
 		$m1 = 0;
 		$m2 = 0;
 		$m3 = 0;
 		$m4 = 0;
 		foreach($pj_bulan['pj_bulan'] as $b_item => $m_item){
 			$m1 += $m_item[0];
	 		$m2 += $m_item[1];
	 		$m3 += $m_item[2];
	 		$m4 += $m_item[3];
 		}

		$h_je = []; 

		foreach($pj_bulan['pj_bulan'] as $b1_item => $m1_item){

 			$je = sqrt(pow($m1_item[0] - $m1, 2) + pow($m1_item[1] - $m2, 2) + pow($m1_item[2] - $m3, 2) + pow($m1_item[3] - $m4, 2));
 			$h_je[$b1_item] = array(
 				
 				'm1' => $m1_item[0],
 				
 				'm2' => $m1_item[1],
 				
 				'm3' => $m1_item[2],
 				
 				'm4' => $m1_item[3],
 				
 				'jarak' => $je
 			);
 		}

 		$keyj = array_column($h_je, 'jarak');
		array_multisort($keyj, SORT_ASC, $h_je);
		$el = array_slice($h_je, 0, 3);
		
		$h = 0;
		$a = 0;
		foreach($el as $e_item){

			$a++;
			$pbje = 0;
			$t = 0;
			foreach($e_item as $mi_item){

				$pbje += $mi_item;
				$t++;
			}

			$pbje = $pbje / $t;
			$r_rata = round($pbje);
			$h += $r_rata;
		}

		$hp = $h / $a;

		$hasil = is_nan($hp) ? 0: $hp;

		$data = array(

			'bulan' => $pj_bulan,

			'jarak_euclid' => $h_je,
			
			'jarak_terdekat' => $el,
			
			'hasil' => $hasil

		);

		return $data;
 	}
}