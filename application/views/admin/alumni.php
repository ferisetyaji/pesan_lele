<h3>Alumni</h3>
<hr>
<form method="post">
	<table class="table table-bordered" id="myTable">
		<thead>
			<tr>
				<th class="tb-no">No</th>
				<th>Nama</th>
				<th>NPM</th>
				<th>Konsentrasi</th>
				<th>Profesi</th>
				<th class="tb-act-3">Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 0; foreach($alumni as $a_item): $i++;?>
			<tr>
				<td><?=$i?></td>
				<td><?=$a_item->nama?></td>
				<td><?=$a_item->npm?></td>
				<td><?=$a_item->konsentrasi?></td>
				<td><?=$a_item->profesi?></td>
				<td>
					<a href="<?=site_url('admin/detail_alumni/'.$a_item->id_alumni)?>" class="btn btn-info btn-xs">Detail</a>
					<a href="<?=site_url('admin/edit_alumni/'.$a_item->id_alumni)?>" class="btn btn-primary btn-xs">Edit</a>
					<button type="submit" class="btn btn-danger btn-xs" name="del" value="<?=$a_item->npm?>">Hapus</button>
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