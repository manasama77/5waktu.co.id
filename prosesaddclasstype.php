<?php
include('config.php');

$class_type_name = $_REQUEST['class_type_name'];

if($class_type_name == NULL)
{
	header('location:admin.php?page=addclasstype&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_class_type (id_class_type, class_type_name) VALUES ('','$class_type_name')");

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