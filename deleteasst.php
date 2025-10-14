<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_asst WHERE id_asst = '$id'");

if($kueri)
{
	header("location:admin.php?page=asst");
}
else
{
	echo("error");
}
?>