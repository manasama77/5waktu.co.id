<?php
include('config.php');
$id_provinsi = $_REQUEST['id_provinsi'];
$id_kota= $_REQUEST['id_kota'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone AS she LEFT JOIN tbl_kota AS kota ON she.id_kota = kota.id_kota WHERE she.id_kota = '$id_kota'");
$satuan_harga_electone= $_REQUEST['satuan_harga_electone'];
$row = mysqli_num_rows($kueri_cek);
if($row==NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_satuan_harga_electone (id_satuan_harga_electone, id_kota, satuan_harga_electone) VALUES ('','$id_kota','$satuan_harga_electone')");
	if($kueri2)
	{
		header("location:admin.php?page=satuanhargaelectone");
	}
	else
	{
		header('location:admin.php?page=addsatuanhargaelectone&&error=2');
	}
}
else
{
	$data_kota = mysqli_fetch_array($kueri_cek);
	$nama_kota = $data_kota['nama_kota'];
	$ccd="admin.php?page=addsatuanhargaelectone&&subpage=2&&error=1&&nama_kota=".$nama_kota."&&id_provinsi=$id_provinsi";
	header("location:$ccd");
}
?>