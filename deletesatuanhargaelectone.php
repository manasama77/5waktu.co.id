<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_satuan_harga_electone WHERE id_satuan_harga_electone = '$id'");

if($kueri)
{
	header("location:admin.php?page=satuanhargaelectone");
}
else
{
	echo("error");
}
?>