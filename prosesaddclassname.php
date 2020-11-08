<?php
include('config.php');

$class_name = $_REQUEST['class_name'];
$weight_class = $_REQUEST['weight_class'];

if($class_name == NULL)
{
	header('location:admin.php?page=addclassname&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_class_name (id_class_name, class_name, weight_class) VALUES ('','$class_name', '$weight_class')");

	if($kueri)
	{
		header('location:admin.php?page=configuration&&tab=cn');
	}
	else
	{
		echo("error");
	}
}
?>