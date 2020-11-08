<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_region WHERE id_region = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration&&tab=region");
}
else
{
	echo("error");
}
?>