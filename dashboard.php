<?php
// Get data from database
$id_dealer = isset($_SESSION['login']['id_dealer']) ? $_SESSION['login']['id_dealer'] : '';

// Pagination settings
$records_per_page = 25;
$page = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
$offset = ($page - 1) * $records_per_page;

// Search filter
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Build WHERE clause
$where_conditions = array();
if ($id_dealer != '') {
	$where_conditions[] = "p.id_dealer = '$id_dealer'";
}

if ($search != '') {
	$search_conditions = array(
		"p.do_num LIKE '%$search%'",
		"MATCH (dealer.nama_dealer) AGAINST ('$search*' IN BOOLEAN MODE)",
		"p.nama_gudang LIKE '%$search%'",
		"p.exit_date LIKE '%$search%'",
		"p.estimation_date LIKE '%$search%'",
		"p.date_terima_ekspedisi LIKE '%$search%'",
		"p.status_pengiriman LIKE '%$search%'",
		"p.received_name LIKE '%$search%'",
		"p.sum_harga LIKE '%$search%'",
		"p.do_print_date LIKE '%$search%'"
	);
	$where_conditions[] = "(" . implode(" OR ", $search_conditions) . ")";
}

$where_clause = count($where_conditions) > 0 ? "WHERE " . implode(" AND ", $where_conditions) : "";

// Get total records for pagination
$count_sql = "SELECT COUNT(*) as total FROM tbl_pengiriman AS p 
              LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota 
              LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer 
              $where_clause";
$count_result = mysqli_query($con, $count_sql);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch data
$sql = "SELECT p.*, kota.nama_kota, dealer.nama_dealer 
        FROM tbl_pengiriman AS p 
        LEFT JOIN tbl_kota AS kota ON p.id_kota = kota.id_kota 
        LEFT JOIN tbl_dealer AS dealer ON p.id_dealer = dealer.id_dealer 
        $where_clause 
        ORDER BY p.exit_date DESC 
        LIMIT $offset, $records_per_page";
$result = mysqli_query($con, $sql);
?>

