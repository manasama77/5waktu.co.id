<?php
include('config.php');

$nama_region= $_REQUEST['nama_region'];

$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_region WHERE nama_region = '$nama_region'");
$row = mysqli_num_rows($kueri_cek);

if($nama_region == NULL)
{
	header('location:admin.php?page=addregion&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	
	if($row == NULL)
	{
		$kueri = mysqli_query($con, "INSERT INTO tbl_region (id_region, nama_region) VALUES ('','$nama_region')");
		
		if($kueri)
		{
			header('location:admin.php?page=configuration&&tab=region');
		}
		else
		{
			echo("Proses tambah data regional error");
		}
	}
	else
	{
		header("location:admin.php?page=addregion&&error=1&&nama_region=$nama_region");
	}
}
?>