<?php
include('config.php');

$id = $_REQUEST['id'];
$class_type= $_REQUEST['class_type'];
$weight_class= $_REQUEST['weight_class'];

$kueri = mysqli_query($con, "UPDATE tbl_class_price SET class_type = '$class_type', weight_class = '$weight_class' WHERE id_class_price = '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration');
}
else
{
	echo("error");
}
?>