<?php
include('config.php');
session_start();

$do_num=$_SESSION['do_num'];
$random_id=$_REQUEST['random_id'];
$nama_gudang=$_SESSION['nama_gudang'];
$id_kota=$_SESSION['id_kota'];
$id_dealer=$_SESSION['id_dealer'];
$id_mobil=$_SESSION['id_mobil'];
$id_driver=$_SESSION['id_driver'];
$id_asst=$_SESSION['id_asst'];
$do_print_date=$_SESSION['do_print_date1'];
$exit_date=$_SESSION['exit_date1'];
$date_terima_ekspedisi=$_SESSION['date_terima_ekspedisi'];
$estimation_date=$_SESSION['estimation_date'];
$satuan_penghitungan=$_SESSION['satuan_penghitungan'];
$durasi=$_SESSION['durasi'];
$received_num=$_SESSION['received_num'];
$notes=$_SESSION['notes'];
$status_pengiriman="progress";
$sum_harga=$_SESSION['sum_harga'];
$waktu_pengiriman=$_SESSION['waktu_pengiriman'];

$kueri = mysqli_query($con, "INSERT INTO tbl_pengiriman (id_pengiriman, do_num, random_id, id_kota, id_dealer, id_mobil, id_driver, id_asst, do_print_date, exit_date, date_terima_ekspedisi, estimation_date, received_num, satuan_penghitungan, durasi, status_pengiriman, sum_harga, notes, nama_gudang, waktu_pengiriman) VALUES ('','$do_num','$random_id','$id_kota','$id_dealer','$id_mobil','$id_driver','$id_asst','$do_print_date','$exit_date','$date_terima_ekspedisi','$estimation_date','$received_num','$satuan_penghitungan','$durasi','$status_pengiriman','$sum_harga','$notes','$nama_gudang','$waktu_pengiriman')");
if($kueri)
{
	header("location:admin.php?page=pengirimanprogress");
}
else
{
	echo "ERROR SILAHKAN HUBUNGI ADMINISTRATOR";
}
?>