<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_provinsi WHERE id_provinsi = '$id'");

if($kueri)
{
	header("location:admin.php?page=provinsi");
}
else
{
	echo("error");
}
?>