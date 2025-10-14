<?php
// Get session data
$level = $_SESSION['login']['level'];
$id_dealer = $_SESSION['login']['id_dealer'];

// Pagination settings
$records_per_page = 25;
$page = isset($_GET['progress_page']) ? (int)$_GET['progress_page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Search functionality
$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

// Build WHERE conditions
$where_conditions = array("p.status_pengiriman = 'progress'");

// Filter by dealer if not super_admin or staff
if ($level != 'super_admin' && $level != 'staff' && !empty($id_dealer)) {
	$where_conditions[] = "p.id_dealer = '" . mysqli_real_escape_string($con, $id_dealer) . "'";
}

// Add search conditions
if (!empty($search)) {
	$search_conditions = array(
		"p.do_num LIKE '%" . $search . "%'",
		"p.nama_gudang LIKE '%" . $search . "%'",
		"p.do_print_date LIKE '%" . $search . "%'",
		"p.exit_date LIKE '%" . $search . "%'",
		"p.estimation_date LIKE '%" . $search . "%'",
		"dealer.nama_dealer LIKE '%" . $search . "%'",
		"CAST(p.sum_harga AS CHAR) LIKE '%" . $search . "%'"
	);
	$where_conditions[] = "(" . implode(" OR ", $search_conditions) . ")";
}

$where_clause = implode(" AND ", $where_conditions);

// Get total records
$count_sql = "SELECT COUNT(*) as total 
              FROM tbl_pengiriman p 
              LEFT JOIN tbl_kota kota ON p.id_kota = kota.id_kota 
              LEFT JOIN tbl_dealer dealer ON p.id_dealer = dealer.id_dealer 
              WHERE " . $where_clause;
$count_result = mysqli_query($con, $count_sql);
$count_row = mysqli_fetch_assoc($count_result);
$total_records = $count_row['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch records
$sql = "SELECT p.*, kota.nama_kota, dealer.nama_dealer 
        FROM tbl_pengiriman p 
        LEFT JOIN tbl_kota kota ON p.id_kota = kota.id_kota 
        LEFT JOIN tbl_dealer dealer ON p.id_dealer = dealer.id_dealer 
        WHERE " . $where_clause . " 
        ORDER BY p.exit_date DESC 
        LIMIT " . $offset . ", " . $records_per_page;
$result = mysqli_query($con, $sql);
?>

<div class="container">
	<div class="widget-header">
		<i class="fa fa-list-alt"></i>
		<h3>Laporan Pengiriman - <font color="blue">Progress</font>
		</h3>
	</div>

	<div class="widget-content">
		<?php if ($level == "super_admin" || $level == "staff") { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left">
						<h3>
							<a href="admin.php?page=addpengiriman1" class="btn btn-primary">
								<i class="fa fa-plus"></i> Add Pengiriman
							</a>
						</h3>
					</td>
				</tr>
			</table>
		<?php } ?>

		<!-- Search Form -->
		<div class="row" style="margin-bottom: 15px;">
			<div class="col-md-6" style="padding-left: 30px;">
				<form method="GET" action="admin.php" class="form-inline">
					<input type="hidden" name="page" value="pengirimanprogress">
					<div class="form-group">
						<input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>" style="width: 300px;">
					</div>
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
					<?php if (!empty($search)) { ?>
						<a href="admin.php?page=pengirimanprogress" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</a>
					<?php } ?>
				</form>
			</div>
			<div class="col-md-6 text-right">
				<p class="text-muted" style="margin-top: 7px;">
					Showing <?php echo $total_records > 0 ? ($offset + 1) : 0; ?> to <?php echo min($offset + $records_per_page, $total_records); ?> of <?php echo $total_records; ?> entries
				</p>
			</div>
		</div>

		<div class="table-responsive">
			<table width="100%" class="table table-hover table-bordered small">
				<thead>
					<tr>
						<th style="text-align:center;"><i class="fa fa-gear"></i></th>
						<th style="text-align:center;">DO Num</th>
						<th style="text-align:center;">Warehouse</th>
						<th style="text-align:center;">DO Print Date</th>
						<th style="text-align:center;">Exit Date</th>
						<th style="text-align:center;">Estimation Date</th>
						<th style="text-align:center;">Dealer</th>
						<th style="text-align:right;">Total Cost (IDR)</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
					?>
							<tr>
								<td style="text-align:center;">
									<?php if ($level == "super_admin") { ?>
										<a href="admin.php?page=editpengirimanprogress&random_id=<?php echo $row['random_id']; ?>&id=<?php echo $row['id_pengiriman']; ?>">
											<button type="button" class="btn btn-primary btn-xs" title="Edit Laporan">
												<i class="fa fa-edit"></i>
											</button>
										</a>
										<a href="deletepengirimanprogress.php?random_id=<?php echo $row['random_id']; ?>&id=<?php echo $row['id_pengiriman']; ?>" onClick="return confirm('Are you sure you want to DELETE?');">
											<button type="button" class="btn btn-danger btn-xs" title="Delete Laporan">
												<i class="fa fa-trash"></i>
											</button>
										</a>
									<?php } else { ?>
										<button type="button" class="btn btn-primary btn-xs" disabled title="Edit Laporan">
											<i class="fa fa-edit"></i>
										</button>
										<button type="button" class="btn btn-danger btn-xs" disabled title="Delete Laporan">
											<i class="fa fa-trash"></i>
										</button>
									<?php } ?>

									<button type="button" class="btn btn-info btn-xs" onClick="loadprogressmodal(<?php echo $row['id_pengiriman']; ?>)">
										<i class="fa fa-eye"></i>
									</button>
								</td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['do_num']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['nama_gudang']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['do_print_date']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['exit_date']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['estimation_date']); ?></td>
								<td style="text-align:center;"><?php echo htmlspecialchars($row['nama_dealer']); ?></td>
								<td style="text-align:right;"><?php echo number_format($row['sum_harga'], 0); ?></td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td colspan="8" style="text-align:center;">No data found</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<!-- Pagination -->
		<?php if ($total_pages > 1) { ?>
			<div class="text-center">
				<ul class="pagination">
					<?php if ($page > 1) { ?>
						<li><a href="admin.php?page=pengirimanprogress&progress_page=<?php echo ($page - 1); ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">&laquo; Previous</a></li>
					<?php } else { ?>
						<li class="disabled"><span>&laquo; Previous</span></li>
					<?php } ?>

					<?php
					$start_page = max(1, $page - 2);
					$end_page = min($total_pages, $page + 2);

					if ($start_page > 1) {
						echo '<li><a href="admin.php?page=pengirimanprogress&progress_page=1' . (!empty($search) ? '&search=' . urlencode($search) : '') . '">1</a></li>';
						if ($start_page > 2) {
							echo '<li class="disabled"><span>...</span></li>';
						}
					}

					for ($i = $start_page; $i <= $end_page; $i++) {
						if ($i == $page) {
							echo '<li class="active"><span>' . $i . '</span></li>';
						} else {
							echo '<li><a href="admin.php?page=pengirimanprogress&progress_page=' . $i . (!empty($search) ? '&search=' . urlencode($search) : '') . '">' . $i . '</a></li>';
						}
					}

					if ($end_page < $total_pages) {
						if ($end_page < $total_pages - 1) {
							echo '<li class="disabled"><span>...</span></li>';
						}
						echo '<li><a href="admin.php?page=pengirimanprogress&progress_page=' . $total_pages . (!empty($search) ? '&search=' . urlencode($search) : '') . '">' . $total_pages . '</a></li>';
					}
					?>

					<?php if ($page < $total_pages) { ?>
						<li><a href="admin.php?page=pengirimanprogress&progress_page=<?php echo ($page + 1); ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">Next &raquo;</a></li>
					<?php } else { ?>
						<li class="disabled"><span>Next &raquo;</span></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</div>

<div id="modalnyaprog"></div>