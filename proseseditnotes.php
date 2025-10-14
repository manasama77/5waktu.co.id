<?php
include('config.php');

$id_pengiriman = $_REQUEST['id_pengiriman'];
$notes = $_REQUEST['notes'];

$kueri = mysqli_query($con, "UPDATE tbl_pengiriman SET notes = '$notes' WHERE id_pengiriman = '$id_pengiriman'");

if($kueri)
{
	header('location:admin.php?page=pengirimanprogress');
}
else
{
	echo("Gagal mengedit Notes, Silahkan hubungi administrator");
}
?>