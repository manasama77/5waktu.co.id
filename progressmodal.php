<!-- Modal -->
<?php
// session_start();
// echo '<pre>'.print_r($sess, 1).'</pre>';
include('config.php');
$id_pengiriman=$_REQUEST['id'];
$level=$_REQUEST['level'];
$kueri_modal=mysqli_query($con, "
	SELECT
	tbl_pengiriman.id_pengiriman as 'id_pengiriman',
	tbl_pengiriman.nama_gudang as 'nama_gudang',
	tbl_pengiriman.random_id as 'random_id',
	tbl_mobil.no_polisi as 'no_polisi',
	tbl_driver.nama_driver as 'nama_driver',
	tbl_asst.nama_asst as 'nama_asst',
	tbl_pengiriman.do_num as 'do_num',
	tbl_pengiriman.do_print_date as 'do_print_date',
	tbl_pengiriman.exit_date as 'exit_date',
	tbl_pengiriman.date_terima_ekspedisi as 'date_terima_ekspedisi',
	tbl_pengiriman.waktu_pengiriman as 'waktu_pengiriman',
	tbl_pengiriman.estimation_date as 'estimation_date',
	tbl_pengiriman.received_num as 'received_num',
	tbl_pengiriman.sum_harga as 'sum_harga',
	tbl_dealer.nama_dealer as 'nama_dealer',
	tbl_ekspedisi.nama_ekspedisi as 'nama_ekspedisi',
	tbl_pengiriman.durasi as 'durasi',
	tbl_kota.nama_kota as 'nama_kota',
	tbl_pengiriman.status_pengiriman as 'status_pengiriman',
	tbl_pengiriman.status_penerimaan as 'status_penerimaan',
	tbl_pengiriman.received_name as 'received_name',
	tbl_pengiriman.notes as 'notes'
	FROM
	tbl_pengiriman
	INNER JOIN tbl_mobil ON tbl_pengiriman.id_mobil = tbl_mobil.id_mobil
	INNER JOIN tbl_driver ON tbl_pengiriman.id_driver = tbl_driver.id_driver
	INNER JOIN tbl_asst ON tbl_pengiriman.id_asst = tbl_asst.id_asst
	INNER JOIN tbl_dealer ON tbl_pengiriman.id_dealer = tbl_dealer.id_dealer
	INNER JOIN tbl_ekspedisi ON tbl_dealer.id_ekspedisi = tbl_ekspedisi.id_ekspedisi
	INNER JOIN tbl_kota ON tbl_dealer.id_kota = tbl_kota.id_kota
	WHERE id_pengiriman = $id_pengiriman
	");
$data_modal=mysqli_fetch_array($kueri_modal);
$random_id=$data_modal['random_id'];
?>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detail Info</h4>
			</div>
			<div class="modal-body">
				<table width="100%" class="table table-responsive table-hover">
					<tr>
						<td width="30px">ID Pengiriman</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['id_pengiriman'];?></td>
					</tr>
					<tr>
						<td width="30px">Nama Gudang</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['nama_gudang'];?></td>
					</tr>
					<tr>
						<td>Mobil</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['no_polisi'];?></td>
					</tr>
					<tr>
						<td>Driver</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['nama_driver'];?></td>
					</tr>
					<tr>
						<td>Asst.</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['nama_asst'];?></td>
					</tr>
					<tr>
						<td>DO Num</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['do_num'];?></td>
					</tr>
					<tr>
						<td>DO Print Date</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['do_print_date'];?></td>
					</tr>
					<tr>
						<td>Exit Date</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['exit_date'];?></td>
					</tr>
					<tr>
						<td>Date Terima Ekspedisi</td>
						<td width="5px" align="center">:</td>
						<td width="100px"><?=$data_modal['date_terima_ekspedisi'];?>
						<?php
						if($level == "super_admin"){
							?>
							<form method="post" id="edit_date_terima_ekspedisi" class="form-horizontal" action="admin.php?page=editdateterimaekspedisi">
								<input name="id_pengiriman" type="hidden" id="id_pengiriman" value="<?=$id_pengiriman;?>" />
								<button class="btn btn-primary" type="submit">Edit Date Terima Ekspedisi</button>
							</form>
							<?php
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Exit Time</td>
					<td width="5px" align="center">:</td>
					<td width="100px">
						<?php
						if($data_modal['waktu_pengiriman']=="normal")
						{
							echo "Normal";
						}
						elseif($data_modal['waktu_pengiriman']=="late")
						{
							echo "Diatas jam 15.00";
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Estimation Date</td>
					<td width="5px" align="center">:</td>
					<td width="100px"><?=$data_modal['estimation_date'];?></td>
				</tr>
				<tr>
					<td>Received Date</td>
					<td width="5px" align="center">:</td>
					<td width="100px">
						<?php
						if($level == "super_admin"){
							?>
							<form method="post" id="add_received_date" class="form-horizontal" action="admin.php?page=addreceivedinfo">
								<input name="id_pengiriman" type="hidden" id="id_pengiriman" value="<?=$id_pengiriman;?>" />
								<input name="estimation_date" type="hidden" id="estimation_date" value="<?=$data_modal['estimation_date'];?>" />
								<button class="btn btn-primary" type="submit">Add Received Info</button>
							</form>
							<?php
						}
						?>
					</td>
				</tr>

				<tr>
					<td>Received Num</td>
					<td width="5px" align="center">:</td>
					<td width="100px"><?=$data_modal['received_num'];?>
					<?php
					if($level == "super_admin"){
						?>
						<form method="post" id="edit_received_num" class="form-horizontal" action="admin.php?page=editreceivednum">
							<input name="id_pengiriman" type="hidden" id="id_pengiriman" value="<?=$id_pengiriman;?>" />
							<button class="btn btn-primary" type="submit">Edit Received Num</button>
						</form>
						<?php
					}
					?>
				</td>
			</tr>

			<tr>
				<td>Dealer</td>
				<td width="5px" align="center">:</td>
				<td width="100px"><?=$data_modal['nama_dealer'];?></td>
			</tr>
			<tr>
				<td>Expedition</td>
				<td width="5px" align="center">:</td>
				<td width="100px"><?=$data_modal['nama_ekspedisi'];?> (<?=$data_modal['durasi'];?> Day)</td>
			</tr>
			<tr>
				<td>Region</td>
				<td width="5px" align="center">:</td>
				<td width="100px"><?=$data_modal['nama_kota'];?></td>
			</tr>
			<tr>
				<td>Product</td>
				<td width="5px" align="center">:</td>
				<td width="100px">
					<?php
					$kueri_temp_produk=mysqli_query($con, "SELECT * FROM temp_produk AS temp LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = temp.id_produk_katalog LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE temp.random_id=$random_id");
					while($data_temp_produk=mysqli_fetch_array($kueri_temp_produk))
					{
						$nama_produk=$data_temp_produk['produk_name'];
						$quantity=$data_temp_produk['quantity'];
						$total_harga=number_format($data_temp_produk['total_harga']);
						$weight_class=strtoupper($data_temp_produk['weight_class']);
						$total_weight=strtoupper($data_temp_produk['total_weight']);
						$total_volumetric=strtoupper($data_temp_produk['total_volumetric']);

						$kueri_total_harga=mysqli_query($con, "SELECT SUM(total_harga) as sum_harga FROM temp_produk WHERE random_id=$random_id");
						$data_total_harga=mysqli_fetch_array($kueri_total_harga);
						$sum_harga=$data_total_harga['sum_harga'];
						?>
						<?=$nama_produk;?> (<?=$quantity;?> Qty) (Rp.<?=$total_harga;?>)<br>
						<?php
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Total Price</td>
				<td width="5px" align="center">:</td>
				<td width="100px">
					<?php
					$price = $data_modal['sum_harga'];

					echo "Rp ".number_format($price);
					?>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td width="5px" align="center">:</td>
				<td width="100px">
					<?php
					$status=strtoupper($data_modal['status_pengiriman']);
					echo $status;
					?>
				</td>
			</tr>
			<tr>
				<td>Received Name</td>
				<td width="5px" align="center">:</td>
				<td width="100px"><?=$data_modal['received_name'];?>
				<?php
				if($level == "super_admin"){
					?>
					<form method="post" id="edit_received_name" class="form-horizontal" action="admin.php?page=editreceivedname">
						<input name="id_pengiriman" type="hidden" id="id_pengiriman" value="<?=$id_pengiriman;?>" />
						<button class="btn btn-primary" type="submit">Edit Received Name</button>
					</form>
					<?php
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Notes</td>
			<td width="5px" align="center">:</td>
			<td width="100px">
				<textarea name="notes" id="notes" cols="45" rows="5" disabled><?=$data_modal['notes'];?></textarea>
				<?php
				if($level == "super_admin"){
					?>
					<form method="post" id="edit_notes" class="form-horizontal" action="admin.php?page=editnotes">
						<input name="id_pengiriman" type="hidden" id="id_pengiriman" value="<?=$id_pengiriman;?>" />
						<button class="btn btn-primary" type="submit">Edit Notes</button>
					</form>
					<?php
				}
				?>
			</td>
		</tr>
	</table>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>