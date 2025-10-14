<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_driver WHERE id_driver = '$id'");

if($kueri)
{
	header("location:admin.php?page=driver");
}
else
{
	echo("error");
}
?>