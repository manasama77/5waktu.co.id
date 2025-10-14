<?php
include('config.php');

$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "DELETE FROM tbl_barang WHERE id_barang = '$id'");

if($kueri)
{
	header("location:admin.php?page=configuration#listbarang");
}
else
{
	echo("error");
}
?>