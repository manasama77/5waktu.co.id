<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_driver = $_REQUEST['nama_driver'];

$kueri = mysqli_query($con, "UPDATE tbl_driver SET nama_driver = '$nama_driver' WHERE id_driver = '$id'");

if($kueri)
{
	header('location:admin.php?page=driver');
}
else
{
	echo("Gagal mengedit Driver");
}
?>