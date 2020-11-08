<?php
include('config.php');
$produk_name= $_REQUEST['produk_name'];
$weight= $_REQUEST['weight'];
//$volumetric= $_REQUEST['volumetric'];

$panjang= $_REQUEST['panjang'];
$lebar= $_REQUEST['lebar'];
$tinggi= $_REQUEST['tinggi'];

$volumetric=round($_REQUEST['volumetric']);

//echo $volumetric;
$packing_status= $_REQUEST['packing_status'];
$id_kategori_produk= $_REQUEST['id_kategori_produk'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_produk_katalog WHERE produk_name = '$produk_name'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_produk_katalog (id_produk_katalog, produk_name, weight, volumetric, panjang, lebar, tinggi, packing_status, id_kategori_produk) VALUES ('','$produk_name','$weight','$volumetric','$panjang','$lebar','$tinggi','$packing_status','$id_kategori_produk')");
	if($kueri2)
	{
		header("location:admin.php?page=produkkatalog");
	}
	else
	{
		header("location:admin.php?page=addprodukkatalog&&error=2");
	}
}
else
{
	header("location:admin.php?page=addprodukkatalog&&error=1&&produk_name=$produk_name");

}
?>