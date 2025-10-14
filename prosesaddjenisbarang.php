<?php
include('config.php');

$nama_barang = $_REQUEST['nama_barang'];

$kueri = mysqli_query($con, "INSERT INTO tbl_barang (id_barang, nama_barang, status) VALUES ('','$nama_barang','show')");

if($kueri)
{
	header('location:admin.php?page=configuration');
}
else
{
	echo("error");
}
?>