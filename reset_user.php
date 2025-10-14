<?php
include('config.php');
// GET POST REQUEST
$id_user      = $_REQUEST['id_user_reset'];
$new_password = md5($_REQUEST['new_password']);
// GET POST REQUEST

$sql   = "
UPDATE tbl_user SET
password = '" . $new_password . "'
WHERE id_user = '" . $id_user . "'
";
$exec = mysqli_query($con, $sql);

if ($exec) {
	header('location:admin.php?page=listuser');
} else {
	echo "Proses Update User Gagal, silahkan coba kembali!";
}
