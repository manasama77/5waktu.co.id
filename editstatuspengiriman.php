<?php
include('config.php');

$id = $_REQUEST['id'];
$status = $_REQUEST['status'];
if($status == "pengiriman")
{
	$kueri = mysql_query("UPDATE tbl_pengiriman SET status = 'terkirim' WHERE id_pengiriman = '$id'");
}
elseif($status == "terkirim")
{
	$kueri = mysql_query("UPDATE tbl_pengiriman SET status = 'pengiriman' WHERE id_pengiriman = '$id'");
}
else
{
	echo("error kueri");
}

if($kueri)
{
	header("location:admin.php?page=pengiriman");
}
else
{
	echo("error");
}
?>