<?php
include('config.php');

$id = $_REQUEST['id'];
$id_region= $_REQUEST['id_region'];
$price_list= $_REQUEST['price_list'];

$kueri = mysqli_query($con, "UPDATE tbl_min_pricelist SET id_region = '$id_region', price_list = '$price_list' WHERE  id_min_pricelist = '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration&&tab=mpl');
}
else
{
	echo("error");
}
?>