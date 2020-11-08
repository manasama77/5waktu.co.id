<?php
include('config.php');

$id = $_REQUEST['id'];
$no_polisi= $_REQUEST['no_polisi'];
$merk= $_REQUEST['merk'];
$jenis= $_REQUEST['jenis'];
$jumlah_ban= $_REQUEST['jumlah_ban'];
$isi_silinder= $_REQUEST['isi_silinder'];
$tahun_pembuatan= $_REQUEST['tahun_pembuatan'];
$no_rangka= $_REQUEST['no_rangka'];
$no_mesin= $_REQUEST['no_mesin'];
$period_stnk= $_REQUEST['period_stnk'];
$bahan_bakar= $_REQUEST['bahan_bakar'];
$warna= $_REQUEST['warna'];
$id_driver= $_REQUEST['id_driver'];

$kueri = mysqli_query($con, "UPDATE tbl_vehicle SET no_polisi = '$no_polisi', merk= '$merk', jenis= '$jenis', jumlah_ban= '$jumlah_ban', isi_silinder= '$isi_silinder', tahun_pembuatan= '$tahun_pembuatan', no_rangka= '$no_rangka', no_mesin= '$no_mesin', period_stnk= '$period_stnk', bahan_bakar= '$bahan_bakar', warna= '$warna', id_driver= '$id_driver' WHERE id_vehicle = '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration&&tab=vehicle');
}
else
{
	echo("error");
}
?>