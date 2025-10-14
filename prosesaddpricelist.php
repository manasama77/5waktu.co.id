<?php
include('config.php');

$id_product_name= $_REQUEST['id_product_name'];
$id_class_price= $_REQUEST['id_class_price'];
$id_region= $_REQUEST['id_region'];
$price= $_REQUEST['price'];
$perkalian = $_REQUEST['perkalian'];
$type = $_REQUEST['type'];

//echo $id_class_price;
//echo ("<br>");

if($price == NULL)
{
	header('location:admin.php?page=addpricelist&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri_cek = mysqli_query("SELECT ");
	$kueri = mysqli_query($con, "INSERT INTO tbl_product_price_list (id_product_price_list, id_product_catalog, id_class_price, id_region, type, price, perkalian) VALUES ('','$id_product_name', '$id_class_price', '$id_region', '$type', '$price', '$perkalian')");

	if($kueri)
	{
		header('location:admin.php?page=pricelist');
	}
	else
	{
		echo("error");
	}
}

?>