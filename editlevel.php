<?php
include('config.php');

$id = $_REQUEST['id'];
$level = $_REQUEST['level'];
if($level == "admin")
{
	$kueri = mysqli_query($con, "UPDATE tbl_user SET level = 'staff' WHERE id_user = '$id'");
}
elseif($level == "staff")
{
	$kueri = mysqli_query($con, "UPDATE tbl_user SET level = 'admin' WHERE id_user = '$id'");
}
else
{
	echo("Guest Tidak dapat diganti, silahkan hubungi administrator untuk mengganti");
}

if($kueri)
{
	header("location:admin.php?page=user");
}
else
{
	echo("error");
}
?>