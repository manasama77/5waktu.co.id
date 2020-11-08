<?php
include('config.php');

$id = $_REQUEST['id'];
$id_product_name= $_REQUEST['id_product_name'];
$id_class_price= $_REQUEST['id_class_price'];
$id_region= $_REQUEST['id_region'];
$price= $_REQUEST['price'];
$type= $_REQUEST['type'];
$perkalian= $_REQUEST['perkalian'];

if($type == 'v' | $type == 'k' | $type == 'j')
{
	if($perkalian == NULL)
	{
		$perkalian == 1;
	}
}
elseif($type == 'p')
{
	if(isset($perkalian))
	{
		$perkalian == "";
	}
}

$kueri = mysqli_query($con, "UPDATE tbl_product_price_list SET id_product_catalog = '$id_product_name', id_class_price= '$id_class_price', id_region= '$id_region', price= '$price', type= '$type', perkalian= '$perkalian' WHERE id_product_price_list = '$id'");

if($kueri)
{
	header('location:admin.php?page=pricelist');
}
else
{
	echo("error");
}
?>