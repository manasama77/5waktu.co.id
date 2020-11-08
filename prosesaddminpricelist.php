<?php
include('config.php');

$id_region = $_REQUEST['id_region'];
$price_list = $_REQUEST['price_list'];

$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_min_pricelist WHERE id_region = '$id_region'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_min_pricelist (id_min_pricelist, id_region, price_list) VALUES ('','$id_region','$price_list')");
	
	if($kueri)
	{
		header('location:admin.php?page=configuration&&tab=mpl');
	}
	else
	{
		echo("error");
	}
}
else
{
	header("location:admin.php?page=addminpricelist&&error=1&&id_region=$id_region");
}
?>