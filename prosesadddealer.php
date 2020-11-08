<?php
include('config.php');
$id_provinsi= $_REQUEST['id_provinsi'];
$id_kota = $_REQUEST['id_kota'];
$id_ekspedisi = $_REQUEST['id_ekspedisi'];
$nama_dealer = $_REQUEST['nama_dealer'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_dealer WHERE nama_dealer = '$nama_dealer'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_dealer (id_dealer, nama_dealer, id_kota, id_ekspedisi) VALUES ('','$nama_dealer','$id_kota','$id_ekspedisi')");
	if($kueri2)
	{
		header("location:admin.php?page=dealer");
	}
	else
	{
		header("location:admin.php?page=adddealer&&subpage=2&&error=2");
	}
}
else
{
	header("location:admin.php?page=adddealer&&subpage=2&&error=1&&nama_dealer=$nama_dealer&&id_provinsi=$id_provinsi");

}
?>