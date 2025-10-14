<!-- Modal -->
<?php
// session_start();
include('config.php');
$id_pengiriman = (int)$_REQUEST['id'];
$level = isset($_REQUEST['level']) ? $_REQUEST['level'] : '';

// Optimized query - only select needed columns and use LEFT JOIN
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
		p.received_date,
		p.received_num,
		p.sum_harga,
		p.status_pengiriman,
		p.status_penerimaan,
		p.received_name,
		p.notes,
		p.late,
		p.durasi,
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
") or die($con->error);

$data_modal = mysqli_fetch_assoc($kueri_modal);

if (!$data_modal) {
	echo '<div class="alert alert-danger">Data tidak ditemukan</div>';
	exit;
}

$random_id = (int)$data_modal['random_id'];

// Fetch products - optimized query
$products = array();
if ($random_id > 0) {
	$kueri_produk = mysqli_query($con, "
        SELECT 
            pk.produk_name,
            tp.quantity,
            tp.total_harga
        FROM temp_produk tp
        LEFT JOIN tbl_produk_katalog pk ON pk.id_produk_katalog = tp.id_produk_katalog
        WHERE tp.random_id = $random_id
    ");

	while ($row = mysqli_fetch_assoc($kueri_produk)) {
		$products[] = $row;
	}
}

// Calculate late penalty
$price = $data_modal['sum_harga'];
$late_penalty = 0;
if ($data_modal['status_penerimaan'] == 'LATE' || $data_modal['status_penerimaan'] == 'late') {
	$telat = abs((int)$data_modal['late']);
	$late_penalty = ($price * $telat) * 0.001;
}
$grand_total = $price - $late_penalty;
?>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background-color: #5cb85c; color: white;">
				<button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 0.8;">&times;</button>
				<h4 class="modal-title">
					<i class="fa fa-check-circle"></i> Detail Pengiriman Delivered - DO #<?= htmlspecialchars($data_modal['do_num']); ?>
				</h4>
			</div>
			<div class="modal-body" style="padding: 20px;">
				<div class="row">
					<!-- Left Column -->
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #f5f5f5;">
								<strong><i class="fa fa-info-circle"></i> Informasi Pengiriman</strong>
							</div>
							<div class="panel-body" style="padding: 10px;">
								<table class="table table-condensed" style="margin-bottom: 0;">
									<tr>
										<td width="40%"><strong>ID Pengiriman</strong></td>
										<td width="5%">:</td>
										<td><?= htmlspecialchars($data_modal['id_pengiriman']); ?></td>
									</tr>
									<tr>
										<td><strong>DO Number</strong></td>
										<td>:</td>
										<td><span class="label label-primary"><?= htmlspecialchars($data_modal['do_num']); ?></span></td>
									</tr>
									<tr>
										<td><strong>Warehouse</strong></td>
										<td>:</td>
										<td><?= htmlspecialchars($data_modal['nama_gudang']); ?></td>
									</tr>
									<tr>
										<td><strong>Dealer</strong></td>
										<td>:</td>
										<td><?= htmlspecialchars($data_modal['nama_dealer']); ?></td>
									</tr>
									<tr>
										<td><strong>Region</strong></td>
										<td>:</td>
										<td><?= htmlspecialchars($data_modal['nama_kota']); ?></td>
									</tr>
									<tr>
										<td><strong>Expedition</strong></td>
										<td>:</td>
										<td><?= htmlspecialchars($data_modal['nama_ekspedisi']); ?> <span class="badge"><?= $data_modal['durasi']; ?> Hari</span></td>
									</tr>
									<tr>
										<td><strong>Status</strong></td>
										<td>:</td>
										<td>
											<?php
											$status = strtoupper($data_modal['status_pengiriman']);
											$status_penerimaan = strtoupper($data_modal['status_penerimaan']);
											?>
											<span class="label label-success"><?= $status; ?></span>
											<?php if ($status_penerimaan == 'LATE'): ?>
												<span class="label label-danger"><?= $status_penerimaan; ?> (<?= abs($data_modal['late']); ?> Day)</span>
											<?php else: ?>
												<span class="label label-success"><?= $status_penerimaan; ?></span>
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #f5f5f5;">
								<strong><i class="fa fa-calendar"></i> Tanggal Penting</strong>
							</div>
							<div class="panel-body" style="padding: 10px;">
								<table class="table table-condensed" style="margin-bottom: 0;">
									<tr>
										<td width="40%"><strong>DO Print Date</strong></td>
										<td width="5%">:</td>
										<td><?= $data_modal['do_print_date'] ? date('d M Y', strtotime($data_modal['do_print_date'])) : '-'; ?></td>
									</tr>
									<tr>
										<td><strong>Exit Date</strong></td>
										<td>:</td>
										<td><?= $data_modal['exit_date'] ? date('d M Y', strtotime($data_modal['exit_date'])) : '-'; ?></td>
									</tr>
									<tr>
										<td><strong>Exit Time</strong></td>
										<td>:</td>
										<td>
											<?php
											if ($data_modal['waktu_pengiriman'] == 'normal') {
												echo '<span class="label label-success">Normal</span>';
											} elseif ($data_modal['waktu_pengiriman'] == 'late') {
												echo '<span class="label label-warning">Diatas jam 15.00</span>';
											} else {
												echo '-';
											}
											?>
										</td>
									</tr>
									<tr>
										<td><strong>Date Terima Ekspedisi</strong></td>
										<td>:</td>
										<td><?= $data_modal['date_terima_ekspedisi'] ? date('d M Y', strtotime($data_modal['date_terima_ekspedisi'])) : '-'; ?></td>
									</tr>
									<tr>
										<td><strong>Estimation Date</strong></td>
										<td>:</td>
										<td><?= $data_modal['estimation_date'] ? date('d M Y', strtotime($data_modal['estimation_date'])) : '-'; ?></td>
									</tr>
									<tr>
										<td><strong>Received Date</strong></td>
										<td>:</td>
										<td><?= $data_modal['received_date'] ? date('d M Y', strtotime($data_modal['received_date'])) : '-'; ?></td>
									</tr>
								</table>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #f5f5f5;">
								<strong><i class="fa fa-users"></i> Tim Pengiriman</strong>
							</div>
							<div class="panel-body" style="padding: 10px;">
								<table class="table table-condensed" style="margin-bottom: 0;">
									<tr>
										<td width="40%"><strong>Mobil</strong></td>
										<td width="5%">:</td>
										<td><span class="label label-default"><?= htmlspecialchars($data_modal['no_polisi'] ?: '-'); ?></span></td>
									</tr>
									<tr>
										<td><strong>Driver</strong></td>
										<td>:</td>
										<td><?= htmlspecialchars($data_modal['nama_driver'] ?: '-'); ?></td>
									</tr>
									<tr>
										<td><strong>Assistant</strong></td>
										<td>:</td>
										<td><?= htmlspecialchars($data_modal['nama_asst'] ?: '-'); ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>

					<!-- Right Column -->
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #f5f5f5;">
								<strong><i class="fa fa-cube"></i> Produk</strong>
							</div>
							<div class="panel-body" style="padding: 10px; max-height: 200px; overflow-y: auto;">
								<?php if (count($products) > 0): ?>
									<ul class="list-unstyled" style="margin-bottom: 0;">
										<?php foreach ($products as $product): ?>
											<li style="padding: 5px 0; border-bottom: 1px solid #eee;">
												<i class="fa fa-check-circle text-success"></i>
												<strong><?= htmlspecialchars($product['produk_name']); ?></strong>
												<span class="badge"><?= $product['quantity']; ?> Qty</span>
												<br><small style="margin-left: 20px;">Rp. <?= number_format($product['total_harga'], 0, ',', '.'); ?></small>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php else: ?>
									<p class="text-muted text-center"><i class="fa fa-info-circle"></i> Tidak ada produk</p>
								<?php endif; ?>
							</div>
							<?php if (count($products) > 0): ?>
								<div class="panel-footer" style="background-color: #f9f9f9;">
									<strong>Total Harga:</strong>
									<span class="pull-right text-success" style="font-size: 16px;">
										<strong>Rp. <?= number_format($data_modal['sum_harga'], 0, ',', '.'); ?></strong>
									</span>
								</div>
							<?php endif; ?>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #f5f5f5;">
								<strong><i class="fa fa-check-square"></i> Penerimaan</strong>
							</div>
							<div class="panel-body" style="padding: 10px;">
								<table class="table table-condensed" style="margin-bottom: 0;">
									<tr>
										<td width="40%"><strong>Received Num</strong></td>
										<td width="5%">:</td>
										<td><?= htmlspecialchars($data_modal['received_num'] ?: '-'); ?></td>
									</tr>
									<tr>
										<td><strong>Received Name</strong></td>
										<td>:</td>
										<td>
											<?= htmlspecialchars(strtoupper($data_modal['received_name'] ?: '-')); ?>
											<?php if ($level == "super_admin"): ?>
												<form method="post" action="admin.php?page=editreceivedname2" style="margin-top: 10px;">
													<input name="id_pengiriman" type="hidden" value="<?= $id_pengiriman; ?>" />
													<button class="btn btn-primary btn-xs" type="submit">
														<i class="fa fa-edit"></i> Edit
													</button>
												</form>
											<?php endif; ?>
										</td>
									</tr>
									<tr>
										<td><strong>Notes</strong></td>
										<td>:</td>
										<td>
											<?php if ($data_modal['notes']): ?>
												<textarea class="form-control" rows="3" disabled><?= htmlspecialchars($data_modal['notes']); ?></textarea>
											<?php else: ?>
												<span class="text-muted">-</span>
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #f5f5f5;">
								<strong><i class="fa fa-money"></i> Financial Summary</strong>
							</div>
							<div class="panel-body" style="padding: 10px;">
								<table class="table table-condensed" style="margin-bottom: 0;">
									<tr>
										<td width="40%"><strong>Total Price</strong></td>
										<td width="5%">:</td>
										<td class="text-right"><strong>Rp. <?= number_format($price, 0, ',', '.'); ?></strong></td>
									</tr>
									<tr>
										<td><strong>Late Penalty</strong></td>
										<td>:</td>
										<td class="text-right text-danger">
											<?php if ($late_penalty > 0): ?>
												<strong>- Rp. <?= number_format($late_penalty, 0, ',', '.'); ?></strong>
											<?php else: ?>
												<span class="text-success">Rp. 0</span>
											<?php endif; ?>
										</td>
									</tr>
									<tr style="background-color: #f9f9f9; font-size: 16px;">
										<td><strong>Grand Total</strong></td>
										<td>:</td>
										<td class="text-right">
											<strong class="text-success">Rp. <?= number_format($grand_total, 0, ',', '.'); ?></strong>
										</td>
									</tr>
								</table>
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