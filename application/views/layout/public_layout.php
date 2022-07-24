<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title?> - Pesan Ikan Lele</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/fontawesome/css/all.css')?>">
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('assets/css/main.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/public.css')?>">
    </head>
    <!-- <body style="background-image: url('<?=base_url('assets/img/upy.jpg')?>')"> -->
    <body>
        <?=$content?>
        <script type="text/javascript" src="<?=base_url('assets/js/jquery.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/bootstrap/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/dataTables.min.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#myTable').DataTable();
                $('#myTable1').DataTable();
                $('.dataTables_info').remove();
            });
        </script>
    </body>
</html>