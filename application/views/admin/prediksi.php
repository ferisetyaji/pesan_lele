<h3>Prediksi</h3>
<hr>
<form method="post" id="submit-obat">
	<div class="form-group">
		<select class="form-control pilih-obat" name="ikan" style="float:left;width:auto">
			<option value="">- Pilih Ikan -</option>
			<?php foreach($ikan as $o_item){
				echo '<option';
				if($o_item->id_ikan_lele == $_POST['ikan']){
					echo ' selected=""';
				}
				echo ' value="'.$o_item->id_ikan_lele.'">'.$o_item->nama_ikan_lele.'</option>';
			}?>
		</select>
		<div class="clearfix"></div>
	</div>
</form>

<?php if(!empty($prediksi)):?>

<div class="form-group">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>Minggu 1</th>
				<th>Minggu 2</th>
				<th>Minggu 3</th>
				<th>Minggu 4</th>
			</tr>
		</thead>
		<tbody>
		<?php $a = 0; foreach($prediksi['bulan']['pj_bulan'] as $b1_key => $b1_item): $a++;?>
			<tr>
				<td><?=$b1_key?></td>
				<?php foreach($b1_item as $m_item){

					echo '<td>'.$m_item.'</td>';

				}?>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
<br>
<h3>Jarak Euclid</h3>
<hr>
<div class="form-group">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>Minggu 1</th>
				<th>Minggu 2</th>
				<th>Minggu 3</th>
				<th>Minggu 4</th>
				<th>Jarak Euclid</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($prediksi['jarak_euclid'] as $b2_key => $je_item):?>
			<tr>
				<td><?=$b2_key?></td>
				<td><?=$je_item['m1']?></td>
				<td><?=$je_item['m2']?></td>
				<td><?=$je_item['m3']?></td>
				<td><?=$je_item['m4']?></td>
				<td><?=$je_item['jarak']?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
<br>
<h3>Jarak Terdekat</h3>
<hr>
<div class="form-group">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>Minggu 1</th>
				<th>Minggu 2</th>
				<th>Minggu 3</th>
				<th>Minggu 4</th>
				<th>Jarak Euclid</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($prediksi['jarak_terdekat'] as $b3_key => $jt_item):?>
			<tr>
				<td><?=$b3_key?></td>
				<td><?=$jt_item['m1']?></td>
				<td><?=$jt_item['m2']?></td>
				<td><?=$jt_item['m3']?></td>
				<td><?=$jt_item['m4']?></td>
				<td><?=$jt_item['jarak']?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
<div class="form-group">
	<div class="alert alert-success" role="alert">Hasil Prediksi <strong><?=$prediksi['hasil']?></strong></div>
</div>
<?php endif;?>