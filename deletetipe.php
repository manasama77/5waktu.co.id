<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_tipe_barang WHERE id_tipe_barang = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration");
}
else
{
	echo("error");
}
?>