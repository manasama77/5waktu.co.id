<?php
include('config.php');
$id_provinsi = $_REQUEST['id_provinsi'];
$id_kota= $_REQUEST['id_kota'];
$id_kategori_produk= $_REQUEST['id_kategori_produk'];
$satuan_harga= $_REQUEST['satuan_harga'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
$row = mysqli_num_rows($kueri_cek);
if($row==0)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_satuan_harga_kota (id_satuan_harga_kota, id_kota, id_kategori_produk, satuan_harga) VALUES ('','$id_kota','$id_kategori_produk','$satuan_harga')");
	if($kueri2)
	{
		header("location:admin.php?page=satuanhargakota");
	}
	else
	{
		header("location:admin.php?page=addsatuanhargakota&&error=2");
	}
}
else
{
	$data_kota = mysqli_fetch_array($kueri_cek);
	$nama_kota = $data_kota['nama_kota'];
	header("location:admin.php?page=addsatuanhargakota&&subpage=2&&error=1&&nama_kota=$nama_kota&&id_provinsi=$id_provinsi");

}
?>