<?php
include('config.php');

$id=$_REQUEST['id'];
$sum_harga=$_REQUEST['sum_harga'];
$status=$_REQUEST['status'];

$kueri = mysqli_query($con, "UPDATE tbl_pengiriman SET sum_harga = '$sum_harga' WHERE id_pengiriman = '$id'");
if($kueri)
{
	if($status=="delivered")
	{
		header("location:admin.php?page=pengirimandelivered");
	}
	else
	{
		header("location:admin.php?page=pengirimanprogress");
	}
	
}
else
{
	echo "ERROR SILAHKAN HUBUNGI ADMINISTRATOR";
}
?>