<?php
include('config.php');

$id = $_REQUEST['id'];
$class_type= $_REQUEST['class_type'];
$price= $_REQUEST['price'];

$kueri = mysqli_query($con, "UPDATE tbl_class_pricelist SET class_type = '$class_type', price= '$price' WHERE id_class_pricelist = '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration&&tab=cpl');
}
else
{
	echo("error");
}
?>