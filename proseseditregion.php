<?php
include('config.php');

$id = $_REQUEST['id'];
$nama_region= $_REQUEST['nama_region'];
$satuan_volumetric= $_REQUEST['satuan_volumetric'];
$satuan_weight= $_REQUEST['satuan_weight'];
$satuan_volumetric_c= $_REQUEST['satuan_volumetric_c'];
$satuan_weight_c= $_REQUEST['satuan_weight_c'];

$kueri = mysqli_query($con, "UPDATE tbl_region SET nama_region = '$nama_region', satuan_volumetric = '$satuan_volumetric', satuan_weight = '$satuan_weight', satuan_volumetric_c = '$satuan_volumetric_c', satuan_weight_c = '$satuan_weight_c' WHERE  id_region= '$id'");

if($kueri)
{
	header('location:admin.php?page=configuration&&tab=region');
}
else
{
	echo("error");
}
?>