<?php
include('config.php');

$id_temp_produk = $_REQUEST['id_temp_produk'];

$id_provinsi=$_REQUEST['id_provinsi'];
$id_kota= $_REQUEST['id_kota'];
$id_dealer= $_REQUEST['id_dealer'];
$do_num= $_REQUEST['do_num'];
$id_mobil= $_REQUEST['id_mobil'];
$id_driver= $_REQUEST['id_driver'];
$id_asst= $_REQUEST['id_asst'];
$status= $_REQUEST['status'];

$random_id= $_REQUEST['random_id'];

$kueri = mysqli_query($con, "DELETE FROM temp_produk WHERE id_temp_produk = '$id_temp_produk'");

if($kueri)
{
	if(isset($_REQUEST['id']))
	{
		header("location:admin.php?$status=$status&&page=editpengirimanprogress&&random_id=$random_id&&id=$_REQUEST[id]");
	}
	else
	{
		header("location:admin.php?page=checkout&&id_provinsi=$id_provinsi&&id_kota=$id_kota&&id_dealer=$id_dealer&&do_num=$do_num&&id_mobil=$id_mobil&&id_driver=$id_driver&&id_asst=$id_asst&&random_id=$random_id");
	}
	
}
else
{
	echo("error");
}
?>