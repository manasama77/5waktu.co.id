<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_ekspedisi WHERE id_ekspedisi = '$id'");

if($kueri)
{
	header("location:admin.php?page=ekspedisi");
}
else
{
	echo("error");
}
?>