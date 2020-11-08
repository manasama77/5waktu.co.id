<style>
td{ font-size:12px; }
</style>
<?php
$batas=10;
if(isset($_GET['halaman']))
{
	$halaman=$_GET['halaman'];
	$posisi = ($halaman-1) * $batas;
}
else
{
	$posisi=0;
	$halaman=1;
}
	
$no=$posisi+1;
?>
<?php
if(isset($_GET['pencarian']))
{
	$keyword = $_REQUEST['keyword'];
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama_driver LIKE '%$keyword%' ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-file-excel-o"></i><h3>Export Data to Excel - <font color="blue">Monthly</font></h3>
</div>
<div class="widget-content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<form id="form1" name="form1" method="post" action="exportbulanan44.php" target="_blank">
		Select Month
		<select name="excel_bulanan" id="excel_bulanan">
		  <option value="1">Januari</option>
		  <option value="2">Februari</option>
		  <option value="3">Maret</option>
		  <option value="4">April</option>
		  <option value="5">Mei</option>
		  <option value="6">Juni</option>
		  <option value="7">Juli</option>
		  <option value="8">Agustus</option>
		  <option value="9">September</option>
		  <option value="10">Oktober</option>
		  <option value="11">November</option>
		  <option value="12">Desember</option>
      </select>
		&nbsp;&nbsp;&nbsp;
		
		Select Year
		
		<select name="excel_tahun" id="excel_tahun">				<?php		$current_year = date('Y');		$prev_year = $current_year - 5;		$limited = 5;		for($x=$prev_year;$x<=$current_year;$x++){			if($x == $current_year){				$selected = "selected";			}else{				$selected = "";			}		?>
			<option <?=$selected;?> value="<?=$x;?>"><?=$x;?></option>		<?php		}		?>
      </select>
	    &nbsp;&nbsp;&nbsp;
		<input type="submit" name="export" id="button" value="Export" class="btn btn-primary btn-sm" />
	</form>	</table>
	<hr />
</div>