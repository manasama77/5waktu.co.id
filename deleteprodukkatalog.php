<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_produk_katalog WHERE id_produk_katalog = '$id'");
$kueri2 = mysqli_query($con, "DELETE FROM temp_produk WHERE id_produk_katalog = '$id'");

if($kueri)
{
	header("location:admin.php?page=produkkatalog");
}
else
{
	echo("error");
}
?>