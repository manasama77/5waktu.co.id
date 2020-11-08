<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_kota WHERE id_kota = '$id'");

if($kueri)
{
	header("location:admin.php?page=kota");
}
else
{
	echo("error");
}
?>