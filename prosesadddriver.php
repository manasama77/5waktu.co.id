<?php
include('config.php');
$nama_driver= $_REQUEST['nama_driver'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama_driver = '$nama_driver'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_driver (id_driver, nama_driver) VALUES ('','$nama_driver')");
	if($kueri2)
	{
		header("location:admin.php?page=driver");
	}
	else
	{
		header("location:admin.php?page=adddriver&&error=2");
	}
}
else
{
	header("location:admin.php?page=adddriver&&error=1&&nama_driver=$nama_driver");

}
?>