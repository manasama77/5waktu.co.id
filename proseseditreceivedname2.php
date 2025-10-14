<?php
include('config.php');

$id_pengiriman = $_REQUEST['id_pengiriman'];
$received_name = $_REQUEST['received_name'];

$kueri = mysqli_query($con, "UPDATE tbl_pengiriman SET received_name = '$received_name' WHERE id_pengiriman = '$id_pengiriman'");

if($kueri)
{
	header('location:admin.php?page=pengirimandelivered');
}
else
{
	echo("Gagal mengedit Received Name");
}
?>