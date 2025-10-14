<style>
td{ font-size:12px; }
</style>
<?php
$batas=10;
if(isset($_GET['halaman'])){
	$halaman=$_GET['halaman'];
	$posisi = ($halaman-1) * $batas;
}else{
	$posisi=0;
	$halaman=1;
}
$no=$posisi+1;
if(isset($_GET['pencarian'])){
	$keyword = $_REQUEST['keyword'];
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama_driver LIKE '%$keyword%' ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}else{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}
$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-file-excel-o"></i><h3>Export Data to Excel - <font color="blue">Select Range Date</font></h3>
</div>
<div class="widget-content">
	<table class="table table-responsive table-hover table-bordered">	<tr>		<td colspan="6"><label class="control-label">Export All Data - Filter by Select Range Date</label></td>	</tr>	<tr>		<form id="form1" name="form1" method="post" action="exportmingguan44.php" target="_blank">			<td style="width:100px;">Select Start Date</td>			<td style="width:200px;"><input name="excel_start" type="text" id="excel_start" /></td>			<td style="width:100px;"> s/d </td>			<td style="width:100px;">Select End Date</td>			<td style="width:200px;"><input name="excel_end" type="text" id="excel_end" /></td>			<td><input type="submit" name="export" id="button" value="Export All Data" class="btn btn-primary btn-sm" /></td>		</form>	</tr>	<tr>		<td colspan="6">&nbsp;</td>	</tr>	<tr>		<td colspan="6"><label class="control-label">Export Progress Data - Filter by Select Range Date</label></td>	</tr>	<tr>		<form id="form1" name="form1" method="post" action="exportmingguan55.php" target="_blank">			<td style="width:100px;">Select Start Date</td>			<td style="width:200px;"><input name="excel_start1" type="text" id="excel_start1" /></td>			<td style="width:100px;"> s/d </td>			<td style="width:100px;">Select End Date</td>			<td style="width:200px;"><input name="excel_end1" type="text" id="excel_end1" /></td>			<td><input type="submit" name="export" id="button" value="Export All Data" class="btn btn-primary btn-sm" /></td>		</form>	</tr>	<tr>		<td colspan="6">&nbsp;</td>	</tr>	<tr>		<td colspan="6"><label class="control-label">Export Delivered Data - Filter by Select Range Date</label></td>	</tr>	<tr>		<form id="form1" name="form1" method="post" action="exportmingguan66.php" target="_blank">			<td style="width:100px;">Select Start Date</td>			<td style="width:200px;"><input name="excel_start2" type="text" id="excel_start2" /></td>			<td style="width:100px;"> s/d </td>			<td style="width:100px;">Select End Date</td>			<td style="width:200px;"><input name="excel_end2" type="text" id="excel_end2" /></td>			<td><input type="submit" name="export" id="button" value="Export All Data" class="btn btn-primary btn-sm" /></td>		</form>	</tr>	</table>
	<hr />
</div>