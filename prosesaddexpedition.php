<?php
include('config.php');

$nama_expedition = $_REQUEST['nama_expedition'];
$duration = $_REQUEST['duration'];

if($nama_expedition == NULL)
{
	header('location:admin.php?page=addexpedition&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_expedition (id_expedition, nama_expedition, duration) VALUES ('','$nama_expedition','$duration')");

	if($kueri)
	{
		header('location:admin.php?page=configuration&&tab=expedition');
	}
	else
	{
		echo("error");
	}
}
?>