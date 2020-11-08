<?php
include('config.php');

$id_region=$_REQUEST['id_region'];
$id_class_name=$_REQUEST['id_class_name'];
$class_type=$_REQUEST['class_type'];
$price=$_REQUEST['price'];

$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_class_pricelist WHERE id_class_name = '$id_class_name' and id_region = '$id_region'");
$row = mysqli_num_rows($kueri_cek);

if($row == NULL)
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_class_pricelist (id_class_pricelist, id_class_name, class_type, price, id_region) VALUES ('','$id_class_name','$class_type','$price','$id_region')");
	
	if($kueri)
	{
		header('location:admin.php?page=configuration&&tab=cpl');
	}
	else
	{
		echo("error");
	}
}
else
{
	header("location:admin.php?page=addclasspricelist&&error=1&&id_region=$id_region&&id_class_name=$id_class_name");
}
?>