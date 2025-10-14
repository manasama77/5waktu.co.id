<html>
<head>
<?php
include("config.php");
$excel_start=$_REQUEST['excel_start2'];
$excel_end=$_REQUEST['excel_end2'];

$query = mysqli_query($con, "SELECT
pengiriman.do_num,
pengiriman.nama_gudang,
pengiriman.do_print_date,
pengiriman.exit_date,
pengiriman.waktu_pengiriman AS exit_time,
pengiriman.date_terima_ekspedisi AS delivery_to_expedition,
pengiriman.estimation_date,
pengiriman.received_date,
pengiriman.received_num,
pengiriman.received_name,
pengiriman.notes,
pengiriman.random_id,
pengiriman.sum_harga,
pengiriman.status_pengiriman,
pengiriman.status_penerimaan,
pengiriman.late,
dealer.nama_dealer,
kota.id_kota,
kota.nama_kota,
kota.satuan_penghitungan,
ekspedisi.nama_ekspedisi,
mobil.no_polisi,
driver.nama_driver
FROM tbl_pengiriman AS pengiriman
LEFT JOIN tbl_dealer AS dealer ON pengiriman.id_dealer = dealer.id_dealer
LEFT JOIN tbl_kota AS kota ON dealer.id_kota = kota.id_kota
LEFT JOIN tbl_ekspedisi AS ekspedisi ON ekspedisi.id_ekspedisi = dealer.id_ekspedisi
LEFT JOIN tbl_mobil AS mobil ON pengiriman.id_mobil = mobil.id_mobil
LEFT JOIN tbl_driver AS driver ON pengiriman.id_driver = driver.id_driver
WHERE pengiriman.exit_date BETWEEN '$excel_start' AND '$excel_end'
AND pengiriman.status_pengiriman = 'delivered'");

$count = mysqli_num_rows($query);

include("functionnya.php");

$sum_total_late_penalty = "0";
?>

<link rel="stylesheet" type="text/css" href="DataTables/Bootstrap-3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="DataTables/Bootstrap-3.3.7/css/bootstrap-theme.css"/>
</head>
<body>
<section class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="box-body">
	<div class="col-lg-12">
		<br>
		<button type="button" class="btn btn-primary" onClick="exportexcel();">Download</button>
		<hr>
	</div>
	<table id="mytable" name="mytable" class="table table-bordered table-striped small">
		<thead>
			<tr>
				<th style="text-align:center;" colspan="27">Delivered Data - <?=$excel_start;?> ~ <?=$excel_end;?></th>
			<tr>
			<tr>
				<th style="text-align:center;">DO Num</th>
				<th style="text-align:center;">Warehouse</th>
				<th style="text-align:center;">DO Print Date</th>
				<th style="text-align:center;">Exit Date</th>
				<th style="text-align:center;">Exit Time</th>
				<th style="text-align:center;">Delivert to Expedition</th>
				<th style="text-align:center;">Estimation Date</th>
				<th style="text-align:center;">Received Date</th>
				<th style="text-align:center;">Received Num</th>
				<th style="text-align:center;">Dealer</th>
				<th style="text-align:center;">City</th>
				<th style="text-align:center;">Expedition</th>
				<th style="text-align:center;">Product Name</th>
				<th style="text-align:center;">Weight</th>
				<th style="text-align:center;">Volumetric</th>
				<th style="text-align:center;">Qty</th>
				<th style="text-align:center;">Calculated Bases</th>
				<th style="text-align:center;">Basic Cost (IDR)</th>
				<th style="text-align:center;">Total Cost (IDR)</th>
				<th style="text-align:center;">Total DO Cost (IDR)</th>
				<th style="text-align:center;">Delivery Truck</th>
				<th style="text-align:center;">Truck Driver</th>
				<th style="text-align:center;">Status Delivered</th>
				<th style="text-align:center;">Delivery Late Time (Day)</th>
				<th style="text-align:center;">Received Name</th>
				<th style="text-align:center;">Notes</th>
				<th style="text-align:center;">Late Penalty</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($data = mysqli_fetch_array($query)){
			$random_id = $data['random_id'];
			$query_count_temp = mysqli_query($con, "SELECT
			tp.quantity
			FROM temp_produk AS tp
			WHERE tp.random_id = '$random_id'");
			
			$count_temp = mysqli_num_rows($query_count_temp);
			
			if($count_temp >= 2){
				$query_temp = mysqli_query($con, "SELECT
				pk.id_kategori_produk,
				pk.produk_name,
				pk.weight,
				pk.volumetric,
				tp.quantity,
				tp.total_weight,
				tp.total_harga,
				kp.weight_class
				FROM temp_produk AS tp
				LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = tp.id_produk_katalog
				LEFT Join tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk
				WHERE tp.random_id = '$random_id'
				LIMIT 1 OFFSET 0");
				
				$data_temp = mysqli_fetch_array($query_temp);
				
				if($data['satuan_penghitungan']=="weight")
				{
					if($data_temp['id_kategori_produk'] == 1){
						$base = "WEIGHT";
					}elseif($data_temp['id_kategori_produk'] == 4 && $data_temp['weight'] >= 151){
						$base = "WEIGHT";
					}elseif($data_temp['id_kategori_produk'] == 2 && $data_temp['weight'] >= 151){
						$base = "WEIGHT";
					}elseif($data_temp['weight_class'] == "c" && $data_temp['total_weight'] <= 20){
						$base = "MINIMUM COST";
					}elseif($data_temp['weight_class'] == "c"){
						$base = "WEIGHT";
					}else{
						$base = "UNIT";
					}
				}elseif($data['satuan_penghitungan']=="volumetric"){
					$base = "VOLUMETRIC";
				}
				
				$dasar = check($data['satuan_penghitungan'], $data_temp['weight_class'], $data_temp['id_kategori_produk'], $data_temp['quantity'], $data_temp['weight'], $data['id_kota'], $data_temp['total_weight']);
				
				if($data['late'] != null){
					if($data['status_pengiriman']=="delivered"){
						if($data['late'] < 0){
							$status_penerimaan=strtoupper($data['status_penerimaan']);
							$late=$data['late'];
							$telat = str_replace("-", "", $data['late']);
							$late_penalty = ($data['sum_harga'] * $telat) * 0.001;
						}elseif($data['late'] >= 0){
							$status_penerimaan=strtoupper($data['status_penerimaan']);
							$late_penalty = "0";
							$late = "0";
						}
					}else{
						$late_penalty = "0";
						$late = "";
					}
					
					$sum_total_late_penalty += $late_penalty;
					
				}else{
					$late = "";
					$late_penalty = "0";
				}
		?>
			<tr>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['do_num'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['nama_gudang'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['do_print_date'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['exit_date'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=strtoupper($data['exit_time']);?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['delivery_to_expedition'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['estimation_date'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['received_date'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['received_num'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['nama_dealer'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['nama_kota'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['nama_ekspedisi'];?></td>
				<td style="text-align:center;"><?=$data_temp['produk_name'];?></td>
				<td style="text-align:center;"><?=$data_temp['weight'];?></td>
				<td style="text-align:center;"><?=$data_temp['volumetric'];?></td>
				<td style="text-align:center;"><?=$data_temp['quantity'];?></td>
				<td style="text-align:center;"><?=$base;?></td>
				<td style="text-align:center;"><?=number_format($dasar,2);?></td>
				<td style="text-align:center;"><?=number_format($data_temp['total_harga'],2);?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=number_format($data['sum_harga'],2);?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['no_polisi'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['nama_driver'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=ucfirst($data['status_pengiriman']);?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$late;?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['received_name'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=$data['notes'];?></td>
				<td style="text-align:center;" rowspan="<?=$count_temp;?>"><?=number_format($late_penalty,2);?></td>
			</tr>
			<?php
			$count_temp = $count_temp - 1;
			$query_temp = mysqli_query($con, "SELECT
			pk.id_kategori_produk,
			pk.produk_name,
			pk.weight,
			pk.volumetric,
			tp.quantity,
			tp.total_weight,
			tp.total_harga,
			kp.weight_class
			FROM temp_produk AS tp
			LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = tp.id_produk_katalog
			LEFT Join tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk
			WHERE tp.random_id = '$random_id'
			LIMIT $count_temp OFFSET 1");
			
			for($x=0;$x<$count_temp;$x++){
				$data_temp = mysqli_fetch_array($query_temp);
				
				if($data['satuan_penghitungan']=="weight")
				{
					if($data_temp['id_kategori_produk'] == 1){
						$base = "WEIGHT";
					}elseif($data_temp['id_kategori_produk'] == 4 && $data_temp['weight'] >= 151){
						$base = "WEIGHT";
					}elseif($data_temp['id_kategori_produk'] == 2 && $data_temp['weight'] >= 151){
						$base = "WEIGHT";
					}elseif($data_temp['weight_class'] == "c" && $data_temp['total_weight'] <= 20){
						$base = "MINIMUM COST";
					}elseif($data_temp['weight_class'] == "c"){
						$base = "WEIGHT";
					}else{
						$base = "UNIT";
					}
				}elseif($data['satuan_penghitungan']=="volumetric"){
					$base = "VOLUMETRIC";
				}
				
				$dasar = check($data['satuan_penghitungan'], $data_temp['weight_class'], $data_temp['id_kategori_produk'], $data_temp['quantity'], $data_temp['weight'], $data['id_kota'], $data_temp['total_weight']);
			?>
			<tr>
				<td style="text-align:center;"><?=$data_temp['produk_name'];?></td>
				<td style="text-align:center;"><?=$data_temp['weight'];?></td>
				<td style="text-align:center;"><?=$data_temp['volumetric'];?></td>
				<td style="text-align:center;"><?=$data_temp['quantity'];?></td>
				<td style="text-align:center;"><?=$base;?></td>
				<td style="text-align:center;"><?=number_format($dasar,2);?></td>
				<td style="text-align:center;"><?=number_format($data_temp['total_harga'],2);?></td>
			</tr>
			<?php
			}
			?>
		<?php
			}else{
				$query_temp = mysqli_query($con, "SELECT
				pk.id_kategori_produk,
				pk.produk_name,
				pk.weight,
				pk.volumetric,
				tp.quantity,
				tp.total_weight,
				tp.total_harga,
				kp.weight_class
				FROM temp_produk AS tp
				LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = tp.id_produk_katalog
				LEFT Join tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk
				WHERE tp.random_id = '$random_id'");
				
				$data_temp = mysqli_fetch_array($query_temp);
				
				if($data['satuan_penghitungan']=="weight")
				{
					if($data_temp['id_kategori_produk'] == 1){
						$base = "WEIGHT";
					}elseif($data_temp['id_kategori_produk'] == 4 && $data_temp['weight'] >= 151){
						$base = "WEIGHT";
					}elseif($data_temp['id_kategori_produk'] == 2 && $data_temp['weight'] >= 151){
						$base = "WEIGHT";
					}elseif($data_temp['weight_class'] == "c" && $data_temp['total_weight'] <= 20){
						$base = "MINIMUM COST";
					}elseif($data_temp['weight_class'] == "c"){
						$base = "WEIGHT";
					}else{
						$base = "UNIT";
					}
				}elseif($satuan_penghitungan=="volumetric"){
					$base = "VOLUMETRIC";
				}
				
				$dasar = check($data['satuan_penghitungan'], $data_temp['weight_class'], $data_temp['id_kategori_produk'], $data_temp['quantity'], $data_temp['weight'], $data['id_kota'], $data_temp['total_weight']);
				
				if($data['late'] != null){
					if($data['status_pengiriman']=="delivered"){
						if($data['late'] < 0){
							$status_penerimaan=strtoupper($data['status_penerimaan']);
							$late=$data['late'];
							$telat = str_replace("-", "", $data['late']);
							$late_penalty = ((int)$data['sum_harga'] * (int)$telat) * 0.001;
						}elseif($data['late'] >= 0){
							$status_penerimaan=strtoupper($data['status_penerimaan']);					
							$late = "0";
							$late_penalty = "0";
						}
					}else{
						$late_penalty = "0";
						$late = "";
					}
					
					$sum_total_late_penalty += $late_penalty;
					
				}else{
					$late = "";
					$late_penalty = "0";
				}
		?>
			<tr>
				<td style="text-align:center;"><?=$data['do_num'];?></td>
				<td style="text-align:center;"><?=$data['nama_gudang'];?></td>
				<td style="text-align:center;"><?=$data['do_print_date'];?></td>
				<td style="text-align:center;"><?=$data['exit_date'];?></td>
				<td style="text-align:center;"><?=strtoupper($data['exit_time']);?></td>
				<td style="text-align:center;"><?=$data['delivery_to_expedition'];?></td>
				<td style="text-align:center;"><?=$data['estimation_date'];?></td>
				<td style="text-align:center;"><?=$data['received_date'];?></td>
				<td style="text-align:center;"><?=$data['received_num'];?></td>
				<td style="text-align:center;"><?=$data['nama_dealer'];?></td>
				<td style="text-align:center;"><?=$data['nama_kota'];?></td>
				<td style="text-align:center;"><?=$data['nama_ekspedisi'];?></td>
				<td style="text-align:center;"><?=$data_temp['produk_name'];?></td>
				<td style="text-align:center;"><?=$data_temp['weight'];?></td>
				<td style="text-align:center;"><?=$data_temp['volumetric'];?></td>
				<td style="text-align:center;"><?=$data_temp['quantity'];?></td>
				<td style="text-align:center;"><?=$base;?></td>
				<td style="text-align:center;"><?=number_format($dasar,2);?></td>
				<td style="text-align:center;"><?=number_format($data_temp['total_harga'],2);?></td>
				<td style="text-align:center;"><?=number_format($data['sum_harga'],2);?></td>
				<td style="text-align:center;"><?=$data['no_polisi'];?></td>
				<td style="text-align:center;"><?=$data['nama_driver'];?></td>
				<td style="text-align:center;"><?=ucfirst($data['status_pengiriman']);?></td>
				<td style="text-align:center;"><?=$late;?></td>
				<td style="text-align:center;"><?=$data['received_name'];?></td>
				<td style="text-align:center;"><?=$data['notes'];?></td>
				<td style="text-align:center;"><?=number_format($late_penalty,2);?></td>
			</tr>
		<?php
			}
		}
		
		$kueri_sum_harga=mysqli_query($con,"SELECT SUM(tbl_pengiriman.sum_harga) AS sum_total_harga FROM tbl_pengiriman WHERE tbl_pengiriman.exit_date BETWEEN '$excel_start' AND '$excel_end' AND tbl_pengiriman.status_pengiriman = 'delivered'");
		$data_sum_harga=mysqli_fetch_array($kueri_sum_harga);
		$sum_total_harga=$data_sum_harga['sum_total_harga'];
		$grand_total = $sum_total_harga - $sum_total_late_penalty;
		?>
		</tbody>
		<tfoot>
			<tr>
				<th style="text-align:right;" colspan="3">Sum Total Harga</th>
				<td style="text-align:left;" colspan="24"><?=number_format($sum_total_harga,2);?></td>
			</tr>
			<tr>
				<th style="text-align:right;" colspan="3">Sum Total Late Penalty</th>
				<td style="text-align:left;" colspan="24"><?=number_format($sum_total_late_penalty,2);?></td>
			</tr>
			<tr>
				<th style="text-align:right;" colspan="3">Grand Total</th>
				<td style="text-align:left;" colspan="24"><?=number_format($grand_total,2);?></td>
			</tr>
			<tr>
				<th style="text-align:justify;" colspan="27">
				<h4>
					<ol>
						<li>10% tax is not include in the prices</li>
						<li>Work days are Monday - Saturday</li>
						<li>When the exit time is over 3:00 PM, arrival estimation date will be +1 day</li>
						<li>The delivery costs for piano and keyboards (over 25kg) are calculated by weight</li>
						<li>For other instruments, delivery costs are calculated based on the number of units</li>
						<li>All instruments for Kalimantan region, delivery cost are calculated based on volumetric</li>
						<li>The delivery costs for PA, MProd, Brass, Inst.Part, Acc and books bellow 20kg are calculated based on minimum cost, but if PA, MProd, Brass, Inst.Part, Acc and books above 20kg are calculated based on weight</li>
						<li>If the estimated delivery date falls during a national holiday, the items will be delivered the next working day. However, the system will still consider the delivery date as normal</li>
					</ol>
				</h4>
				</th>
			</tr>
		</tfoot>
	</table>
</div>
</div>
</div>
</div>
</body>
</html>

<script src="DataTables/jQuery-3.2.1/jquery-3.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script src="dist/jquery-table2excel-master/dist/jquery.table2excel.min.js" type="text/javascript"></script>
<script type="text/javascript">
function exportexcel() {
	$("#mytable").table2excel({
		name: "Export Delivered Data <?=$excel_start;?> - <?=$excel_end;?>",
		filename: "Export Delivered Data <?=$excel_start;?> - <?=$excel_end;?>.xls",
		fileext: ".xls"
	});
}
</script>
