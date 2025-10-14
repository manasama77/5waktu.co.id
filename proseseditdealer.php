<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_dealer = $_REQUEST['nama_dealer'];
$id_ekspedisi = $_REQUEST['id_ekspedisi'];

$kueri = mysqli_query($con, "UPDATE tbl_dealer SET nama_dealer = '$nama_dealer', id_ekspedisi = '$id_ekspedisi' WHERE id_dealer = '$id'");

if($kueri)
{
	header('location:admin.php?page=dealer');
}
else
{
	echo("Gagal mengedit dealer");
}
?>