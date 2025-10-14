<?php
$from="2016-08-18";
$to="2016-08-16";
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
	echo $late;
	?>