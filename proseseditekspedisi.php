<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_ekspedisi = $_REQUEST['nama_ekspedisi'];

$kueri = mysqli_query($con, "UPDATE tbl_ekspedisi SET nama_ekspedisi = '$nama_ekspedisi' WHERE id_ekspedisi = '$id'");

if($kueri)
{
	header('location:admin.php?page=ekspedisi');
}
else
{
	echo("Gagal mengedit ekspedisi");
}
?>