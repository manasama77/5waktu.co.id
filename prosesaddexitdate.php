<?php
include('config.php');

$id_report= $_REQUEST['id_report'];
$exit_date= $_REQUEST['exit_date'.$id_report];
$duration= $_REQUEST['duration'];

$status="progress";

$date = strtotime($exit_date);
	$is_sunday = date('l', $date) == 'Sunday';
	for($i=0;$i<$duration;$i++)
	{
		if($is_sunday)
		{
			$date = strtotime('+1 days', $date);
		}
		$date = strtotime('+1 days', $date);
	}
$estimation_date=date('Y-m-d', $date);

$kueri=mysqli_query($con, "update tbl_report set exit_date = '$exit_date', status='$status', estimation_date='$estimation_date' where id_report='$id_report'");

if($kueri)
{
	header("location:admin.php?page=pengiriman&&status=progress");
}
else
{
	echo"Gagal menambahkan exit date";
}
?>