<style>
td{ font-size:12px; }
</style>
<?php
$tahun_sekarang = date('Y');

$que = "SELECT * FROM tbl_pengiriman AS p LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer WHERE p.status_pengiriman='delivered' AND p.do_print_date >= '$tahun_sekarang' ORDER BY p.id_pengiriman DESC LIMIT 2000";
$kueri_deli = mysqli_query($con, $que);
$row = mysqli_num_rows($kueri_deli);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Laporan Pengiriman - <font color="blue">Delivered</font></h3>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title btn-group" id="myModalLabel">
		<a href="javascript:printDiv('div')" onClick="printDiv('printableArea')" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a>
		</h4>
      </div>
      <div id="printableArea" class="modal-body">
        sedang mengambil data...
      </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
</div>
<!-- Modal -->

<div class="widget-content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<?php
		if($_SESSION['login']['level'] == "super_admin" || $_SESSION['login']['level'] == "staff"){
		?>
		<td align="left">
			<h3><a href="admin.php?page=addpengiriman1">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Pengiriman</a></h3>
		</td>
		<?php
		}
		?>
	</tr>
	</table>
	<div class="table-responsive">
<table id="deliveredlist" width="100%" class="table table-responsive table-hover table-bordered">
<thead>
	<tr>
		<th style="text-align:center;">DO Num</th>
		<th style="text-align:center;">Warehouse</th>
		<th style="text-align:center;">DO Print Date</th>
		<th style="text-align:center;">Exit Date</th>
		<th style="text-align:center;">Estimation Date</th>
		<th style="text-align:center;">Delivered Date</th>
		<th style="text-align:center;">Dealer</th>
		<th style="text-align:center;">Total Cost (IDR)</th>
		<th style="text-align:center;">Status</th>
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
$no=0;
while($data_waiting = mysqli_fetch_array($kueri_deli))
{
	$no++;
	$id_pengiriman = $data_waiting['id_pengiriman'];
	$do_num = $data_waiting['do_num'];
	$nama_dealer = $data_waiting['nama_dealer'];
	$sum_harga = $data_waiting['sum_harga'];
	$late = $data_waiting['late'];
?>
	<tr>
		<td align="center">
			<button type="button" class="btn btn-info btn-sm" onClick="loaddeliveredmodal(<?=$id_pengiriman;?>);">
				<?=$data_waiting['do_num'];?>
			</button>			
		</td>
		<td align="center"><?=$data_waiting['nama_gudang'];?></td>
		<td align="center"><?=$data_waiting['do_print_date'];?></td>
		<td align="center"><?=$data_waiting['exit_date'];?></td>
		<td align="center"><?=$data_waiting['estimation_date'];?></td>
		<td align="center"><?=$data_waiting['received_date'];?></td>
		<td align="center"><?=$data_waiting['nama_dealer'];?></td>
		<td align="center"><?=number_format($data_waiting['sum_harga'],0);?></td>
		<td align="center">
		<?=strtoupper($data_waiting['status_pengiriman']);?>
		<?php
		if($data_waiting['status_pengiriman']=="delivered")
		{
			if($data_waiting['status_penerimaan']=="late")
			{
				echo strtoupper($data_waiting['status_penerimaan'])." ".$late." Hari";
			}else{
				echo strtoupper($data_waiting['status_penerimaan']);
			}
		}
		?>
		</td>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
		?>
		<td align="center" width="110px">
			<a href="admin.php?status=delivered&&page=editpengirimanprogress&&random_id=<?=$random_id;?>&&id=<?=$data_waiting['id_pengiriman'];?>">
				<button type="button" class="btn btn-primary btn-sm" title="Edit Laporan">
					<i class="fa fa-edit"></i>
				</button>
			</a>
			<a href="deletepengirimandelivered.php?random_id=<?=$random_id;?>&&id=<?=$data_waiting['id_pengiriman'];?>" onClick="return confirm('Are you sure you want to DELETE??');">
				<button type="button" class="btn btn-danger btn-sm" title="Delete Laporan">
					<i class="fa fa-trash"></i>
				</button>
			</a>
			<a href="javascript:displayParameterInfo()" onClick="javascript:ajaxpage('printinvoice.php?id=<?=$data_waiting['id_pengiriman'];?>', 'printableArea');" data-toggle="modal" data-target="#myModal2">
				<button type="button" class="btn btn-success btn-sm" title="Print Invoice">
					<i class="fa fa-print"></i>
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

<div id="modalnyadeli"></div>