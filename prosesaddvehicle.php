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
$period_stnk = $_REQUEST['period_stnk'];
//echo $period_stnk;
$bahan_bakar = $_REQUEST['bahan_bakar'];
$warna = $_REQUEST['warna'];
$id_driver = $_REQUEST['id_driver'];

//echo $warna;
//echo ("<br>");

if($no_polisi == NULL)
{
	header('location:admin.php?page=addvehicle&&error=1');
	//echo("<font color=\"#FF0000\"><b>Nama Driver harus di isi...</b></font>");
}
else
{
	$kueri = mysqli_query($con, "INSERT INTO tbl_vehicle (id_vehicle, no_polisi, merk, jenis, jumlah_ban, isi_silinder, tahun_pembuatan, no_rangka, no_mesin, period_stnk, bahan_bakar, warna, id_driver) VALUES ('','$no_polisi', '$merk', '$jenis', '$jumlah_ban', '$isi_silinder', '$tahun_pembuatan', '$no_rangka', '$no_mesin', '$period_stnk', '$bahan_bakar', '$warna', '$id_driver')");

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