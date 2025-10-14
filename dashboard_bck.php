<style>
td{ font-size:12px; }
</style>
<?php
$id_dealer = $_SESSION['login']['id_dealer'];

if($id_dealer != ''){
	$qdeal = "AND p.id_dealer = '$id_dealer' AND";
}else{
	$qdeal = "";
}

$bulan_sekarang = date('m');
$kueri_dash = mysqli_query($con, "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE (p.received_date IS NULL OR MONTH(p.exit_date) = '$bulan_sekarang') $qdeal ORDER BY p.exit_date DESC");
$row = mysqli_num_rows($kueri_dash);?><div class="container">	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Laporan Pengiriman - <font color="blue">All Data</font></h3></div><div class="widget-content">	<div class="table-responsive">
<table id="dashboardlist" width="100%" class="table table-responsive table-hover table-bordered">
	<thead>
		<tr>			<th style="text-align:center;">DO Num</th>
			<th style="text-align:center;">Warehouse</th>
			<th style="text-align:center;">DO Print Date</th>
			<th style="text-align:center;">Exit Date</th>
			<th style="text-align:center;">Estimation Date</th>
			<th style="text-align:center;">Delivered Date</th>
			<th style="text-align:center;">Dealer</th>
			<?php
			if($_SESSION['login']['level'] != "dealer"){
			?>
			<th style="text-align:center;">Total Cost (IDR)</th>
			<?php
			}
			?>
			<th style="text-align:center;">Status Delivery</th>
			<th style="text-align:center;">Delivery Late Time (Day)</th>
			<th style="text-align:center;">Received Name</th>
		</tr>
	</thead>	<tbody>
	<?php
	while($data_waiting = mysqli_fetch_array($kueri_dash))
	{
		$no++;
		$id_pengiriman = $data_waiting['id_pengiriman'];
		$do_print_date = $data_waiting['do_print_date'];
		$exit_date = $data_waiting['exit_date'];
		$estimation_date = $data_waiting['estimation_date'];
		$received_date = $data_waiting['received_date'];
		$do_num = $data_waiting['do_num'];
		$nama_dealer = $data_waiting['nama_dealer'];
		$sum_harga = $data_waiting['sum_harga'];
		$late = $data_waiting['late'];
	?>
	<tr>		<td align="center">		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onClick="loaddashboardmodal(<?=$id_pengiriman;?>);">
			<?=$data_waiting['do_num'];?>
		</button>
		</td>		<td align="center"><?=$data_waiting['nama_gudang'];?></td>		<td align="center"><?=$data_waiting['do_print_date'];?></td>		<td align="center"><?=$data_waiting['exit_date'];?></td>		<td align="center"><?=$data_waiting['estimation_date'];?></td>		<td align="center"><?=$data_waiting['received_date'];?></td>		<td align="center"><?=$data_waiting['nama_dealer'];?></td>		<?php		if($_SESSION['login']['level'] != "dealer"){		?>		<td align="center"><?=number_format($data_waiting['sum_harga']);?></td>		<?php		}		?>		<td align="center"><?=strtoupper($data_waiting['status_pengiriman']);?></td>		<td align="center">		<?php		if($data_waiting['status_pengiriman']=="delivered")		{			if($data_waiting['status_penerimaan']=="late")			{
				echo $late;			}else{
				echo strtoupper($data_waiting['status_penerimaan']);
			}		}		?>		</td>		<td align="center"><?=$data_waiting['received_name'];?></td>	</tr>	<?php
	}
	?>	</tbody>
</table></div>
</div>
</div>

<div id="modalnyadash"></div>