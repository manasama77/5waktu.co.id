<?php
include('config.php');

$id = $_REQUEST['id'];
$class_name= $_REQUEST['class_name'];
$weight_class= $_REQUEST['weight_class'];

$kueri = mysqli_query($con, "UPDATE tbl_class_name SET class_name = '$class_name', weight_class = '$weight_class' WHERE  id_class_name = '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration&&tab=cn');
}
else
{
	echo("error");
}
?>