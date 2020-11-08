<style>

td{ font-size:12px; }

</style>

<div class="container">

	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Laporan Pengiriman - <font color="blue">Progress</font></h3></div>

<div class="widget-content">

	<?php

		if($_SESSION['login']['level'] == "super_admin" || $_SESSION['login']['level'] == "staff"){

		?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>

		<td align="left">

			<h3><a href="admin.php?page=addpengiriman1">

			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Pengiriman</a></h3>

		</td>

	</tr>

	</table>

	<?php

	}

	?>

<div class="table-responsive">

<table id="progresslist" width="100%" class="table table-responsive table-hover table-bordered small">

<thead>

	<tr>

		<th style="text-align:center;">DO Num</th>

		<th style="text-align:center;">Warehouse</th>

		<th style="text-align:center;">DO Print Date</th>

		<th style="text-align:center;">Exit Date</th>

		<th style="text-align:center;">Estimation Date</th>

		<th style="text-align:center;">Dealer</th>

		<th style="text-align:right;">Total Cost (IDR)</th>

		<th id="conlist" style="text-align:center;"><i class="fa fa-gear"></i></th>

	</tr>

</thead>

</table>

</div>

</div>

</div>



<div id="modalnyaprog"></div>