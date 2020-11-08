<?php
include('config.php');
$received_date = $_REQUEST['received_date'];
$id_pengiriman = $_REQUEST['id_pengiriman'];
$estimation_date = $_REQUEST['estimation_date'];
$notes = $_REQUEST['notes'];
$from=$estimation_date; //perkiraan barang sampai atau estimation date
$to=$received_date; //barang diterima atau received date
$start = new DateTime($from);
$end = new DateTime($to);
$days = $start->diff($end, true)->days;
$sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
$datetime1 = new DateTime($from);
$datetime2 = new DateTime($to);
$interval = $datetime2->diff($datetime1);
$late =  $interval->format('%r%a');
if($late<0)
{
	$late = $late+$sundays;
	$status_penerimaan = "late";
}
elseif($late>0)
{
	$late = $late-$sundays;
	$status_penerimaan = "ontime";
}
else
{
	$late=0;
	$status_penerimaan = "ontime";
}
//echo $late;
$kueri = mysqli_query($con, "UPDATE tbl_pengiriman SET received_date = '$received_date', status_pengiriman = 'delivered', late = '$late', notes = '$notes', status_penerimaan = '$status_penerimaan' WHERE id_pengiriman = '$id_pengiriman'");
if($kueri)
{
	header('location:admin.php?page=pengirimanprogress');
}
else
{
	echo("error");
}
?>