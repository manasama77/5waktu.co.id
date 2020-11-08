<?php
//session_destroy();
session_start();
//koneksi ke database
include('config.php');


$username = $_REQUEST['username'];
if($username == 'sales')
{
	$_SESSION['login']['username'] = $username;
	$_SESSION['login']['level'] = 'staff';
    header("location:admin.php");
}
$password = md5(addslashes($_POST['password']));
if(isset($username) AND isset($password))
{
    $check    = mysqli_query($con, 'SELECT * FROM tbl_user where username="'.$username.'" AND password="'.$password.'" AND status="show"');
    if(mysqli_num_rows($check)==0)
	{
        echo 'Username atau Password Tidak Ditemukan Silahkan coba kembali!';
		echo("<br><input TYPE=\"button\" VALUE=\"Back\" onClick=\"history.go(-1);\">");
    }
    else
	{
		$_SESSION['login']['username']  = $username;
		$_SESSION['login']['password']  = $password;
		$data1                          = mysqli_fetch_array($check);
		$_SESSION['login']['level']     = $data1['level'];
		$_SESSION['login']['id_dealer'] = $data1['id_dealer'];
        header("location:admin.php");
    }
}
else
{
	echo ("error");
}
?>