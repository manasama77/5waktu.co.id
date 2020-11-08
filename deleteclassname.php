<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_class_name WHERE id_class_name = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration&&tab=cn");
}
else
{
	echo("error");
}
?>