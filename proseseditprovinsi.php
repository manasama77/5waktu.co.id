<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_provinsi= $_REQUEST['nama_provinsi'];

$kueri = mysqli_query($con, "UPDATE tbl_provinsi SET nama_provinsi = '$nama_provinsi' WHERE id_provinsi = '$id'");

if($kueri)
{
	header('location:admin.php?page=provinsi');
}
else
{
	echo("Gagal mengedit provinsi");
}
?>