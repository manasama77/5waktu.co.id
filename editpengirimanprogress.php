<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Pengiriman</h3></div>
	<div class="widget-content">
		<?php
			include('config.php');
		?>
		<div id="formcontrols" class="tab-pane active">
			<?php
				if(isset($_REQUEST['status']))
				{
					if($_REQUEST['status']=="delivered")
					{
						$status="delivered";
					}
					else
					{
						$status="progress";
					}
				}
				else
				{
					$status="progress";
				}
				$random_id=$_REQUEST['random_id'];
				$id=$_REQUEST['id'];
				$kueri_pengiriman=mysqli_query($con, "SELECT
				tbl_pengiriman.do_num,
				tbl_pengiriman.random_id,
				tbl_kota.nama_kota,
				tbl_provinsi.nama_provinsi,
				tbl_dealer.nama_dealer,
				tbl_ekspedisi.nama_ekspedisi,
				tbl_mobil.no_polisi,
				tbl_driver.nama_driver,
				tbl_asst.nama_asst,
				tbl_pengiriman.do_print_date,
				tbl_pengiriman.exit_date,
				tbl_pengiriman.estimation_date,
				tbl_pengiriman.received_num,
				tbl_pengiriman.satuan_penghitungan,
				tbl_pengiriman.durasi,
				tbl_pengiriman.status_pengiriman,
				tbl_pengiriman.notes,
				tbl_kota.id_kota,
				tbl_dealer.id_dealer,
				tbl_provinsi.id_provinsi,
				tbl_asst.id_asst,
				tbl_ekspedisi.id_ekspedisi,
				tbl_mobil.id_mobil,
				tbl_driver.id_driver
				FROM
				tbl_pengiriman
				LEFT Join tbl_kota ON tbl_pengiriman.id_kota = tbl_kota.id_kota
				LEFT Join tbl_provinsi ON tbl_kota.id_provinsi = tbl_provinsi.id_provinsi
				LEFT Join tbl_dealer ON tbl_pengiriman.id_dealer = tbl_dealer.id_dealer
				LEFT Join tbl_ekspedisi ON tbl_dealer.id_ekspedisi = tbl_ekspedisi.id_ekspedisi
				LEFT Join tbl_mobil ON tbl_pengiriman.id_mobil = tbl_mobil.id_mobil
				LEFT Join tbl_driver ON tbl_pengiriman.id_driver = tbl_driver.id_driver
				LEFT Join tbl_asst ON tbl_pengiriman.id_asst = tbl_asst.id_asst
				WHERE tbl_pengiriman.id_pengiriman = '$id'
				");				
				$data_pengiriman=mysqli_fetch_array($kueri_pengiriman);				
				$id_provinsi = $data_pengiriman['id_provinsi'];
				$nama_provinsi = $data_pengiriman['nama_provinsi'];
				$id_kota = $data_pengiriman['id_kota'];
				$_SESSION["id_kota"]=$id_kota;
				$nama_kota = $data_pengiriman['nama_kota'];
				$satuan_penghitungan = $data_pengiriman['satuan_penghitungan'];
				$_SESSION["satuan_penghitungan"]=$satuan_penghitungan;
				$id_dealer = $data_pengiriman['id_dealer'];								
				$nama_dealer = $data_pengiriman['nama_dealer'];								
												
				$do_num=$data_pengiriman["do_num"];								
												
				$id_mobil = $data_pengiriman['id_mobil'];								
				$no_polisi = $data_pengiriman['no_polisi'];								
												
				$id_driver = $data_pengiriman['id_driver'];								
				$nama_driver = $data_pengiriman['nama_driver'];								
												
				$id_asst = $data_pengiriman['id_asst'];								
				$nama_asst = $data_pengiriman['nama_asst'];								
												
				$random_id=$data_pengiriman['random_id'];								
				$_SESSION["random_id"]=$random_id;								
				$do_print_date1=$data_pengiriman["do_print_date"];								
				$exit_date1=$data_pengiriman["exit_date"];								
				$estimation_date=$data_pengiriman["estimation_date"];								
				$durasi=$data_pengiriman["durasi"];								
				$received_num=$data_pengiriman["received_num"];								
				$notes=$data_pengiriman["notes"];								
			?>						
			<table width="100%" border="0" cellspacing="0" cellpadding="0">								
				<tr>										
					<td width="12%">Provinsi</td>										
					<td width="1%">:</td>										
					<td width="23%"><?=$nama_provinsi;?></td>										
					<td width="9%">Mobil</td>										
					<td width="1%">:</td>										
					<td width="17%"><?=$no_polisi;?></td>										
					<td align="right"><h3>DO Num</h3></td>										
					<td align="center">:</td>										
					<td align="left"><h3><?=$do_num;?></h3></td>										
				</tr>								
				<tr>										
					<td>Kota</td>										
					<td>:</td>										
					<td><?=$nama_kota;?> (<?=$durasi;?> Hari)</td>										
					<td>Driver</td>										
					<td>:</td>										
					<td><?=$nama_driver;?></td>										
					<td align="right">DO Print Date</td>										
					<td align="center">:</td>										
					<td align="left"><?=$do_print_date1;?></td>										
				</tr>								
				<tr>										
					<td>Satuan Penghitungan</td>										
					<td>:</td>										
					<td><?=$satuan_penghitungan;?></td>										
					<td>Assistant</td>										
					<td>:</td>										
					<td><?=$nama_asst;?></td>										
					<td width="23%" align="right">Exit Date</td>										
					<td width="1%" align="center">:</td>										
					<td width="13%"><?=$exit_date1;?></td>										
				</tr>								
				<tr>										
					<td>Dealer</td>										
					<td>:</td>										
					<td><?=$nama_dealer;?></td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td align="right">Estimation Date</td>										
					<td align="center">:</td>										
					<td align="left"><?=$estimation_date;?></td>										
				</tr>								
				<tr>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td align="right">Received Num</td>										
					<td align="center">:</td>										
					<td align="left"><?=$received_num;?></td>										
				</tr>								
				<tr>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td>&nbsp;</td>										
					<td align="right">Notes</td>										
					<td align="center">:</td>										
					<td align="left"><?=$notes;?></td>										
				</tr>								
			</table>						
			<hr />						
			<div class="table-responsive">								
				<b>Produk Info</b>								
				<table width="100%" class="table table-responsive table-hover">										
					<tr>												
						<td align="center" bgcolor="grey"><b>&nbsp;</b></td>												
						<td align="center" bgcolor="grey"><b>No</b></td>												
						<td align="center" bgcolor="grey"><b>Produk Name</b></td>												
						<td align="center" bgcolor="grey"><b>Total Weight</b></td>												
						<td align="center" bgcolor="grey"><b>Total Volumetric</b></td>												
						<td align="center" bgcolor="grey"><b>Kategori</b></td>												
						<td align="center" bgcolor="grey"><b>Quantity</b></td>												
						<td align="center" bgcolor="grey"><b>Harga</b></td>												
					</tr>										
					<?php												
						$no=0;												
						$kueri_temp_produk=mysqli_query($con, "SELECT * FROM temp_produk AS temp LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = temp.id_produk_katalog LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE temp.random_id='$random_id'") or die($con->error);												
						while($data_temp_produk=mysqli_fetch_array($kueri_temp_produk))												
						{														
							$no++;														
							$id_temp_produk=$data_temp_produk['id_temp_produk'];														
							$nama_produk=$data_temp_produk['produk_name'];														
							$quantity=$data_temp_produk['quantity'];														
							$total_harga=$data_temp_produk['total_harga'];														
							$kategori_produk=$data_temp_produk['nama_kategori_produk'];														
							$weight_class=strtoupper($data_temp_produk['weight_class']);														
							$total_weight=strtoupper($data_temp_produk['total_weight']);														
							$total_volumetric=strtoupper($data_temp_produk['total_volumetric']);														
																					
							$kueri_total_harga=mysqli_query($con, "SELECT SUM(total_harga) as sum_harga FROM temp_produk WHERE random_id='$random_id'");														
							$data_total_harga=mysqli_fetch_array($kueri_total_harga);														
							$sum_harga=$data_total_harga['sum_harga'];														
						?>												
						<tr>														
							<td><?php																
								echo("<a href=\"deletecheckout.php?status=$status&&id_temp_produk=$id_temp_produk&&id=$id&&random_id=$random_id\"><i class=\"fa fa-remove\"></i></a>");																
							?></td>														
							<td align="center"><?=$no;?></td>														
							<td align="center"><?=$nama_produk;?></td>														
							<td align="center"><?=$total_weight;?></td>														
							<td align="center"><?=$total_volumetric;?></td>														
							<td align="center"><?=$kategori_produk;?> (Weight Class <?=$weight_class;?>)</td>														
							<td align="center"><?=$quantity;?> <?php																
								echo("<a href=\"admin.php?status=$status&&page=editquantitycheckout&&id=$id&&id_temp_produk=$id_temp_produk&&random_id=$random_id\"><i class=\"fa fa-edit\"></i></a>");																
							?></td>														
							<td align="center"><?=number_format($total_harga);?> <?php																
								echo("<a href=\"admin.php?status=$status&&page=edithargacheckout&&id=$id&&id_temp_produk=$id_temp_produk&&random_id=$random_id\"><i class=\"fa fa-edit\"></i></a>");																
							?></td>														
						</tr>												
						<?php														
						}												
					?>										
					<tr>												
						<td align="center" colspan="6">&nbsp;</td>												
						<td align="center"><strong>Total Harga</strong></td>												
						<td align="center"><b><?=number_format($sum_harga);?></b></td>												
					</tr>										
				</table>								
				<?php										
					$linklink="admin.php?status=$status&&page=addpengiriman6&&id=$id";										
				?>								
				<a href="<?=$linklink;?>"><button class="btn btn-sm btn-warning">+ Add Produk</button></a>								
			</div>						
			<hr />						
			<form action="proseseditcheckout.php?status=<?=$status;?>&&random_id=<?=$random_id;?>&&id=<?=$id;?>&&sum_harga=<?=$sum_harga;?>" id="checkout" method="post">								
				<button class="btn btn-primary" type="submit">Edit</button>								
			</form>						
		</div>				
	</div>		
			
	<script src="js/jquery.validate.min.js"></script>		
	<script src="js/additional-methods.min.js"></script>		
	<script>				
		// just for the demos, avoids form submit				
		jQuery.validator.setDefaults({						
			debug: false,						
			success: "valid"						
		});				
		$( "#add_pengiriman" ).validate({						
			rules: {								
				id_produk_katalog: {										
					required: true										
				},								
				quantity: {										
					required: true,										
					digits: true										
				}								
			}						
		});				
	</script>	