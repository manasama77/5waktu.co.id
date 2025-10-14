<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_mobil WHERE id_mobil = '$id'");

if($kueri)
{
	header("location:admin.php?page=mobil");
}
else
{
	echo("error");
}
?>