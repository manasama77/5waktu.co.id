<!-- Modal -->
<?php
include('config.php');

$id_pengiriman = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$level = isset($_REQUEST['level']) ? $_REQUEST['level'] : '';

// Fetch main shipment data with optimized SQL (LEFT JOIN, no quoted aliases, LIMIT 1)
$kueri_modal = mysqli_query($con, "
    SELECT 
        p.id_pengiriman,
        p.nama_gudang,
        p.random_id,
        p.do_num,
        p.do_print_date,
        p.exit_date,
        p.date_terima_ekspedisi,
        p.waktu_pengiriman,
        p.estimation_date,
        p.received_num,
        p.sum_harga,
        p.durasi,
        p.status_pengiriman,
        p.status_penerimaan,
        p.received_name,
        p.notes,
        m.no_polisi,
        d.nama_driver,
        a.nama_asst,
        dl.nama_dealer,
        e.nama_ekspedisi,
        k.nama_kota
    FROM tbl_pengiriman p
    LEFT JOIN tbl_mobil m ON p.id_mobil = m.id_mobil
    LEFT JOIN tbl_driver d ON p.id_driver = d.id_driver
    LEFT JOIN tbl_asst a ON p.id_asst = a.id_asst
    LEFT JOIN tbl_dealer dl ON p.id_dealer = dl.id_dealer
    LEFT JOIN tbl_ekspedisi e ON dl.id_ekspedisi = e.id_ekspedisi
    LEFT JOIN tbl_kota k ON dl.id_kota = k.id_kota
    WHERE p.id_pengiriman = $id_pengiriman
    LIMIT 1
");

$data_modal = mysqli_fetch_assoc($kueri_modal);

if (!$data_modal) {
	echo '<div class="alert alert-danger">Data tidak ditemukan</div>';
	exit;
}

$random_id = $data_modal['random_id'];
$price = $data_modal['sum_harga'];

// Fetch products (single query, no N+1 problem)
$kueri_temp_produk = mysqli_query($con, "
    SELECT 
        pk.produk_name,
        tp.quantity,
        tp.total_harga
    FROM temp_produk tp
    LEFT JOIN tbl_produk_katalog pk ON tp.id_produk_katalog = pk.id_produk_katalog
    WHERE tp.random_id = $random_id
");
?>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #337ab7; color: white;">
				<button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
				<h4 class="modal-title"><i class="fa fa-truck"></i> Shipment Details - Progress</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- Left Column -->
					<div class="col-md-6">
						<!-- Basic Information Panel -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><i class="fa fa-info-circle"></i> Basic Information</strong>
							</div>
							<div class="panel-body">
								<table class="table table-condensed">
									<tr>
										<td width="40%">ID Pengiriman</td>
										<td width="5%">:</td>
										<td><strong><?php echo htmlspecialchars($data_modal['id_pengiriman']); ?></strong></td>
									</tr>
									<tr>
										<td>Warehouse</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['nama_gudang']); ?></td>
									</tr>
									<tr>
										<td>DO Number</td>
										<td>:</td>
										<td><strong><?php echo htmlspecialchars($data_modal['do_num']); ?></strong></td>
									</tr>
									<tr>
										<td>Dealer</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['nama_dealer']); ?></td>
									</tr>
									<tr>
										<td>Expedition</td>
										<td>:</td>
										<td>
											<?php echo htmlspecialchars($data_modal['nama_ekspedisi']); ?>
											<span class="label label-info"><?php echo htmlspecialchars($data_modal['durasi']); ?> Day</span>
										</td>
									</tr>
									<tr>
										<td>Region</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['nama_kota']); ?></td>
									</tr>
									<tr>
										<td>Status</td>
										<td>:</td>
										<td><span class="label label-primary"><?php echo strtoupper(htmlspecialchars($data_modal['status_pengiriman'])); ?></span></td>
									</tr>
								</table>
							</div>
						</div>

						<!-- Important Dates Panel -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><i class="fa fa-calendar"></i> Important Dates</strong>
							</div>
							<div class="panel-body">
								<table class="table table-condensed">
									<tr>
										<td width="40%">DO Print Date</td>
										<td width="5%">:</td>
										<td><?php echo htmlspecialchars($data_modal['do_print_date']); ?></td>
									</tr>
									<tr>
										<td>Exit Date</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['exit_date']); ?></td>
									</tr>
									<tr>
										<td>Exit Time</td>
										<td>:</td>
										<td>
											<?php
											if ($data_modal['waktu_pengiriman'] == "normal") {
												echo '<span class="label label-success">Normal</span>';
											} elseif ($data_modal['waktu_pengiriman'] == "late") {
												echo '<span class="label label-warning">After 3 PM</span>';
											}
											?>
										</td>
									</tr>
									<tr>
										<td>Date Terima Ekspedisi</td>
										<td>:</td>
										<td>
											<?php echo htmlspecialchars($data_modal['date_terima_ekspedisi']); ?>
											<?php if ($level == "super_admin") { ?>
												<br><br>
												<form method="post" action="admin.php?page=editdateterimaekspedisi" style="margin: 0;">
													<input name="id_pengiriman" type="hidden" value="<?php echo $id_pengiriman; ?>" />
													<button class="btn btn-primary btn-xs" type="submit">
														<i class="fa fa-edit"></i> Edit Date
													</button>
												</form>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td>Estimation Date</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['estimation_date']); ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<!-- Right Column -->
					<div class="col-md-6">
						<!-- Delivery Team Panel -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><i class="fa fa-users"></i> Delivery Team</strong>
							</div>
							<div class="panel-body">
								<table class="table table-condensed">
									<tr>
										<td width="40%">Vehicle</td>
										<td width="5%">:</td>
										<td><strong><?php echo htmlspecialchars($data_modal['no_polisi']); ?></strong></td>
									</tr>
									<tr>
										<td>Driver</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['nama_driver']); ?></td>
									</tr>
									<tr>
										<td>Assistant</td>
										<td>:</td>
										<td><?php echo htmlspecialchars($data_modal['nama_asst']); ?></td>
									</tr>
								</table>
							</div>
						</div>

						<!-- Products Panel -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><i class="fa fa-cube"></i> Products</strong>
							</div>
							<div class="panel-body">
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<th>Product Name</th>
											<th class="text-center">Qty</th>
											<th class="text-right">Price</th>
										</tr>
									</thead>
									<tbody>
										<?php while ($data_temp_produk = mysqli_fetch_assoc($kueri_temp_produk)) { ?>
											<tr>
												<td><?php echo htmlspecialchars($data_temp_produk['produk_name']); ?></td>
												<td class="text-center"><?php echo htmlspecialchars($data_temp_produk['quantity']); ?></td>
												<td class="text-right">Rp. <?php echo number_format($data_temp_produk['total_harga'], 0); ?></td>
											</tr>
										<?php } ?>
										<tr style="font-weight: bold; background-color: #f5f5f5;">
											<td colspan="2" class="text-right">Total Price:</td>
											<td class="text-right text-success">Rp. <?php echo number_format($price, 0); ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<!-- Reception Information Panel -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><i class="fa fa-check-circle"></i> Reception Information</strong>
							</div>
							<div class="panel-body">
								<table class="table table-condensed">
									<tr>
										<td width="40%">Received Date</td>
										<td width="5%">:</td>
										<td>
											<?php if ($level == "super_admin") { ?>
												<form method="post" action="admin.php?page=addreceivedinfo" style="margin: 0;">
													<input name="id_pengiriman" type="hidden" value="<?php echo $id_pengiriman; ?>" />
													<input name="estimation_date" type="hidden" value="<?php echo htmlspecialchars($data_modal['estimation_date']); ?>" />
													<button class="btn btn-success btn-sm" type="submit">
														<i class="fa fa-plus"></i> Add Received Info
													</button>
												</form>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td>Received Number</td>
										<td>:</td>
										<td>
											<?php echo htmlspecialchars($data_modal['received_num']); ?>
											<?php if ($level == "super_admin" && !empty($data_modal['received_num'])) { ?>
												<br><br>
												<form method="post" action="admin.php?page=editreceivednum" style="margin: 0;">
													<input name="id_pengiriman" type="hidden" value="<?php echo $id_pengiriman; ?>" />
													<button class="btn btn-primary btn-xs" type="submit">
														<i class="fa fa-edit"></i> Edit Number
													</button>
												</form>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td>Received Name</td>
										<td>:</td>
										<td>
											<?php echo htmlspecialchars($data_modal['received_name']); ?>
											<?php if ($level == "super_admin" && !empty($data_modal['received_name'])) { ?>
												<br><br>
												<form method="post" action="admin.php?page=editreceivedname" style="margin: 0;">
													<input name="id_pengiriman" type="hidden" value="<?php echo $id_pengiriman; ?>" />
													<button class="btn btn-primary btn-xs" type="submit">
														<i class="fa fa-edit"></i> Edit Name
													</button>
												</form>
											<?php } ?>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<!-- Notes Panel -->
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><i class="fa fa-comment"></i> Notes</strong>
							</div>
							<div class="panel-body">
								<textarea class="form-control" rows="3" disabled><?php echo htmlspecialchars($data_modal['notes']); ?></textarea>
								<?php if ($level == "super_admin") { ?>
									<br>
									<form method="post" action="admin.php?page=editnotes" style="margin: 0;">
										<input name="id_pengiriman" type="hidden" value="<?php echo $id_pengiriman; ?>" />
										<button class="btn btn-primary btn-sm" type="submit">
											<i class="fa fa-edit"></i> Edit Notes
										</button>
									</form>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					<i class="fa fa-times"></i> Close
				</button>
			</div>
		</div>
	</div>
</div>