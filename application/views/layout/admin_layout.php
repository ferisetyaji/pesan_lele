<?php

$title_template = '';

if($_SESSION['role'] == 1){
    $user_data = $this->M_crud->read('kepala_pimpinan', array('id_kepala_pimpinan' => $this->session->userdata('user')));
    $title_template = 'Kepala Pimpinan';
}else{
    $user_data = $this->M_crud->read('produksi', array('id_produksi' => $this->session->userdata('user')));
    $title_template = 'Produksi';
}

?>
<!DOCTYPE html>
<html lang="en" style="min-height:100%;background-color:#fff">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title_template?> - Prediksi Pesanan Ikan Lele</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/fontawesome/css/all.css')?>">
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/admin.css')?>">
    </head>
    <body style="background-color:#fff">
        <div class="top-bar">
            <div class="btn-burger burger dib pointer"><i class="fas fa-bars"></i></div>
            <a href="#" class="brands">Prediksi Pesanan Ikan Lele</a>
            <p class="navbar-text navbar-right" style="margin-right:15px; margin-bottom:0;">Masuk sebagai <i style="color:#fff"><?=$user_data->username?></i></p>
            <div class="clear"></div>
        </div>
        <div class="admin-menu">
            <ul class="list-unstyled">
                <?php if($_SESSION['role'] == 1):?>
                <li id="penjualan">
                    <a href="<?=site_url('penjualan')?>" class="admin-menu-first" data-id="#penjualan">
                        <i class="fa fa-file fa-fw"></i>
                        <span>Penjualan</span>
                    </a>
                </li>
                <li id="ikan_lele">
                    <a href="<?=site_url('ikan_lele')?>" class="admin-menu-first" data-id="#ikan_lele">
                        <i class="fa fa-list-alt fa-fw"></i>
                        <span>Ikan lele</span>
                    </a>
                </li>
                <li id="prediksi">
                    <a href="<?=site_url('prediksi')?>" class="admin-menu-first" data-id="#prediksi">
                        <i class="fa fa-calculator fa-fw"></i>
                        <span>Prediksi</span>
                    </a>
                </li>
                <li id="stok_ikan_lele">
                    <a href="<?=site_url('stok_ikan_lele')?>" class="admin-menu-first" data-id="#stok_ikan_lele">
                        <i class="fa fa-list-alt fa-fw"></i>
                        <span>Stok ikan lele</span>
                    </a>
                </li>
                <li id="produksi">
                    <a href="<?=site_url('produksi')?>" class="admin-menu-first" data-id="#produksi">
                        <i class="fa fa-box fa-fw"></i>
                        <span>Produksi</span>
                    </a>
                </li>
                <li id="kepala_pimpinan">
                    <a href="<?=site_url('kepala_pimpinan')?>" class="admin-menu-first" data-id="#kepala_pimpinan">
                        <i class="fa fa-user-alt fa-fw"></i>
                        <span>Kepala Pimpinan</span>
                    </a>
                </li>
                <?php else:?>
                <li id="penjualan">
                    <a href="<?=site_url('penjualan')?>" class="admin-menu-first" data-id="#penjualan">
                        <i class="fa fa-file fa-fw"></i>
                        <span>Penjualan</span>
                    </a>
                </li>
                <li id="prediksi">
                    <a href="<?=site_url('prediksi')?>" class="admin-menu-first" data-id="#prediksi">
                        <i class="fa fa-calculator fa-fw"></i>
                        <span>Prediksi</span>
                    </a>
                </li>
                <li id="stok_ikan_lele">
                    <a href="<?=site_url('stok_ikan_lele')?>" class="admin-menu-first" data-id="#stok_ikan_lele">
                        <i class="fa fa-list-alt fa-fw"></i>
                        <span>Stok ikan lele</span>
                    </a>
                </li>
                <?php endif;?>
                <li>
                    <a href="<?=site_url('logout')?>" class="admin-menu-first admin-logout" data-id="#home" style="border-radius:4px;">
                        <span><i class="fas fa-sign-out-alt"></i></span>Keluar
                    </a>
                </li>
            </ul>
        </div>
        <div id="data" data-id="#<?=$btn_side?>"></div>
        <div class="contents"><?=$content?></div>
        <script type="text/javascript" src="<?=base_url('assets/js/jquery.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/bootstrap/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/dataTables.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/main.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/public.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                var exel = '<button type="button" class="btn btn-primary btn-del btn-add" data-toggle="modal" data-target=".import-excel">Import excel</button>';

                <?php if($ss_data):?>
                    exel += '<a href="<?=base_url('assets/doc/'.$ss_data)?>" class="btn btn-info btn-del">Download Excel</a>'
                <?php endif;?>
                
                var btn = '<button type="button" class="btn btn-success btn-del btn-add" data-toggle="modal" data-target=".tambah-data">Tambah</button>';
                
                var alink = '<a href="<?=@$btn_alink?>" class="btn btn-success btn-del">Tambah</a>';

                $('#myTable_wrapper').prepend(<?php if(!empty($exel)){?>exel+<?php } if(!empty($btn_add)){if($btn_add == 'btn'){?>btn+<?php }elseif($btn_add == 'alink'){?>alink<?php }}?>);
            });
        </script>
    </body>
</html>