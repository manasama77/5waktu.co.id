<?php
include('config.php');

$id = $_REQUEST['id'];
$product_name= $_REQUEST['product_name'];
$weight= $_REQUEST['weight'];
$volumetric= $_REQUEST['volumetric'];
$panjang= $_REQUEST['panjang'];
$lebar= $_REQUEST['lebar'];
$tinggi= $_REQUEST['tinggi'];
$packing_status= $_REQUEST['packing_status'];
$id_class_name= $_REQUEST['id_class_name'];

$kueri = mysqli_query($con, "UPDATE tbl_product_catalog SET product_name = '$product_name', weight= '$weight', volumetric= '$volumetric', panjang= '$panjang', lebar= '$lebar', tinggi= '$tinggi', packing_status= '$packing_status', id_class_name= '$id_class_name' WHERE id_product_catalog = '$id'");

if($kueri)
{
	header('location:admin.php?page=product');
}
else
{
	echo("error");
}
?>