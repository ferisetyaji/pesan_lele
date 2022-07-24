<!DOCTYPE html>
<html lang="en" style="min-height:100%;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Prediksi Pesanan Ikan Lele</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/fontawesome/css/all.css')?>">
        <link rel="stylesheet" href="<?=base_url('assets/css/dataTables.min.css')?>">
        <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url('assets/css/admin.css')?>">
    </head>
    <body style="background-color:transparent;">
        <div class="body-content" style="margin:0 auto;margin-top:200px;">
            <div class="login container">
                <form method="post">
                    <div class="login-title">Login</div>
                    <h4>Prediksi Pesanan Ikan Lele</h4>
                    <br>
                    <div class="login-error"><?=$error?></div>
                    <div class="form-group">
                        <input type="text" class="form-control login-form" name="username" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control login-form" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="radio">
                          <label>
                            <input type="radio" name="user" id="optionsRadios1" value="kepala" checked>
                            Kepala Pimpinan
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="user" id="optionsRadios2" value="produksi">
                            Produksi
                          </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-login btn-block" name="save" value="1">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="<?=base_url('assets/js/jquery.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/bootstrap/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/dataTables.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/main.js')?>"></script>
    </body>
</html>