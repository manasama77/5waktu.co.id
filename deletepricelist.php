<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_product_price_list WHERE id_product_price_list = '$id'");

if($kueri)
{
	header("location:admin.php?page=pricelist");
}
else
{
	echo("error");
}
?>