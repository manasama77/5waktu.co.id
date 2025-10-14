<?php
include('config.php');

$nama_kota = $_REQUEST['nama_kota'];
$id_provinsi = $_REQUEST['id_provinsi'];
$durasi = $_REQUEST['durasi'];
$satuan_penghitungan = $_REQUEST['satuan_penghitungan'];

$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_kota WHERE nama_kota = '$nama_kota'");
$row = mysqli_num_rows($kueri_cek);

if($row == NULL)
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_kota (id_kota, nama_kota, id_provinsi, durasi, satuan_penghitungan) VALUES ('','$nama_kota','$id_provinsi','$durasi','$satuan_penghitungan')");

	if($kueri)
	{
		header('location:admin.php?page=kota');
	}
	else
	{
		header("location:admin.php?page=addkota&&error=2&&nama_kota=$nama_kota");
	}
}
else
{
	header("location:admin.php?page=addkota&&error=1&&nama_kota=$nama_kota");
}



?>