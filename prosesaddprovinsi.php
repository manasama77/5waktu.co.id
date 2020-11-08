<?php
include('config.php');

$nama_provinsi = $_REQUEST['nama_provinsi'];

$kueri = mysqli_query($con, "INSERT INTO tbl_provinsi (id_provinsi, nama_provinsi) VALUES ('','$nama_provinsi')");

if($kueri)
{
	header('location:admin.php?page=provinsi');
}
else
{
	echo("error");
}

?>