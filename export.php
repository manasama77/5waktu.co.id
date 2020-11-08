<style>
td{ font-size:12px; }
</style>
<?php
$batas=10;
if(isset($_GET['halaman']))
{
	$halaman=$_GET['halaman'];
	$posisi = ($halaman-1) * $batas;
}else{
	$posisi=0;
	$halaman=1;
}
$no=$posisi+1;
?>
<?php
if(isset($_GET['pencarian'])){
	$keyword = $_REQUEST['keyword'];
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama_driver LIKE '%$keyword%' ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}else{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}
$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-file-excel-o"></i><h3>Export Data to Excel - <font color="blue">Harian</font></h3>
</div>
<div class="widget-content">	<form id="form1" name="form1" method="post" action="exportharian2.php" target="_blank">
	<table class="table table-hover table-bordered">		<tr>
			<td style="width:100px;">Select Date</td>
			<td>				<input name="excel_harian" type="text" id="excel_harian" />&nbsp;&nbsp;&nbsp;<input type="submit" name="export" id="button" value="Export" class="btn btn-primary btn-sm" />			</td>		</tr>	</table>	</form>
	<hr />
</div>