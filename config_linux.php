<?php
$connect_error = 'Sorry, we\'re experiencing connection issues.';
$con = mysqli_connect('localhost', 'adam', '591990');
mysqli_select_db($con, 'lwldb') or die(mysqli_error($con));
