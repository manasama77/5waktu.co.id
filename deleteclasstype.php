<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_class_type WHERE id_class_type = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration");
}
else
{
	echo("error");
}
?>