<div class="container">
	<div class="widget-header">
		<i class="fa fa-list-alt"></i>
		<h3>Laporan Pengiriman - <font color="blue">All Data</font>
		</h3>
	</div>

	<!-- Search Form -->
	<div class="widget-content" style="padding: 15px; margin-bottom: 10px;">
		<form method="GET" action="" class="form-inline">
			<input type="hidden" name="page" value="dashboard">
			<div class="form-group">
				<label>Search:</label>
				<input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search...">
			</div>
			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
			<?php if ($search != ''): ?>
				<a href="?page=dashboard" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
			<?php endif; ?>
			<span class="pull-right" style="line-height: 34px;">
				<strong>Total Records: <?php echo number_format($total_records); ?></strong>
			</span>
		</form>
	</div>

	<div class="widget-content">
		<div class="table-responsive">
			<table width="100%" class="table table-hover table-bordered" style="font-size: 12px;">
				<thead>
					<tr style="background-color: #f5f5f5;">
						<th style="text-align:center; vertical-align: middle;"><i class="fa fa-cog"></i></th>
						<th style="text-align:center; vertical-align: middle;">DO Num</th>
						<th style="text-align:center; vertical-align: middle;">Warehouse</th>
						<th style="text-align:center; vertical-align: middle;">DO Print Date</th>
						<th style="text-align:center; vertical-align: middle;">Exit Date</th>
						<th style="text-align:center; vertical-align: middle;">Estimation Date</th>
						<th style="text-align:center; vertical-align: middle;">Delivered Date</th>
						<th style="text-align:center; vertical-align: middle;">Dealer</th>
						<th style="text-align:center; vertical-align: middle;">Total Cost (IDR)</th>
						<th style="text-align:center; vertical-align: middle;">Status Delivery</th>
						<th style="text-align:center; vertical-align: middle;">Delivery Late Time</th>
						<th style="text-align:center; vertical-align: middle;">Received Name</th>
					</tr>
				</thead>
				<tbody>
					<?php if (mysqli_num_rows($result) > 0): ?>
						<?php while ($row = mysqli_fetch_assoc($result)): ?>
							<tr>
								<td style="text-align:center;">
									<button type="button" class="btn btn-info btn-sm" onclick="loaddashboardmodal(<?php echo $row['id_pengiriman']; ?>)">
										<i class="fa fa-eye"></i>
									</button>
								</td>
								<td style="text-align:center;">
									<?php echo htmlspecialchars($row['do_num']); ?>
								</td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['nama_gudang']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['do_print_date']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['exit_date']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['estimation_date']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['date_terima_ekspedisi']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['nama_dealer']); ?></td>
								<td style="text-align:right;"><?php echo number_format($row['sum_harga'], 0); ?></td>
								<td style="text-align:center;">
									<?php
									$status = strtoupper($row['status_pengiriman']);
									$badge_class = '';
									if ($status == 'DELIVERED') {
										$badge_class = 'label-success';
									} elseif ($status == 'PROGRESS') {
										$badge_class = 'label-warning';
									} else {
										$badge_class = 'label-info';
									}
									?>
									<span class="label <?php echo $badge_class; ?>"><?php echo $status; ?></span>
								</td>
								<td style="text-align:center;">
									<?php
									if ($row['status_pengiriman'] == 'delivered') {
										if ($row['status_penerimaan'] == 'late') {
											echo $row['late'] . ' Hari';
										} else {
											echo strtoupper($row['status_penerimaan']);
										}
									} else {
										echo '-';
									}
									?>
								</td>
								<td style="text-align:center;"><?php echo strtoupper(htmlspecialchars($row['received_name'])); ?></td>
							</tr>
						<?php endwhile; ?>
					<?php else: ?>
						<tr>
							<td colspan="11" style="text-align:center; padding: 30px;">
								<i class="fa fa-info-circle"></i> No data found
							</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<!-- Pagination -->
		<?php if ($total_pages > 1): ?>
			<div style="padding: 15px; text-align: center;">
				<ul class="pagination" style="margin: 0;">
					<?php if ($page > 1): ?>
						<li><a href="?page=dashboard&pg=<?php echo ($page - 1); ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>">« Previous</a></li>
					<?php endif; ?>

					<?php
					$start_page = max(1, $page - 2);
					$end_page = min($total_pages, $page + 2);

					if ($start_page > 1): ?>
						<li><a href="?page=dashboard&pg=1<?php echo $search ? '&search=' . urlencode($search) : ''; ?>">1</a></li>
						<?php if ($start_page > 2): ?>
							<li class="disabled"><span>...</span></li>
						<?php endif; ?>
					<?php endif; ?>

					<?php for ($i = $start_page; $i <= $end_page; $i++): ?>
						<li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
							<a href="?page=dashboard&pg=<?php echo $i; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>">
								<?php echo $i; ?>
							</a>
						</li>
					<?php endfor; ?>

					<?php if ($end_page < $total_pages): ?>
						<?php if ($end_page < $total_pages - 1): ?>
							<li class="disabled"><span>...</span></li>
						<?php endif; ?>
						<li><a href="?page=dashboard&pg=<?php echo $total_pages; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>"><?php echo $total_pages; ?></a></li>
					<?php endif; ?>

					<?php if ($page < $total_pages): ?>
						<li><a href="?page=dashboard&pg=<?php echo ($page + 1); ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>">Next »</a></li>
					<?php endif; ?>
				</ul>
				<p style="margin-top: 10px; color: #666;">
					Showing page <?php echo $page; ?> of <?php echo $total_pages; ?>
					(<?php echo number_format($offset + 1); ?> - <?php echo number_format(min($offset + $records_per_page, $total_records)); ?> of <?php echo number_format($total_records); ?> records)
				</p>
			</div>
		<?php endif; ?>
	</div>
</div>

<!-- Modal Container -->
<div id="modalnyadash"></div>