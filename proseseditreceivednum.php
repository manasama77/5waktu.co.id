<?php
include('config.php');

$id_pengiriman = $_REQUEST['id_pengiriman'];
$received_num = $_REQUEST['received_num'];

$kueri = mysqli_query($con, "UPDATE tbl_pengiriman SET received_num = '$received_num' WHERE id_pengiriman = '$id_pengiriman'");

if($kueri)
{
	header('location:admin.php?page=pengirimanprogress');
}
else
{
	echo("Gagal mengedit Received Num");
}
?>