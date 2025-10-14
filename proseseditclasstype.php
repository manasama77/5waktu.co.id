<?php
include('config.php');

$id = $_REQUEST['id'];
$class_type_name= $_REQUEST['class_type_name'];

$kueri = mysqli_query($con, "UPDATE tbl_class_type SET class_type_name = '$class_type_name' WHERE  id_class_type= '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration');
}
else
{
	echo("error");
}
?>