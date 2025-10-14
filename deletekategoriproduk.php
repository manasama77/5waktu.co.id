<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_kategori_produk WHERE id_kategori_produk = '$id'");

if($kueri)
{
	header("location:admin.php?page=kategoriproduk");
}
else
{
	echo("error");
}
?>