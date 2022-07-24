<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title?> - Sistem Rekomendasi Peluang Kerja Fakultas Sains dan Teknologi Univertas PGRI Yogyakarta</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/fontawesome/css/all.css')?>">
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/public.css')?>">
    </head>
    <body style="background-image: url('<?=base_url('assets/img/upy.jpg')?>')">
        <div class="container">
            <div class="body-content">
                <div class="title">Sistem Rekomendasi Peluang Kerja Fakultas Sains dan Teknologi</div>
                <div class="title1">Univertas PGRI Yogyakarta</div>
                <?php if(!empty($menu)):?>
                <div class="menu">
                    <a href="<?=site_url('mahasiswa')?>" class="btn btn-pk">Detail Mahasiswa</a>
                    <a href="<?=site_url('mahasiswa/hasil')?>" class="btn btn-pk">Detail Perhitungan</a>
                    <a href="<?=site_url('logout')?>" class="btn btn-danger btn-pk">Keluar</a> 
                </div>
                <?php endif;?>
                <div class="form-group"><?=$error?></div>
                <hr>
                <?=$content?>
            </div>
        </div>
        <script type="text/javascript" src="<?=base_url('assets/js/jquery.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/bootstrap/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/dataTables.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/public.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.konsentrasi').change(function(){
                    var id = $('.konsentrasi').val();

                    <?php $i = 1; foreach($konsentrasi as $ks_item){

                        $atr = 'var atribut_'.$i.' = [';

                        $mata_kuliah = $nn->read_id('konsentrasi', array('id_kurikulum' => $ks_item->id_kurikulum));

                        $a = 0;

                        foreach($mata_kuliah as $mk_item){
                            if($a > 0){
                                $atr .=',';
                            }
                            $atr .= '"'.$mk_item->name.'"';

                            $a++;
                        }

                        $atr .= '];';

                        $i++;

                        echo $atr;

                    }?>

                    function wajibMinat(data){
                        var f_wajib_minat = '';
                        var no = 1;
                        for(var i = 0; i < data.length; i++){
                            f_wajib_minat += '<div class="form-group row"><label class="col-md-9">'+no+'. '+data[i]+'</label><div class="col-md-3"><input type="hidden" name="atribut[]" value="'+data[i]+'"><select class="form-control form-user nilai" name="nilai[]"><option value="">Nilai</option><option>A</option><option>A-</option><option>B+</option><option>B</option><option>B-</option><option>C+</option><option>C</option><option>C-</option><option>D</option></select></div></div>';
                            no++;
                        }

                        return f_wajib_minat;
                    }

                    var cs_wajib_minat = '';

                    switch(id){

                        <?php $k = 1; foreach($konsentrasi as $kss_item){

                            echo "case '".$kss_item->wajib_minat."': cs_wajib_minat = wajibMinat(atribut_".$k."); break;";

                            $k++;

                        }?>
                        

                        default:

                                cs_wajib_minat = '<i>Pilih Konsentrasi untuk input nilai wajib minat</i>';

                            break;

                    }

                    $('.title-wajib-minat').text(id);
                    $('.wajib_minat').html(cs_wajib_minat);
                });
            });
        </script>
    </body>
</html>