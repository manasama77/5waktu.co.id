<?php
include('config.php');

$class_type= $_REQUEST['class_type'];
$weight_class= $_REQUEST['weight_class'];
//$id_region= $_REQUEST['id_region'];
//$id_class_type= $_REQUEST['id_class_type'];

//echo $warna;
//echo ("<br>");

if($class_type == NULL)
{
	header('location:admin.php?page=addclassprice&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_class_price (id_class_price, class_type, weight_class, id_region, id_class_type, price) VALUES ('','$class_type', '$weight_class', '', '', '')");

	if($kueri)
	{
		header('location:admin.php?page=configuration');
	}
	else
	{
		echo("error");
	}
}

?>