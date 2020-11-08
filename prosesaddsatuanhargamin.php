<?php
include('config.php');
$id_provinsi = $_REQUEST['id_provinsi'];
$id_kota= $_REQUEST['id_kota'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum AS shm LEFT JOIN tbl_kota AS kota ON shm.id_kota = kota.id_kota WHERE shm.id_kota = '$id_kota'");
$satuan_harga_minimum= $_REQUEST['satuan_harga_minimum'];
$row = mysqli_num_rows($kueri_cek);
if($row==NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_satuan_harga_minimum (id_satuan_harga_minimum, id_kota, satuan_harga_minimum) VALUES ('','$id_kota','$satuan_harga_minimum')");
	if($kueri2)
	{
		header("location:admin.php?page=satuanhargamin");
	}
	else
	{
		header('location:admin.php?page=addsatuanhargamin&&error=2');
	}
}
else
{
	$data_kota = mysqli_fetch_array($kueri_cek);
	$nama_kota = $data_kota['nama_kota'];
	$ccd="admin.php?page=addsatuanhargamin&&subpage=2&&error=1&&nama_kota=".$nama_kota."&&id_provinsi=$id_provinsi";
	header("location:$ccd");
}
?>