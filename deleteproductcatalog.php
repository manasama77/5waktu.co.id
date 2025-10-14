<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_product_catalog WHERE id_product_catalog = '$id'");

if($kueri)
{
	header("location:admin.php?page=product");
}
else
{
	echo("error");
}
?>