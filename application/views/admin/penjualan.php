<h3>Penjualan</h3>
<hr>
<form method="post">
	<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
				<th class="tb-no">No</th>
				<th>Tanggal Jual</th>
				<th>Kode Ikan Lele</th>
				<th>Nama Ikan Lele</th>
				<th>Jumlah Terjual</th>
				<th class="tb-act-2">Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 0;
		foreach($penjualan as $a_item):
			$ikan = $nn->read('ikan_lele', array('kode_ikan_lele' => $a_item->kode_ikan_lele));
			$i++;?>
			<tr>
				<td><?=$i?></td>
				<td><?=$a_item->tanggal_jual?></td>
				<td><?=$a_item->kode_ikan_lele?></td>
				<td><?=$ikan->nama_ikan_lele?></td>
				<td><?=$a_item->jumlah_terjual?></td>
				<td>
					<a href="<?=site_url('penjualan/edit_penjualan/'.$a_item->id_penjualan)?>" class="btn btn-primary btn-xs">Edit</a>
					<button type="submit" class="btn btn-danger btn-xs" name="del" value="<?=$a_item->id_penjualan?>">Hapus</button>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</form>

<div class="modal fade import-excel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    	<form method="post" enctype="multipart/form-data">
	    	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Import Excel</h4>
		    </div>
		    <div class="modal-body">
		    	<div class="form-group">
		    		<input type="file" class="form-control" name="excel">
		    	</div>
		    </div>
		    <div class="modal-footer">
		    	<button type="submit" class="btn btn-primary btn-sm" name="up" value="1">Import</button>
		    	<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
		    </div>
		</form>
    </div>
  </div>
</div>
<script type="text/javascript">
	<?php if(!empty($error)) echo 'alert("'.$error.'");';?>
</script>