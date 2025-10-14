<?php
include('config.php');

$id_report= $_REQUEST['id_report'];
$received_date= $_REQUEST['received_date'.$id_report];
//$received_date= "2016-08-05";

$estimation_date= $_REQUEST['estimation_date'];
//$estimation_date= "2016-08-06";

$status="delivered";

$from=$estimation_date; //perkiraan barang sampai atau estimation date
$to=$received_date; //barang diterima atau received date
function CountSunday()
{
  
	$start_date = strtotime('$from');
    $end_date = strtotime('$to');

    $start_week = date('W', $start_date);
    $end_week = date('W', $end_date); 

    $start_year = date('Y', $start_date);
    $end_year = date('Y', $end_date);
    $years = $end_year-$start_year;

    if($years == 0){
        $weeks_past = $end_week-$start_week+1;
    }
    if($years == 1){
        $weeks_past = (52-$start_week+1)+$end_week;
    }
    if($years > 1){
        $weeks_past = (52-$start_week+1)+$end_week+($years*52);
    }

    return $weeks_past;
}


$a=CountSunday();
//echo $a;
//echo "<br>";

$datetime1 = new DateTime($from);
$datetime2 = new DateTime($to);
$interval = $datetime2->diff($datetime1);
$late =  $interval->format('%r%a');
//echo $late;
if($late<0)
{
	$late = $late+$a;
}
elseif($late>0)
{
	$late = $late-$a;
}
else
{
	$late=0;
}
//echo $late;
//echo "<br>";
//echo $late;

$kueri=mysqli_query($con, "update tbl_report set received_date = '$received_date', status='$status', late='$late' where id_report='$id_report'");

if($kueri)
{
	header("location:admin.php?page=pengiriman&&status=delivered");
}
else
{
	echo"Gagal menambahkan received date";
}
?>