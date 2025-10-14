<?php
include('config.php');
$nama_ekspedisi= $_REQUEST['nama_ekspedisi'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_ekspedisi WHERE nama_ekspedisi = '$nama_ekspedisi'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_ekspedisi (id_ekspedisi, nama_ekspedisi) VALUES ('','$nama_ekspedisi')");
	if($kueri2)
	{
		header("location:admin.php?page=ekspedisi");
	}
	else
	{
		header("location:admin.php?page=addekspedisi&&error=2");
	}
}
else
{
	header("location:admin.php?page=addekspedisi&&error=1&&nama_ekspedisi=$nama_ekspedisi");

}
?>