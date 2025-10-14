<?php
include('config.php');
$nama_kategori_produk= $_REQUEST['nama_kategori_produk'];
$weight_class= $_REQUEST['weight_class'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_kategori_produk WHERE nama_kategori_produk = '$nama_kategori_produk'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_kategori_produk (id_kategori_produk, nama_kategori_produk, weight_class) VALUES ('','$nama_kategori_produk','$weight_class')");
	if($kueri2)
	{
		header("location:admin.php?page=kategoriproduk");
	}
	else
	{
		header("location:admin.php?page=addkategoriproduk&&error=2");
	}
}
else
{
	header("location:admin.php?page=addkategoriproduk&&error=1&&nama_kategori_produk=$nama_kategori_produk");

}
?>