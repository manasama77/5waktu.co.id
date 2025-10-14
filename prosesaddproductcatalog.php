<?php
include('config.php');

$product_name= $_REQUEST['product_name'];
$weight= $_REQUEST['weight'];
$volumetric= $_REQUEST['volumetric'];
$panjang= $_REQUEST['panjang'];
$lebar= $_REQUEST['lebar'];
$tinggi= $_REQUEST['tinggi'];
$packing_status= $_REQUEST['packing_status'];
$id_class_name = $_REQUEST['id_class_name'];

//echo $id_class_price;
//echo ("<br>");

if($product_name == NULL)
{
	header('location:admin.php?page=addproductcatalog&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_product_catalog (id_product_catalog, product_name, weight, volumetric, panjang, lebar, tinggi, packing_status, id_class_name) VALUES ('','$product_name', '$weight', '$volumetric', '$panjang', '$lebar', '$tinggi', '$packing_status', '$id_class_name')");

	if($kueri)
	{
		header('location:admin.php?page=product');
	}
	else
	{
		echo("error");
	}
}

?>