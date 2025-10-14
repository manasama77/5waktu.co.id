<?php
$connect_error = 'Sorry, we\'re experiencing connection issues.';
$con = mysqli_connect('localhost', 'manasama_lwl', 'admin!@#');
mysqli_select_db($con, 'manasama_lwldb') or die(mysqli_error($con));
?>