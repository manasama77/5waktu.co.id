<?php
include('config.php');

$id_pengiriman = $_REQUEST['id_pengiriman'];
$date_terima_ekspedisi = $_REQUEST['date_terima_ekspedisi'];

$kueri = mysqli_query($con, "UPDATE tbl_pengiriman SET date_terima_ekspedisi = '$date_terima_ekspedisi' WHERE id_pengiriman = '$id_pengiriman'");

if($kueri)
{
	header('location:admin.php?page=pengirimanprogress');
}
else
{
	echo("Gagal mengedit Date Terima Ekspedisi");
}
?>