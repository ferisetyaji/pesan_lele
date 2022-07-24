<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud {

	protected $CI;
	private $table,
			$role,
			$fields = array(),
			$field_hidden = array(),
			$field_id,
			$field_form = array(),
			$field_update = array(),
			$url,
			$option = array();

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function set_crud($set)
	{
		$this->table = $set['table'];
		$this->role = $set['role'];
		$this->fields = $set['fields']['field'];
		$this->field_hidden = $set['fields']['field_hidden'];
		$this->field_id = $set['fields']['field_id'];
		$this->field_update = $set['field_update'];
		$this->field_form = $set['field_form'];
		$this->url = $set['url'];
		$this->option = $set['option'];
	}

	public function btn($aksi, $id)
	{
		switch ($aksi) {
			case 'edit': $btn = '<a href="'.$this->url.'/edit_'.$this->table.'/'.$id.'" class="btn btn-primary btn-xs" style="margin-right:3px">Edit</a>'; break;
			case 'detail': $btn = '<a href="'.$this->url.'/detail_'.$this->table.'/'.$id.'" class="btn btn-info btn-xs" style="margin-right:3px">Detail</a>'; break;
			case 'delete': $btn = '<button type="submit" class="btn btn-danger btn-xs" name="del" value="'.$id.'">Hapus</button>'; break;
			default: $btn = '<a href="'.$this->url.'/'.$aksi.'_'.$this->table.'/'.$id.'" class="btn btn-default btn-xs" style="margin-right:3px">'.ucfirst($aksi).'</a>'; break;
		}

		return $btn;
	}

	public function read()
	{
		if($this->CI->input->post('del')){
			$this->CI->db->delete($this->table, array($this->field_id => $this->CI->input->post('del')));
			redirect(current_url());
		}

		$this->CI->db->order_by($this->field_id, 'DESC');
		$all_data = $this->CI->db->get($this->table)->result_array();

		$html = '
		<h3>Data '.ucfirst($this->table).'</h3>
		<hr>
		<form method="post">
			<table class="table table-striped table-bordered" id="myTable">
				<thead>
					<tr>
						<th class="tb-no">No</th>
		';

		foreach($this->fields as $f_item){
			$th = [];
			foreach($this->field_hidden as $fh_item){
				if($f_item == $fh_item){
					$th = $fh_item;
				}
			}

			if($f_item != $th){
				$th_title = implode(' ', explode('_', ucfirst($f_item)));
				$html .= '<th>'.$th_title.'</th>';
			}
		}

		$act = count($this->option['aksi']) >= 1 ? '-'.count($this->option['aksi']): '';
		$html .= !empty($this->option['aksi']) ? '<th class="tb-act'.$act.'">Aksi</th>': '';
		$html .= '
					</tr>
				</thead>
				<tbody>
		';

		$i = 0;
		foreach($all_data as $ad_item){
			$html .= '<tr>';
			$i++;

			$html .= '<td>'.$i.'</td>';

			foreach($this->fields as $f1_item){
				$td = [];
				foreach($this->field_hidden as $fh1_item){
					if($f1_item == $fh1_item){
						$td = $fh1_item;
					}
				}

				if($f1_item != $td){
					if($f1_item == 'tanggal_jual'){
						$html .= '<td>'.date('Y/m/d', strtotime($ad_item[$f1_item])).'</td>';
					}else{
						$html .= '<td>'.$ad_item[$f1_item].'</td>';
					}
				}
			}

			if(!empty($this->option['aksi'])){
				$html .= '<td>';
				foreach ($this->option['aksi'] as $val) {
					if(!empty($this->role)){
						if($ad_item['role'] == $this->role){
							if($val != 'delete'){
								$html .= $this->btn($val, $ad_item[$this->field_id]);
							}
						}else{
							$html .= $this->btn($val, $ad_item[$this->field_id]);
						}
					}else{
						$html .= $this->btn($val, $ad_item[$this->field_id]);
					}
				}
				$html .= '</td>';
			}

			$html .= '</tr>';
		}

		$html .= '
					</tr>
				</tbody>
			</table>
		</form>
		';

		if(!empty($this->option['sp'])){
			foreach($this->option['sp'] as $val){
				switch ($val) {
					case 'tambah':
							$data['btn_alink'] = $this->url.'/tambah_'.$this->table;
							$data['btn_add'] = 'alink';
						break;
				}
			}
		}

		$data['content'] = $html;
		$data['btn_side'] = $this->table;
		return $data;
	}

	public function add()
	{
		if($this->CI->input->post('save')){
			$field = [];
			foreach($this->field_form as $key_f => $val_f){
				$field[$key_f] = $this->CI->input->post($key_f);
			}
			$this->CI->db->insert($this->table, $field);

			redirect($this->url);
		}


		$html = '
			<h3>Tambah '.ucfirst($this->table).'</h3>
			<hr>
			<form method="post">
				<div class="row">
					<div class="col-md-8">';
					foreach ($this->field_form as $key => $value) {
						$label = !empty($value['label']) ? $value['label']: implode(' ', explode('_', ucfirst($key)));
						if($value['type'] == 'textarea'){
							$html .= '
							<div class="form-group row">
								<label class="col-md-3">'.$label.'</label>
								<div class="col-md-8">
									<textarea class="form-control" name="'.$key.'" rows="4" required></textarea>
								</div>
							</div>';
						}elseif($value['type'] == 'select'){
							$html .= '
							<div class="form-group row">
								<label class="col-md-3">'.$label.'</label>
								<div class="col-md-8">
									<select class="form-control" name="'.$key.'" required>
										<option value="">- Pilih '.$label.' -</option>';
									foreach($value['option'] as $op_item){
										$html .= '<option>'.$op_item.'</option>';
									}
							$html .= '</select>
								</div>
							</div>';
						}else{
							$html .= '
							<div class="form-group row">
								<label class="col-md-3">'.$label.'</label>
								<div class="col-md-8">
									<input type="'.$value['type'].'" class="form-control" name="'.$key.'" required>
								</div>
							</div>';
						}
					}
		$html .= '
						<div class="form-group row">
							<label class="col-md-3"></label>
							<div class="col-md-8">
								<button type="submit" class="btn btn-success btn-sm" name="save" value="1">Simpan</button>
								<a href="'.$this->url.'" class="btn btn-danger btn-sm">Batal</a>
							</div>
						</div>
					</div>
				</div>
			<form>
		';

		$data['content'] = $html;
		$data['btn_side'] = $this->table;
		return $data;
	}

	public function update()
	{
		if($this->CI->input->post('save')){
			$field = [];
			foreach($this->field_form as $key_f => $val_f){
				if($this->CI->input->post($key_f)){
					$field[$key_f] = $this->CI->input->post($key_f);
				}
			}

			$this->CI->db->update($this->table, $field, $this->field_update);
			redirect($this->url);
		}

		$data_update = $this->CI->M_crud->read_array($this->table, $this->field_update);

		$html = '
			<h3>Edit '.ucfirst($this->table).'</h3>
			<hr>
			<form method="post">
				<div class="row">
					<div class="col-md-8">';
					foreach ($this->field_form as $key => $value) {
						$label = implode(' ', explode('_', ucfirst($key)));
						$data_value = $value['type'] != 'password' ? $data_update[$key]: '';
						if($value['type'] == 'textarea'){
							$html .= '
							<div class="form-group row">
								<label class="col-md-3">'.$label.'</label>
								<div class="col-md-8">
									<textarea class="form-control" name="'.$key.'" rows="4">'.$data_value.'</textarea>
								</div>
							</div>';
						}else{
							$html .= '
							<div class="form-group row">
								<label class="col-md-3">'.$label.'</label>
								<div class="col-md-8">
									<input type="'.$value['type'].'" class="form-control" name="'.$key.'" value="'.$data_value.'">
								</div>
							</div>';
						}
					}
		$html .= '
						<div class="form-group row">
							<label class="col-md-3"></label>
							<div class="col-md-8">
								<button type="submit" class="btn btn-success btn-sm" name="save" value="1">Simpan</button>
								<a href="'.$this->url.'" class="btn btn-danger btn-sm">Batal</a>
							</div>
						</div>
					</div>
				</div>
			<form>
		';

		$data['content'] = $html;
		$data['btn_side'] = $this->table;
		return $data;
	}
}