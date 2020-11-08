<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_user WHERE id_user = '$id'");

if($kueri)
{
	header("location:admin.php?page=user");
}
else
{
	echo("error");
}
?>