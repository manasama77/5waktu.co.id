<?php
include('config.php');

$id = $_REQUEST['id'];
$id_kategori_produk= $_REQUEST['id_kategori_produk'];
$satuan_harga= $_REQUEST['satuan_harga'];

$kueri = mysqli_query($con, "UPDATE tbl_satuan_harga_kota SET id_kategori_produk = '$id_kategori_produk', satuan_harga = '$satuan_harga' WHERE id_satuan_harga_kota= '$id'");

if($kueri)
{
	header('location:admin.php?page=satuanhargakota');
}
else
{
	echo("Gagal mengedit Satuan Harga Kota");
}
?>