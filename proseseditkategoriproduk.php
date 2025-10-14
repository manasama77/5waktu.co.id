<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_kategori_produk = $_REQUEST['nama_kategori_produk'];
$weight_class = $_REQUEST['weight_class'];

$kueri = mysqli_query($con, "UPDATE tbl_kategori_produk SET nama_kategori_produk = '$nama_kategori_produk', weight_class = '$weight_class' WHERE id_kategori_produk= '$id'");

if($kueri)
{
	header('location:admin.php?page=kategoriproduk');
}
else
{
	echo("Gagal mengedit kategori produk");
}
?>