<?php
include('config.php');

$no_polisi = $_REQUEST['no_polisi'];
$merk = $_REQUEST['merk'];
$jenis = $_REQUEST['jenis'];
$jumlah_ban = $_REQUEST['jumlah_ban'];
$isi_silinder = $_REQUEST['isi_silinder'];
$tahun_pembuatan = $_REQUEST['tahun_pembuatan'];
$no_rangka = $_REQUEST['no_rangka'];
$no_mesin = $_REQUEST['no_mesin'];
$masa_berlaku_stnk = $_REQUEST['masa_berlaku_stnk'];
$bahan_bakar = $_REQUEST['bahan_bakar'];
$warna = $_REQUEST['warna'];
$id_driver = $_REQUEST['id_driver'];

$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_mobil WHERE no_polisi = '$no_polisi'");
$row = mysqli_num_rows($kueri_cek);

if($row == NULL)
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_mobil (id_mobil, no_polisi, merk, jenis, jumlah_ban, isi_silinder, tahun_pembuatan, no_rangka, no_mesin, masa_berlaku_stnk, bahan_bakar, warna, id_driver) VALUES ('','$no_polisi', '$merk', '$jenis', '$jumlah_ban', '$isi_silinder', '$tahun_pembuatan', '$no_rangka', '$no_mesin', '$masa_berlaku_stnk', '$bahan_bakar', '$warna', '$id_driver')");

	if($kueri)
	{
		header('location:admin.php?page=mobil');
	}
	else
	{
		header("location:admin.php?page=addmobil&&error=2");
	}
}
else
{
	header("location:admin.php?page=addmobil&&error=1&&no_polisi=$no_polisi");
}

?>