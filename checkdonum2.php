<?php
include('config.php');

$random_id= $_SESSION['random_id'];
	$nama_gudang=$_SESSION["nama_gudang"];
	$id_provinsi=$_SESSION["id_provinsi"];
	$id_kota=$_SESSION['id_kota'];
	
	$_SESSION["id_dealer"]=$_REQUEST['id_dealer'];
	$_SESSION["do_num"]=$_REQUEST['do_num'];
	$_SESSION["id_mobil"]=$_REQUEST['id_mobil'];
	$_SESSION["id_driver"]=$_REQUEST['id_driver'];
	$_SESSION["id_asst"]=$_REQUEST['id_asst'];
	$_SESSION["do_print_date1"]=$_REQUEST['do_print_date'];
	$_SESSION["exit_date1"]=$_REQUEST['exit_date'];
	$_SESSION["date_terima_ekspedisi"]=$_REQUEST['date_terima_ekspedisi'];
	$_SESSION["received_num"]=$_REQUEST['received_num'];
	$_SESSION["notes"]=$_REQUEST['notes'];
	$_SESSION["waktu_pengiriman"]=$_REQUEST['waktu_pengiriman'];
	
	$do_num=$_SESSION['do_num'];
	$received_num=$_REQUEST['received_num'];
	$notes=$_REQUEST['notes'];
	$do_print_date1=$_REQUEST['do_print_date'];
	$exit_date1=$_REQUEST['exit_date'];
	$date_terima_ekspedisi=$_REQUEST['date_terima_ekspedisi'];
	$waktu_pengiriman=$_REQUEST['waktu_pengiriman'];

if(isset($_POST['do_num']))
{
 $name=$_POST['do_num'];
 $id_kota=$_REQUEST['id_kota'];

 $checkdata=" SELECT do_num FROM tbl_pengiriman WHERE do_num='$name' ";

 $query=mysqli_query($con, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
   header('Location:admin.php?page=addpengiriman3&&alert=duplicate&&id_kota='.$id_kota);
 }
 else
 {
  header('Location:admin.php?page=addpengiriman4');
 }
}
?>