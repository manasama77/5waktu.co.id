<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_kota = $_REQUEST['nama_kota'];
$id_provinsi = $_REQUEST['id_provinsi'];
$durasi = $_REQUEST['durasi'];
$satuan_penghitungan = $_REQUEST['satuan_penghitungan'];

$kueri = mysqli_query($con, "UPDATE tbl_kota SET nama_kota = '$nama_kota', id_provinsi = '$id_provinsi', durasi = '$durasi', satuan_penghitungan = '$satuan_penghitungan' WHERE id_kota = '$id'");

if($kueri)
{
	header('location:admin.php?page=kota');
}
else
{
	echo("Gagal mengedit kota");
}
?>