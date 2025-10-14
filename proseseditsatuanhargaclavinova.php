<?php
include('config.php');

$id = $_REQUEST['id'];
$satuan_harga_clavinova= $_REQUEST['satuan_harga_clavinova'];

$kueri = mysqli_query($con, "UPDATE tbl_satuan_harga_clavinova SET satuan_harga_clavinova = '$satuan_harga_clavinova' WHERE id_satuan_harga_clavinova= '$id'");

if($kueri)
{
	header('location:admin.php?page=satuanhargaclavinova');
}
else
{
	echo("Gagal mengedit Satuan Harga Clavinova");
}
?>