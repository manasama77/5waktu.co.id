function check_login()
{
    //Mengambil value dari input username & Password
    var username = $('#username').val();
    var password = $('#password').val();
    //Ubah alamat url berikut, sesuaikan dengan alamat script pada komputer anda
    var url_login    = 'https://gmpb-adam:8080/bsbuletin/process_login.php';
    var url_admin    = 'https://gmpb-adam:8080/bsbuletin/admin.php';
     
    //Ubah tulisan pada button saat click login
    $('#btnLogin').attr('value','Processing, Please Wait ...');
     
    //Gunakan jquery AJAX
    $.ajax({
        url     : url_login,
        //mengirimkan username dan password ke script login.php
        data    : 'var_username='+username+'&var_password='+password, 
        //Method pengiriman
        type    : 'POST',
        //Data yang akan diambil dari script pemroses
        dataType: 'html',
        //Respon jika data berhasil dikirim
        success : function(pesan){
            if(pesan=='accepted'){
                //Arahkan ke halaman admin jika script pemroses mencetak kata ok
                window.location = url_admin;
            }
            else{
                //Cetak peringatan untuk username & password salah
                alert(pesan);
                $('#btnLogin').attr('value','Try Again');
            }
        },
    });
}