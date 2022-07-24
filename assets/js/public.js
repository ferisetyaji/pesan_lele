$(document).ready(function(){
    $('#myTable').DataTable();
    $('#myTable1').DataTable();
    $('.dataTables_info').remove();

    $(document).on('change', '.nilai', function(){
        var nilai = document.getElementsByClassName('nilai');
        var a = 0;
        for(var n = 0; n < nilai.length; n++){
            var n_val = document.getElementsByClassName('nilai')[n].value;
            if(n_val != ''){
                a++;
            }
        }

        if(a >= 4){
            for(var s = 0; s < nilai.length; s++){
                var n_val1 = document.getElementsByClassName('nilai')[s].value;
                if(n_val1 == ''){
                    document.getElementsByClassName('nilai')[s].disabled = true;
                }
            }
        }else{
            for(var s = 0; s < nilai.length; s++){
                var n_val1 = document.getElementsByClassName('nilai')[s].value;
                if(n_val1 == ''){
                    document.getElementsByClassName('nilai')[s].disabled = false;
                }
            }
        }


    });
});