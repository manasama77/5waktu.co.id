<style>
	td {
		font-size: 12px;
	}
</style>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i>
		<h3>Laporan Pengiriman - <font color="blue">Delivered</font>
		</h3>
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
				if ($_SESSION['login']['level'] == "super_admin" || $_SESSION['login']['level'] == "staff") {
				?>
					<td align="left">
						<h3><a href="admin.php?page=addpengiriman1" class="btn btn-primary">
								<i class="fa fa-plus"></i> Add Pengiriman</a></h3>
					</td>
				<?php
				}
				?>
			</tr>
		</table>
		<div class="table-responsive">
			<table id="deliveredlist" width="100%" class="table table-responsive table-hover table-bordered small">
				<thead>
					<tr>
						<th style="text-align:center;">DO Num</th>
						<th style="text-align:center; width: 100px;">Warehouse</th>
						<th style="text-align:center;">DO Print Date</th>
						<th style="text-align:center;">Exit Date</th>
						<th style="text-align:center;">Estimation Date</th>
						<th style="text-align:center;">Delivered Date</th>
						<th style="text-align:center;">Dealer</th>
						<th style="text-align:center;">Total Cost <small>(IDR)</small></th>
						<th style="text-align:center;">Status</th>
						<th style="text-align:center; width: 100px;""><i class=" fa fa-gear"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="modalnyadeli"></div>