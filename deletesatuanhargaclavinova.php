<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_satuan_harga_clavinova WHERE id_satuan_harga_clavinova = '$id'");

if($kueri)
{
	header("location:admin.php?page=satuanhargaclavinova");
}
else
{
	echo("error");
}
?>