<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri_pengiriman = mysqli_query($con, "DELETE FROM tbl_pengiriman WHERE id_pengiriman = '$id'");
$kueri_temp_produk = mysqli_query($con, "DELETE FROM temp_produk WHERE random_id = '$random_id'");

if($kueri_pengiriman AND $kueri_temp_produk)
{
	header("location:admin.php?page=pengirimandelivered");
}
else
{
	echo("error");
}
?>