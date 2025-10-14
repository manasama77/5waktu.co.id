<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_expedition= $_REQUEST['nama_expedition'];
$duration= $_REQUEST['duration'];

$kueri = mysqli_query($con, "UPDATE tbl_expedition SET nama_expedition = '$nama_expedition', duration = '$duration' WHERE  id_expedition= '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration&&tab=expedition');
}
else
{
	echo("error");
}
?>