<?php
include('config.php');

$id_report= $_REQUEST['id_report'];
$do_print_date= $_REQUEST['do_print_date'.$id_report];

$status="waiting";

$kueri=mysqli_query($con, "update tbl_report set do_print_date = '$do_print_date', status='$status' where id_report='$id_report'");

if($kueri)
{
	header("location:admin.php?page=pengiriman&&status=waiting");
}
else
{
	echo"Gagal menambahkan exit date";
}
?>