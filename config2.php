<?php
$connect_error = 'Sorry, we\'re experiencing connection issues.';
$con = mysqli_connect('localhost', 'root', '');
mysqli_select_db($con, 'lwldb') or die(mysqli_error($con));
?>