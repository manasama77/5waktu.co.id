<div class="container">
<div class="widget-content">
<?php
include('config.php');
?>
<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Add Tagihan Dealer</h3>
</div>

<div class="widget-content">
<?php
if(isset($_REQUEST['sub']))
{
	$sub = $_REQUEST['sub'];
	if($sub == '1')
	{
		echo("<div class=\"form-actions\">");
		include('formtagihandealer1.php');
		echo("</div>");
	}elseif($sub == 2){
		echo("<div class=\"form-actions\">");
		include('formtagihandealer2.php');
		echo("</div>");
	}elseif($sub == 3){
		echo("<div class=\"form-actions\">");
		include('formtagihandealer3.php');
		echo("</div>");
	}
}
?>
</div>
</div>
</div>