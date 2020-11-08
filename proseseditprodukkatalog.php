<?php
include('config.php');

$id = $_REQUEST['id'];
$produk_name= $_REQUEST['produk_name'];
$weight= $_REQUEST['weight'];
//$volumetric= $_REQUEST['volumetric'];
$panjang= $_REQUEST['panjang'];
$lebar= $_REQUEST['lebar'];
$tinggi= $_REQUEST['tinggi'];
$volumetric=($panjang*$lebar*$tinggi)/4000;
$volumetric=round($volumetric);
$packing_status= $_REQUEST['packing_status'];
$id_kategori_produk= $_REQUEST['id_kategori_produk'];

$kueri = mysqli_query($con, "UPDATE tbl_produk_katalog SET produk_name = '$produk_name', weight = '$weight', volumetric = '$volumetric', panjang = '$panjang', lebar = '$lebar', tinggi = '$tinggi', packing_status = '$packing_status', id_kategori_produk = '$id_kategori_produk' WHERE id_produk_katalog= '$id'");

if($kueri)
{
	header('location:admin.php?page=produkkatalog');
}
else
{
	echo("Gagal mengedit Produk Katalog");
}
?>