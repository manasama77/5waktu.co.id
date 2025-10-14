<?php
include("config.php");
	
	//query menampilkan data
	$sql = mysqli_query($con, "
	SELECT
	tbl_pengiriman.do_num,
	tbl_pengiriman.nama_gudang,
	tbl_pengiriman.do_print_date,
	tbl_pengiriman.exit_date,
	tbl_pengiriman.waktu_pengiriman AS exit_time,
	tbl_pengiriman.date_terima_ekspedisi,
	tbl_pengiriman.estimation_date,
	tbl_pengiriman.received_date,
	tbl_pengiriman.received_num,
	tbl_pengiriman.notes,
	tbl_dealer.nama_dealer,
	tbl_kota.id_kota,
	tbl_kota.nama_kota,
	tbl_ekspedisi.nama_ekspedisi,
	tbl_pengiriman.random_id,
	tbl_pengiriman.sum_harga,
	tbl_mobil.no_polisi,
	tbl_driver.nama_driver,
	tbl_pengiriman.status_pengiriman,
	tbl_pengiriman.status_penerimaan,
	tbl_pengiriman.late,
	tbl_kota.satuan_penghitungan
	FROM
	tbl_pengiriman
	Inner Join tbl_dealer ON tbl_pengiriman.id_dealer = tbl_dealer.id_dealer
	Inner Join tbl_kota ON tbl_dealer.id_kota = tbl_kota.id_kota
	Inner Join tbl_ekspedisi ON tbl_ekspedisi.id_ekspedisi = tbl_dealer.id_ekspedisi
	Inner Join tbl_mobil ON tbl_pengiriman.id_mobil = tbl_mobil.id_mobil
	Inner Join tbl_driver ON tbl_pengiriman.id_driver = tbl_driver.id_driver
	WHERE tbl_pengiriman.status_pengiriman = 'delivered'
	");
	$no = 0;
?>
<style>
table{
	font-size:11px;
}
</style>
<table border="1">
	<tr>
    	<td align="center" colspan="24"><h3>Laporan Pengiriman - Delivered</h3></td>
    </tr>
	<tr>
		<th align="center">DO Num</th>
		<th align="center">Nama Gudang</th>
        <th align="center">DO Print Date</th>
		<th align="center">Exit Date</th>
		<th align="center">Exit Time</th>
		<th align="center">Date Terima Ekspedisi</th>
		<th align="center">Estimation Date</th>
		<th align="center">Received Date</th>
		<th align="center">Received Num</th>
		<th align="center">Dealer</th>
		<th align="center">Kota</th>
		<th align="center">Ekspedisi</th>
		<th align="center">Produk Name</th>
		<th align="center">Satuan Weight</th>
		<th align="center">Satuan Volumetric</th>
		<th align="center">Quantity</th>
		<th align="center">Harga Dasar</th>
		<th align="center">Jumlah Harga Dasar</th>
		<th align="center">Total Harga</th>
		<th align="center">Mobil</th>
		<th align="center">Driver</th>
		<th align="center">Status</th>
		<th align="center">Jenis Penghitungan</th>
		<th align="center">Notes</th>
	</tr>
	<?php
	while($data = mysqli_fetch_array($sql))
	{
		$no++;
		$random_id=$data['random_id'];
		$satuan_penghitungan=$data['satuan_penghitungan'];
		$notes=$data['notes'];
		
		$kueri_temp=mysqli_query($con,"
		SELECT
		tbl_produk_katalog.produk_name,
		temp_produk.quantity,
		temp_produk.total_harga
		FROM
		temp_produk
		LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
		WHERE temp_produk.random_id='$random_id'");
		
		$row=mysqli_num_rows($kueri_temp);	
		$limit=$row-1;
		if($row==1)
		{
	?>
			<tr>
				<td align="center" valign="top"><?=$data['do_num'];?></td>
				<td align="center" valign="top"><?=$data['nama_gudang'];?></td>
				<td align="center" valign="top"><?=$data['do_print_date'];?></td>
				<td align="center" valign="top"><?=$data['exit_date'];?></td>
				<td align="center" valign="top">
				<?php
				if($data['exit_time']=="normal")
				{
					echo "Normal";
				}
				elseif($data['exit_time']=="late")
				{
					echo "Diatas jam 15.00";
				}
				?>
				</td>
				<td align="center" valign="top"><?=$data['date_terima_ekspedisi'];?></td>
				<td align="center" valign="top"><?=$data['estimation_date'];?></td>
				<td align="center" valign="top"><?=$data['received_date'];?></td>
				<td align="center" valign="top"><?=$data['received_num'];?></td>
				<td align="center" valign="top"><?=$data['nama_dealer'];?></td>
				<td align="center" valign="top"><?=$data['nama_kota'];?></td>
				<td align="center" valign="top"><?=$data['nama_ekspedisi'];?></td>
				<td align="left" valign="top">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.produk_name
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				WHERE temp_produk.random_id='$random_id' limit 0,1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$produk_name=$data_temp['produk_name'];
				?>
				<?=$produk_name;?>
				  <?php
				}
				?>
				</td>
				<td align="left" valign="top">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.weight
				FROM
				tbl_produk_katalog
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 0,1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$weight=$data_temp['weight'];
				?>
				<?=$weight;?>
				  <?php
				}
				?>
				</td>
				<td align="left" valign="top">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.volumetric
				FROM
				tbl_produk_katalog
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 0,1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$volumetric=$data_temp['volumetric'];
				?>
				<?=$volumetric;?>
				  <?php
				}
				?>
				</td>
				<td align="center" valign="top">
				<?php
				$kueri_qty=mysqli_query($con,"
				SELECT
				temp_produk.quantity,
				temp_produk.total_weight,
				temp_produk.total_harga
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				WHERE temp_produk.random_id='$random_id' limit 0,1");
				while($data_temp=mysqli_fetch_array($kueri_qty))
				{
					$quantity=$data_temp['quantity'];
					$total_weight=$data_temp['total_weight'];
					$total_harga=$data_temp['total_harga'];
				?>
				<?=$quantity;?> Qty
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top">
				<?php
				$id_kota = $data['id_kota'];
				$kueri_weight_class=mysqli_query($con,"
				SELECT
				tbl_kategori_produk.id_kategori_produk,
				tbl_kategori_produk.weight_class,
				tbl_produk_katalog.id_produk_katalog
				FROM
				tbl_kategori_produk
				LEFT JOIN tbl_produk_katalog ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 0,1");
				while($data_temp=mysqli_fetch_array($kueri_weight_class))
				{
					if($satuan_penghitungan=="weight")
					{
						$id_kategori_produk=$data_temp['id_kategori_produk'];
						$weight_class=$data_temp['weight_class'];
						
						$id_produk_katalog=$data_temp['id_produk_katalog'];
						$nama_kota = $data['nama_kota'];
						
						if($weight_class=="c" && $id_kategori_produk==11)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="c" && $id_kategori_produk==12 && $total_weight<=20)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="c" && $total_weight<="20")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="b" && $id_kategori_produk==8)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
						}
						elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
						}
						elseif($weight_class=="a" && $id_kategori_produk==2 && $total_weight<="150")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_electone'];
						}
						elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $total_weight<="150")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_clavinova'];
						}
						else
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
							
						}
					}elseif($satuan_penghitungan=="volumetric"){
						
						$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
						$data_harga=mysqli_fetch_array($kueri_harga);
						$harga_dasar=$data_harga['satuan_harga_volumetric'];
					}
				?>
				Rp.<?=$harga_dasar;?>
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top">
				Rp.<?=$total_harga;?>
				</td>
				
				<td align="right" valign="top">Rp.<?=$data['sum_harga'];?></td>
				<td align="center" valign="top"><?=$data['no_polisi'];?></td>
				<td align="center" valign="top"><?=$data['nama_driver'];?></td>
				<td align="center" valign="top"><?=strtoupper($data['status_pengiriman']);?>
				<?php
				if($data['status_pengiriman']=="delivered")
				{
					if($data['late']<0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						$late=strtoupper($data['late']);
						echo "($status_penerimaan $late Hari)";
					}
					elseif($data['late']>=0)
					if($data['late']<0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						echo "($status_penerimaan)";
					}
				}
				?>
				</td>
				<td align="center" valign="top"><?=$satuan_penghitungan;?></td>
				<td align="center" valign="top"><?=$notes;?></td>
			</tr>
	<?php
		}
		elseif($row>1)
		{
	?>
			<tr>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['do_num'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['nama_gudang'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['do_print_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['exit_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top">
				<?php
				if($data['exit_time']=="normal")
				{
					echo "Normal";
				}
				elseif($data['exit_time']=="late")
				{
					echo "Diatas jam 15.00";
				}
				?>
				</td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['date_terima_ekspedisi'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['estimation_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['received_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['received_num'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['nama_dealer'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['nama_kota'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['nama_ekspedisi'];?></td>
				<td align="left" valign="top">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.produk_name,
				temp_produk.quantity,
				temp_produk.total_harga
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				WHERE temp_produk.random_id='$random_id' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$produk_name=$data_temp['produk_name'];
				?>
				<?=$produk_name;?>
				  <?php
				}
				?>
				</td>
				<td align="left" valign="top">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.weight
				FROM
				tbl_produk_katalog
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$weight=$data_temp['weight'];
				?>
				<?=$weight;?>
				  <?php
				}
				?>
				</td>
				<td align="left" valign="top">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.volumetric
				FROM
				tbl_produk_katalog
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$volumetric=$data_temp['volumetric'];
				?>
				<?=$volumetric;?>
				  <?php
				}
				?>
				</td>
				<td align="center" valign="top">
				<?php
				$kueri_qty=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.produk_name,
				temp_produk.quantity,
				temp_produk.total_weight
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				WHERE temp_produk.random_id='$random_id' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_qty))
				{
					$quantity=$data_temp['quantity'];
					$total_weight=$data_temp['total_weight'];
				?>
				<?=$quantity;?> Qty
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top">
				<?php
				$kueri_weight_class=mysqli_query($con,"
				SELECT
				tbl_kategori_produk.id_kategori_produk,
				tbl_kategori_produk.weight_class,
				tbl_produk_katalog.id_produk_katalog
				FROM
				tbl_kategori_produk
				LEFT JOIN tbl_produk_katalog ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_weight_class))
				{
					if($satuan_penghitungan=="weight")
					{
						$id_kategori_produk=$data_temp['id_kategori_produk'];
						$weight_class=$data_temp['weight_class'];
						
						$id_produk_katalog=$data_temp['id_produk_katalog'];
						$id_kota = $data['id_kota'];
						$nama_kota = $data['nama_kota'];
						
						if($weight_class=="c" && $id_kategori_produk==11)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="c" && $id_kategori_produk==12 && $total_weight<=20)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="c" && $total_weight<="20")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="b" && $id_kategori_produk==8)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
						}
						elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
						}
						elseif($weight_class=="a" && $id_kategori_produk==2 && $total_weight<="150")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_electone'];
						}
						elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $total_weight<="150")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_clavinova'];
						}
						else
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
							
						}
					}elseif($satuan_penghitungan=="volumetric"){
						$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
						$data_harga=mysqli_fetch_array($kueri_harga);
						$harga_dasar=$data_harga['satuan_harga_volumetric'];
					}
				?>
				Rp.<?=$harga_dasar;?>
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top">
				<?php
				$kueri_total_harga=mysqli_query($con,"
				SELECT
				temp_produk.total_harga
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				WHERE temp_produk.random_id='$random_id' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_total_harga))
				{
					$total_harga=$data_temp['total_harga'];
				?>
				Rp.<?=$total_harga;?>
				  <?php
				}
				?>
				</td>
				
				<td rowspan="<?=$row;?>" align="right" valign="top">Rp.<?=$data['sum_harga'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['no_polisi'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$data['nama_driver'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=strtoupper($data['status_pengiriman']);?>
				<?php
				if($data['status_pengiriman']=="delivered")
				{
					if($data['late']<0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						$late=strtoupper($data['late']);
						echo "($status_penerimaan $late Hari)";
					}
					elseif($data['late']>=0)
					if($data['late']<0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						echo "($status_penerimaan)";
					}
				}
				?>
				</td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$satuan_penghitungan;?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top"><?=$notes;?></td>
			</tr>
			<?php
			$kueri_next=mysqli_query($con,"
			SELECT
			tbl_produk_katalog.id_produk_katalog,
			tbl_produk_katalog.produk_name,
			tbl_produk_katalog.weight,
			tbl_produk_katalog.volumetric,
			temp_produk.quantity,
			temp_produk.total_weight,
			temp_produk.total_harga
			FROM
			temp_produk
			LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
			WHERE temp_produk.random_id='$random_id' limit 1,$limit");
			
			$row2=mysqli_num_rows($kueri_next);

			while($data_temp=mysqli_fetch_array($kueri_next))
			{
				
				$id_produk_katalog=$data_temp['id_produk_katalog'];
				$produk_name=$data_temp['produk_name'];
				$weight=$data_temp['weight'];
				$volumetric=$data_temp['volumetric'];
				$quantity=$data_temp['quantity'];
				$total_weight=$data_temp['total_weight'];
				$total_harga=$data_temp['total_harga'];
			?>
			<tr>
				<td align="left" valign="top"><?=$produk_name;?></td>
				<td align="left" valign="top"><?=$weight;?></td>
				<td align="left" valign="top"><?=$volumetric;?></td>
				<td align="center" valign="top"><?=$quantity;?> Qty</td>
				
				<td align="right" valign="top">
				<?php
				$kueri_weight_class=mysqli_query($con,"
				SELECT
				tbl_kategori_produk.id_kategori_produk,
				tbl_kategori_produk.weight_class,
				tbl_produk_katalog.id_produk_katalog
				FROM
				tbl_kategori_produk
				LEFT JOIN tbl_produk_katalog ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE tbl_produk_katalog.produk_name='$produk_name' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_weight_class))
				{
					if($satuan_penghitungan=="weight")
					{
						$id_kategori_produk=$data_temp['id_kategori_produk'];
						$weight_class=$data_temp['weight_class'];
						
						$id_produk_katalog=$data_temp['id_produk_katalog'];
						$id_kota = $data['id_kota'];
						$nama_kota = $data['nama_kota'];
						
						if($weight_class=="c" && $id_kategori_produk==11)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="c" && $id_kategori_produk==12 && $total_weight<=20)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="c" && $total_weight<="20")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_minimum'];
						}
						elseif($weight_class=="b" && $id_kategori_produk==8)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
						}
						elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
						}
						elseif($weight_class=="a" && $id_kategori_produk==2 && $total_weight<="150")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_electone'];
						}
						elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $total_weight<="150")
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_clavinova'];
						}
						else
						{
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga'];
							
						}
					}elseif($satuan_penghitungan=="volumetric"){
						$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
						$data_harga=mysqli_fetch_array($kueri_harga);
						$harga_dasar=$data_harga['satuan_harga_volumetric'];
					}
				?>
				Rp.<?=$harga_dasar;?>
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top">
				Rp.<?=$total_harga;?>
				</td>
			</tr>
			<?php
			}
			?>
	<?php
		}
	}
	?>
	<tr>
		<td align="justify" colspan="24"><h4><i>
		<ol>
			<li>Harga tersebut tidak termasuk PPN 10%</li>
			<li>Apabila waktu exit time diatas jam 15:00, maka late date +1 hari</li>
			<li>Perhitungan weight adalah harga dasar x berat</li>
			<li>Perhitungan volumetric adalah harga dasar x volumetric</li>
			<li> Untuk keyboard dibawah 25kg dan di hitung weigh, maka akan dikenakan harga tetap (harga dasar x jumlah barang)</li>
			<li>Untuk Gitar, electric Guitar dan drum set, dihitung weight akan dihitung berdasarkan harga tetap (harga dasar x jumlah barang)</li>
			<li>Untuk minimum kg pada type barang PA, MProd, Brass, Inst.Part, Acc dan buku adalah 20kg</li>
			<li>Untuk late date jatuh di tanggal merah, maka barang akan diantar hari berikutnya. Dan tetap akan ditulis sesuai tanggal late date</li>
		</ol>
		</i></h4></td>
	</tr>
</table>