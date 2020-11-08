<?php
include('config.php');
session_start();
$status=$_REQUEST['status'];
$id_temp_produk=$_REQUEST['id_temp_produk'];
$random_id= $_REQUEST['random_id'];
$total_harga= $_REQUEST['total_harga'];
$id_produk_katalog= $_REQUEST['id_produk_katalog'];

$kueri3 = mysqli_query($con, "UPDATE temp_produk SET total_harga = '$total_harga' WHERE id_temp_produk = '$id_temp_produk'");
if($kueri3)
{
	if(isset($_REQUEST['id']))
	{
		header("location:admin.php?status=$status&&page=editpengirimanprogress&&random_id=$random_id&&id=$_REQUEST[id]");
	}
	else
	{
		header("location:admin.php?page=checkout&&random_id=$random_id");
	}
	
}
else
{
	echo "ERROR SILAHKAN HUBUNGI ADMINISTRATOR";
}
?>