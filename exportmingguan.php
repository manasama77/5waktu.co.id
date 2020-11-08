<?php
$excel_start=$_REQUEST['excel_start'];
$excel_end=$_REQUEST['excel_end'];
//$excel_start="2017-02-01";
//$excel_end="2017-02-01";
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=limawaktulogistic-export-data-".$excel_start."-".$excel_end.".xls");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");


 
// Tambahkan table

//include 'alldataexportharian.php';
?>

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
	tbl_pengiriman.received_name,
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
	WHERE tbl_pengiriman.exit_date BETWEEN '$excel_start' AND '$excel_end'
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
    	<td align="center" colspan="26"><h3>Report Range - <?=$excel_start;?> / <?=$excel_end;?></h3></td>
    </tr>
	<tr>
		<th align="center">DO Num</th>
		<th align="center">Warehouse</th>
        <th align="center">DO Print Date</th>
		<th align="center">Exit Date</th>
		<th align="center">Exit Time</th>
		<th align="center">Delivery to Expedition</th>
		<th align="center">Estimation Date</th>
		<th align="center">Received Date</th>
		<th align="center">Received Num</th>
		<th align="center">Dealer</th>
		<th align="center">City</th>
		<th align="center">Expedition</th>
		<th align="center">Product Name</th>
		<th align="center">Weight</th>
		<th align="center">Volumetric</th>
		<th align="center">Quantity</th>
		<th align="center">Calculated Bases</th>
		<th align="center">Basic Cost (IDR)</th>
		<th align="center">Total Cost (IDR)</th>
		<th align="center">Total DO Cost (IDR)</th>
		<th align="center">Delivery Truck</th>
		<th align="center">Truck Driver</th>
		<th align="center">Status Delivery</th>
		<th align="center">Delivery Late Time (DAY)</th>
		<th align="center">Received Name</th>
		<th align="center">Notes</th>
	</tr>
	<?php
	while($data = mysqli_fetch_array($sql))
	{
		$no++;
		$random_id=$data['random_id'];
		$satuan_penghitungan=$data['satuan_penghitungan'];
		$received_name=$data['received_name'];
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
				<td align="center" valign="top" ><?=$data['do_num'];?></td>
				<td align="center" valign="top" ><?=$data['nama_gudang'];?></td>
				<td align="center" valign="top" ><?=$data['do_print_date'];?></td>
				<td align="center" valign="top" ><?=$data['exit_date'];?></td>
				<td align="center" valign="top" >
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
				<td align="center" valign="top" ><?=$data['date_terima_ekspedisi'];?></td>
				<td align="center" valign="top" ><?=$data['estimation_date'];?></td>
				<td align="center" valign="top" ><?=$data['received_date'];?></td>
				<td align="center" valign="top" ><?=$data['received_num'];?></td>
				<td align="center" valign="top" ><?=$data['nama_dealer'];?></td>
				<td align="center" valign="top" ><?=$data['nama_kota'];?></td>
				<td align="center" valign="top" ><?=$data['nama_ekspedisi'];?></td>
				<td align="left" valign="top" >
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.id_kategori_produk,
				tbl_produk_katalog.produk_name,
				tbl_kategori_produk.weight_class
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				LEFT Join tbl_kategori_produk ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE temp_produk.random_id='$random_id' limit 0,1");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$id_kategori_produk=$data_temp['id_kategori_produk'];
					$weight_class=$data_temp['weight_class'];
					$produk_name=$data_temp['produk_name'];
				?>
				<?=$produk_name;?>
				  <?php
				}
				?>
				</td>
				<td align="left" valign="top" >
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
				<td align="left" valign="top" >
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
				<td align="center" valign="top" >
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
				
				<td align="center" valign="top" >
				<?php
				
				if($satuan_penghitungan=="weight")
				{
					if($id_kategori_produk==1)
					{
						echo "WEIGHT";
					}
					elseif($id_kategori_produk==4 && $weight>=151)
					{
						echo "WEIGHT";
					}
					elseif($id_kategori_produk==2 && $weight>=151)
					{
						echo "WEIGHT";
					}
					elseif($weight_class=="c" && $total_weight<=20)
					{
						echo "MINIMUM COST";
					}
					elseif($weight_class=="c")
					{
						echo "WEIGHT";
					}
					else
					{
						echo "UNIT";
					}
				}
				elseif($satuan_penghitungan=="volumetric")
				{
					echo "VOLUMETRIC";
				}
				
				?>
				</td>
				
				<td align="right" valign="top" >
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
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight>=21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight<=20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==12)
							{
								if($quantity<=25)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/25;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==14)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $total_weight<="20")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_minimum'];
							}
							elseif($weight_class=="c" && $total_weight>="21")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==8)
							{
								if($quantity<=6)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/6;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
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
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_electone'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_clavinova'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
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
						
						/*if($weight_class=="c" && $id_kategori_produk==11)
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
					*/
				?>
				<?=number_format($harga_dasar);?>
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top" >
				<?=number_format($total_harga);?>
				</td>
				
				<td align="right" valign="top" ><?=number_format($data['sum_harga']);?></td>
				<td align="center" valign="top" ><?=$data['no_polisi'];?></td>
				<td align="center" valign="top" ><?=$data['nama_driver'];?></td>
				<td align="center" valign="top" ><?=strtoupper($data['status_pengiriman']);?></td>
				<td align="center" valign="top" >
				<?php
				if($data['status_pengiriman']=="delivered")
				{
					if($data['late']<0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						$late=strtoupper($data['late']);
						echo "$late";
					}
					elseif($data['late']>=0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						echo "0";
					}
				}
				?>
				</td>
				<td align="center" valign="top" ><?=$received_name;?></td>
				<td align="center" valign="top" ><?=$notes;?></td>
			</tr>
	<?php
		}
		elseif($row>1)
		{
	?>
			<tr>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['do_num'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['nama_gudang'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['do_print_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['exit_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" >
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
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['date_terima_ekspedisi'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['estimation_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['received_date'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['received_num'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['nama_dealer'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['nama_kota'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['nama_ekspedisi'];?></td>
				<td align="left" valign="top" >
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
				<td align="left" valign="top" >
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
				<td align="left" valign="top" >
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
				<td align="center" valign="top" >
				<?php
				$kueri_qty=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.id_kategori_produk,
				tbl_produk_katalog.produk_name,
				tbl_kategori_produk.weight_class,
				temp_produk.quantity,
				temp_produk.total_weight
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				LEFT Join tbl_kategori_produk ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE temp_produk.random_id='$random_id' limit 1");
				while($data_temp=mysqli_fetch_array($kueri_qty))
				{
					$id_kategori_produk=$data_temp['id_kategori_produk'];
					$weight_class=$data_temp['weight_class'];
					$quantity=$data_temp['quantity'];
					$total_weight=$data_temp['total_weight'];
				?>
				<?=$quantity;?> Qty
				  <?php
				}
				?>
				</td>
				
				<td align="center" valign="top" >
				<?php
				
				if($satuan_penghitungan=="weight")
				{
					if($id_kategori_produk==1)
					{
						echo "WEIGHT";
					}
					elseif($id_kategori_produk==4 && $weight>=151)
					{
						echo "WEIGHT";
					}
					elseif($id_kategori_produk==2 && $weight>=151)
					{
						echo "WEIGHT";
					}
					elseif($weight_class=="c" && $total_weight<=20)
					{
						echo "MINIMUM COST";
					}
					elseif($weight_class=="c")
					{
						echo "WEIGHT";
					}
					else
					{
						echo "UNIT";
					}
				}
				elseif($satuan_penghitungan=="volumetric")
				{
					echo "VOLUMETRIC";
				}
				
				?>
				</td>
				
				<td align="right" valign="top" >
				<?php
				$id_kota=$data['id_kota'];
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
							$nama_kota = $data['nama_kota'];
							
							if($weight_class=="c" && $id_kategori_produk==11)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight>=21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight<=20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==12)
							{
								if($quantity<=25)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/25;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==14)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $total_weight<="20")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_minimum'];
							}
							elseif($weight_class=="c" && $total_weight>="21")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==8)
							{
								if($quantity<=6)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/6;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
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
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
							{
								//echo $id_kota;
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_electone'];
								//echo"<h1>$harga_dasar</h1>";
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
								//echo"<h1>b</h1>";
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_clavinova'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
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
				<?=number_format($harga_dasar);?>
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top" >
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
				<?=number_format($total_harga);?>
				  <?php
				}
				?>
				</td>
				
				<td rowspan="<?=$row;?>" align="right" valign="top" ><?=number_format($data['sum_harga']);?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['no_polisi'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$data['nama_driver'];?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=strtoupper($data['status_pengiriman']);?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" >
				<?php
				if($data['status_pengiriman']=="delivered")
				{
					if($data['late']<0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						$late=strtoupper($data['late']);
						echo "$late";
					}
					elseif($data['late']>=0)
					{
						$status_penerimaan=strtoupper($data['status_penerimaan']);
						echo "0";
					}
				}
				?>
				</td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$received_name;?></td>
				<td rowspan="<?=$row;?>" align="center" valign="top" ><?=$notes;?></td>
			</tr>
			<?php
			$kueri_next=mysqli_query($con,"
			SELECT
			tbl_produk_katalog.id_produk_katalog,
			tbl_produk_katalog.id_kategori_produk,
			tbl_kategori_produk.weight_class,
			tbl_produk_katalog.produk_name,
			tbl_produk_katalog.weight,
			tbl_produk_katalog.volumetric,
			temp_produk.quantity,
			temp_produk.total_weight,
			temp_produk.total_harga
			FROM
			temp_produk
			LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
			LEFT Join tbl_kategori_produk ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
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
				$id_kategori_produk=$data_temp['id_kategori_produk'];
				$weight_class=$data_temp['weight_class'];
			?>
			<tr>
				<td align="left" valign="top" ><?=$produk_name;?></td>
				<td align="left" valign="top" ><?=$weight;?></td>
				<td align="left" valign="top" ><?=$volumetric;?></td>
				<td align="center" valign="top" ><?=$quantity;?> Qty</td>
				<td align="center" valign="top" >
				<?php
				
				if($satuan_penghitungan=="weight")
				{
					/*echo $weight_class;
					echo "<br>";*/
					if($id_kategori_produk==1)
					{
						echo "WEIGHT";
					}
					elseif($id_kategori_produk==4 && $weight>=151)
					{
						echo "WEIGHT";
					}
					elseif($id_kategori_produk==2 && $weight>=151)
					{
						echo "WEIGHT";
					}
					elseif($weight_class=="c" && $total_weight<=20)
					{
						echo "MINIMUM COST";
					}
					elseif($weight_class=="c")
					{
						echo "WEIGHT";
					}
					else
					{
						echo "UNIT";
					}
				}
				elseif($satuan_penghitungan=="volumetric")
				{
					echo "VOLUMETRIC";
				}
				
				?>
				</td>
				
				<td align="right" valign="top" >
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
							$nama_kota = $data['nama_kota'];
							
							if($weight_class=="c" && $id_kategori_produk==11)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight>=21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight<=20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==12)
							{
								if($quantity<=25)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/25;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==14)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $total_weight<="20")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_minimum'];
							}
							elseif($weight_class=="c" && $total_weight>="21")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==8)
							{
								if($quantity<=6)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/6;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
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
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_electone'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_clavinova'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
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
				<?=number_format($harga_dasar);?>
				  <?php
				}
				?>
				</td>
				
				<td align="right" valign="top" >
				<?=number_format($total_harga);?>
				</td>
			</tr>
			<?php
			}
			?>
	<?php
		}
	}
	?>
    <?php
	$kueri_sum_harga=mysqli_query($con,"SELECT SUM(tbl_pengiriman.sum_harga) AS sum_total_harga FROM tbl_pengiriman WHERE tbl_pengiriman.exit_date BETWEEN '$excel_start' AND '$excel_end'");
	$data_sum_harga=mysqli_fetch_array($kueri_sum_harga);
	$sum_total_harga=$data_sum_harga['sum_total_harga'];
	?>
    <tr>
    	<td align="right" colspan="19"><b>Sum Total Harga</b></td>
        <td align="left" colspan="7"><b><?=number_format($sum_total_harga);?></b></td>
    </tr>
	<tr>
		<td align="justify" colspan="26"><h4><i>
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
		</i></h4></td>
	</tr>
</table>