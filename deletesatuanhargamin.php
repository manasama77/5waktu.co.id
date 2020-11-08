<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_satuan_harga_minimum WHERE id_satuan_harga_minimum = '$id'");

if($kueri)
{
	header("location:admin.php?page=satuanhargamin");
}
else
{
	echo("error");
}
?>