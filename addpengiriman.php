<?php
include('config.php');
?>
<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Add Pengiriman Barang</h3>
</div>

<div class="widget-content">
<?php
if(isset($_REQUEST['sub']))
{
	$sub = $_REQUEST['sub'];
	if($sub == '0')
	{
		echo("<div class=\"form-actions\">");
		include('formpengiriman0.php');
		echo("</div>");
	}elseif($sub == '1')
	{
		echo("<div class=\"form-actions\">");
		include('formpengiriman1.php');
		echo("</div>");
	}elseif($sub == 2){
		echo("<div class=\"form-actions\">");
		include('formpengiriman2.php');
		echo("</div>");
	}
}
?>
</div>