<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_min_pricelist WHERE id_min_pricelist = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration&&tab=mpl");
}
else
{
	echo("error");
}
?>