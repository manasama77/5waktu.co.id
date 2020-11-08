<?php
include('config.php');

$current_status=$_REQUEST['current_status'];

$do_num=$_REQUEST['do_num'];
$do_print_date=$_REQUEST['do_print_date'];
$exit_date=$_REQUEST['exit_date'];
$received_date=$_REQUEST['received_date'];
$received_num=$_REQUEST['received_num'];
$description=$_REQUEST['description'];

$duration=$_REQUEST['duration'];
$id= $_REQUEST['id'];

if(isset($exit_date))
{
	$date=$exit_date;

	$date = strtotime($date);
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
	//echo $estimation_date;
}
else
{
	$estimation_date="";
}

$late="";
if($do_print_date=='0000-00-00' && $exit_date=='0000-00-00' && $received_date=='0000-00-00')
{
	$status="waiting";
	//echo "a";
}
elseif($do_print_date!=='0000-00-00' && $exit_date=='0000-00-00' && $received_date=='0000-00-00')
{
	$status="waiting";
	//echo "b";
}
elseif($do_print_date!=='0000-00-00' && $exit_date!=='0000-00-00' && $received_date=='0000-00-00')
{
	$status="progress";
}
elseif($do_print_date!=='0000-00-00' && $exit_date!=='0000-00-00' && $received_date!=='0000-00-00')
{
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

}
//echo $status;
$kueri=mysqli_query($con,
"update tbl_report set
do_num = '$do_num',
do_print_date = '$do_print_date',
exit_date= '$exit_date',
received_date= '$received_date',
received_num= '$received_num',
description= '$description',
status= '$status',
late= '$late',
estimation_date= '$estimation_date'
where id_report='$id'
");

if($kueri)
{
	//echo ("berhasil");
	header('location:admin.php?page=pengiriman&&status='.$status);
}
else
{
	echo("<br>ERROR edit data pengiriman");
}
?>