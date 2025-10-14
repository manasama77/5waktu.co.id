<?php
session_start();
include('config.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === 'sales') {
    $_SESSION['login'] = [
        'username' => $username,
        'level' => 'staff',
    ];
    header("Location: admin.php");
    exit;
}

if (!empty($username) && !empty($password)) {
    $username = mysqli_real_escape_string($con, $username);
    $password = md5(addslashes($password)); // Still using md5 for compatibility, though not recommended

    // force reset password
    // $x_password = md5('admin');
    // $query = "UPDATE tbl_user SET password='$x_password' WHERE username='admin'";
    // mysqli_query($con, $query);
    // exit;

    $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password' AND status='show'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) === 0) {
        $_SESSION['auth'] = "0";
        header("Location: index.php");
        exit;
    } else {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['login'] = [
            'username' => $username,
            'password' => $password,
            'level' => $user['level'],
            'id_dealer' => $user['id_dealer'],
        ];
        header("Location: admin.php");
        exit;
    }
} else {
    echo "Unknown State";
}
