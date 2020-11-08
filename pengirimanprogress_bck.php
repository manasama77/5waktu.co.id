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
if(isset($_REQUEST['keyword']))
{
	$keyword=$_REQUEST['keyword'];
}
else
{
	$keyword=NULL;
}

if(isset($_REQUEST['filter_category']))
{
	$filter_category=$_REQUEST['filter_category'];
}
else
{
	$filter_category="exit_date";
}

if(isset($_REQUEST['position']))
{
	$position=$_REQUEST['position'];
	$position2=$position;
	if($position=="nama_dealer")
	{
		$position="dealer.".$position;
	}
	else
	{
		$position="p.".$position;
	}
}
else
{
	$position="exit_date";
	$position2=$position;
}

if(isset($_REQUEST['order']))
{
	$order=$_REQUEST['order'];
}
else
{
	$order=NULL;
}
	
$no=$posisi+1;
?>
<?php
if(isset($_GET['pencarian']))
{
	if($filter_category=="do_num")
	{
		$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' AND p.do_num LIKE '%$keyword%' ORDER BY $position $order LIMIT $posisi,$batas");
	}
	elseif($filter_category=="nama_gudang")
	{
		$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' AND p.nama_gudang LIKE '%$keyword%' ORDER BY $position $order LIMIT $posisi,$batas");
	}
	elseif($filter_category=="nama_dealer")
	{
		$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' AND dealer.nama_dealer LIKE '%$keyword%' ORDER BY $position $order LIMIT $posisi,$batas");
	}
	elseif($filter_category=="sum_harga")
	{
		$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' AND p.sum_harga LIKE '%$keyword%' ORDER BY $position $order LIMIT $posisi,$batas");
	}
	elseif($filter_category=="received_name")
	{
		$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' AND p.received_name LIKE '%$keyword%' ORDER BY $position $order LIMIT $posisi,$batas");
	}
	else
	{
		$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' ORDER BY $position $order LIMIT $posisi,$batas");
	}
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' ORDER BY $position $order LIMIT $posisi,$batas");
}

$kueri_prog = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='progress' ORDER BY p.exit_date DESC");
$row = mysqli_num_rows($kueri_prog);
?>
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
<table id="progresslist" width="100%" class="table table-responsive table-hover">
<thead>
	<tr>
		<th style="text-align:center;">DO Num</th>
		<th style="text-align:center;">Warehouse</th>
		<th style="text-align:center;">DO Print Date</th>
		<th style="text-align:center;">Exit Date</th>
		<th style="text-align:center;">Estimation Date</th>
		<th style="text-align:center;">Dealer</th>
		<th style="text-align:center;">Total Cost (IDR)</th>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
		?>
		<th style="text-align:center;"><i class="fa fa-gear"></i> Config</th>
		<?php
		}
		?>
	</tr>
</thead>
<tbody>
<?php
while($data_waiting = mysqli_fetch_array($kueri_prog))
{
	$no++;
	$nama_gudang = $data_waiting['nama_gudang'];
	$id_pengiriman = $data_waiting['id_pengiriman'];
	$do_num = $data_waiting['do_num'];
	$nama_dealer = $data_waiting['nama_dealer'];
	$sum_harga = $data_waiting['sum_harga'];
?>
	<tr>
		<td align="center">
			<button type="button" class="btn btn-info btn-sm" onClick="loadprogressmodal(<?=$id_pengiriman;?>);">
				<?=$data_waiting['do_num'];?>
			</button>
		</td>
		<td align="center"><?=$data_waiting['nama_gudang'];?></td>
		<td align="center"><?=$data_waiting['do_print_date'];?></td>
		<td align="center"><?=$data_waiting['exit_date'];?></td>
		<td align="center"><?=$data_waiting['estimation_date'];?></td>
		<td align="center"><?=$data_waiting['nama_dealer'];?></td>
		<td align="center"><?=number_format($data_waiting['sum_harga']);?></td>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
		?>
		<td align="center">
			<a href="admin.php?page=editpengirimanprogress&&random_id=<?=$random_id;?>&&id=<?=$data_waiting['id_pengiriman'];?>">
				<button type="button" class="btn btn-primary btn-sm" title="Edit Laporan">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			<a href="deletepengirimanprogress.php?random_id=<?=$random_id;?>&&id=<?=$data_waiting['id_pengiriman'];?>" onClick="return confirm('Are you sure you want to DELETE??');">
				<button type="button" class="btn btn-danger btn-sm" title="Delete Laporan">
					<i class="fa fa-trash"></i>
				</button>
			</a>
		</td>
		<?php
		}
		?>
	</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
</div>

<div id="modalnyaprog"></div>