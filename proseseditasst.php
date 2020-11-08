<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_asst = $_REQUEST['nama_asst'];

$kueri = mysqli_query($con, "UPDATE tbl_asst SET nama_asst = '$nama_asst' WHERE id_asst = '$id'");

if($kueri)
{
	header('location:admin.php?page=asst');
}
else
{
	echo("Gagal mengedit Assistant");
}
?>