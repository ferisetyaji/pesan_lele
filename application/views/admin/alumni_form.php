<h3><?=$title?> Alumni</h3>
<hr>
<form method="post">
	<div class="row">
		<div class="col-md-8">
			<div class="form-group row">
				<label class="col-md-4">Nama Alumni</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="nama" value="<?=$alumni->nama?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4">NPM</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="npm" value="<?=$alumni->npm?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4">Konsentrasi</label>
				<div class="col-md-8">
					<select class="form-control form-user konsentrasi" name="konsentrasi" required>
						<option value="">Pilih Konsentrasi</option>
						<?php foreach($konsentrasi as $k_item){?>
						<option<?php if($alumni->konsentrasi == $k_item->wajib_minat) echo ' selected';?>><?=$k_item->wajib_minat?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4">Nilai Wajib Minat <span class="title-wajib-minat"></span></label>
				<div class="col-md-8 wajib_minat">
				<?php
				if(!empty($nilai)):
					foreach($nilai as $n_item):
				?>
					<div class="form-group row">
						<label class="col-md-9"><?=$n_item->atribut?></label>
						<div class="col-md-3">
							<input type="hidden" name="atribut[]" value="<?=$n_item->atribut?>">
							<select class="form-control form-user nilai" name="nilai[]" required>
								<option value="">Nilai</option>
								<option<?php if($n_item->nilai == 'A') echo ' selected';?>>A</option>
								<option<?php if($n_item->nilai == 'A-') echo ' selected';?>>A-</option>
								<option<?php if($n_item->nilai == 'B+') echo ' selected';?>>B+</option>
								<option<?php if($n_item->nilai == 'B') echo ' selected';?>>B</option>
								<option<?php if($n_item->nilai == 'B-') echo ' selected';?>>B-</option>
								<option<?php if($n_item->nilai == 'C+') echo ' selected';?>>C+</option>
								<option<?php if($n_item->nilai == 'C') echo ' selected';?>>C</option>
								<option<?php if($n_item->nilai == 'C-') echo ' selected';?>>C-</option>
								<option<?php if($n_item->nilai == 'D') echo ' selected';?>>D</option>
							</select>
						</div>
					</div>
				<?php
					
					endforeach;
				else:

				?>
					<i>Pilih Konsentrasi untuk input nilai wajib minat</i>
				<?php endif;?>
					
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4">Profesi</label>
				<div class="col-md-8">
					<input type="text" class="form-control" name="profesi" value="<?=$alumni->profesi?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-4"></label>
				<div class="col-md-8">
					<button type="submit" class="btn btn-success btn-sm" name="save" value="1">Simpan</button>
					<a href="<?=site_url('admin/alumni')?>" class="btn btn-warning btn-sm">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</form>