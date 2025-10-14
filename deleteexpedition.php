<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_expedition WHERE id_expedition = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration");
}
else
{
	echo("error");
}
?>