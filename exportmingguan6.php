<?php
$excel_start=$_REQUEST['excel_start2'];
$excel_end=$_REQUEST['excel_end2'];
//$excel_start="2017-02-01";
//$excel_end="2017-02-28";
// Function export page to Excel
header("Content-Disposition: attachment; filename=limawaktulogistic-export-data-".$excel_start."s/d".$excel_end.".xls");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
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
	tbl_pengiriman.date_terima_ekspedisi AS delivery_to_expedition,
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
	Left Join tbl_dealer ON tbl_pengiriman.id_dealer = tbl_dealer.id_dealer
	Left Join tbl_kota ON tbl_dealer.id_kota = tbl_kota.id_kota
	Left Join tbl_ekspedisi ON tbl_ekspedisi.id_ekspedisi = tbl_dealer.id_ekspedisi
	Left Join tbl_mobil ON tbl_pengiriman.id_mobil = tbl_mobil.id_mobil
	Left Join tbl_driver ON tbl_pengiriman.id_driver = tbl_driver.id_driver
	WHERE tbl_pengiriman.exit_date BETWEEN '$excel_start' AND '$excel_end'	AND tbl_pengiriman.status_pengiriman = 'delivered'
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
    	<td align="center" colspan="27"><h3>Report Range - <?=$excel_start;?> / <?=$excel_end;?></h3></td>
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
		<th align="center">Notes</th>		<th align="center">Late Penalty</th>
	</tr>
	<?php	$sum_total_late_penalty = "0";
	while($data = mysqli_fetch_array($sql))
	{
		$no++;
		
		$do_num=$data['do_num'];
		$nama_gudang=$data['nama_gudang'];
		$do_print_date=$data['do_print_date'];
		$exit_date=$data['exit_date'];
		$exit_time=$data['exit_time'];
		$delivery_to_expedition=$data['delivery_to_expedition'];
		$estimation_date=$data['estimation_date'];
		$received_date=$data['received_date'];
		$received_num=$data['received_num'];
		$received_name=$data['received_name'];
		$notes=$data['notes'];
		$nama_dealer=$data['nama_dealer'];
		$id_kota=$data['id_kota'];
		$nama_kota=$data['nama_kota'];
		$nama_ekspedisi=$data['nama_ekspedisi'];
		$random_id=$data['random_id'];
		$sum_harga=$data['sum_harga'];
		$no_polisi=$data['no_polisi'];
		$nama_driver=$data['nama_driver'];
		$status_pengiriman=$data['status_pengiriman'];
		$status_penerimaan=$data['status_penerimaan'];
		$late=$data['late'];
		$satuan_penghitungan=$data['satuan_penghitungan'];
	?>
			<tr>
				<td align="center" valign="top" ><?=$do_num;?></td>
				<td align="center" valign="top" ><?=$nama_gudang;?></td>
				<td align="center" valign="top" ><?=$do_print_date;?></td>
				<td align="center" valign="top" ><?=$exit_date;?></td>
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
				<td align="center" valign="top" ><?=$delivery_to_expedition;?></td>
				<td align="center" valign="top" ><?=$estimation_date;?></td>
				<td align="center" valign="top" ><?=$received_date;?></td>
				<td align="center" valign="top" ><?=$received_num;?></td>
				<td align="center" valign="top" ><?=$nama_dealer;?></td>
				<td align="center" valign="top" ><?=$nama_kota;?></td>
				<td align="center" valign="top" ><?=$nama_ekspedisi;?></td>
				<td align="left" valign="top" >
				
				<table border="1">
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.id_kategori_produk,
				tbl_produk_katalog.produk_name,
				tbl_kategori_produk.weight_class,
				temp_produk.quantity,
				temp_produk.total_weight,
				temp_produk.total_harga
				FROM
				temp_produk
				LEFT Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				LEFT Join tbl_kategori_produk ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE temp_produk.random_id='$random_id'");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$id_kategori_produk=$data_temp['id_kategori_produk'];
					$weight_class=$data_temp['weight_class'];
					$produk_name=$data_temp['produk_name'];
					$quantity=$data_temp['quantity'];
					$total_weight=$data_temp['total_weight'];
					$total_harga=$data_temp['total_harga'];
				?>
				<tr>
					<td><?=$produk_name;?></td>
				</tr>
				  <?php
				}
				?>
				</table>
				</td>
				
				<td align="left" valign="top" >
				<?php
				$kueri_produk_name=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.weight,
				tbl_produk_katalog.volumetric
				FROM
				tbl_produk_katalog
				WHERE tbl_produk_katalog.produk_name='$produk_name'");
				while($data_temp=mysqli_fetch_array($kueri_produk_name))
				{
					$weight=$data_temp['weight'];
					$volumetric=$data_temp['volumetric'];
				?>
				<?=$weight;?>
				  <?php
				}
				?>
				</td>
				<td align="left" valign="top">
				<?=$volumetric;?>
				</td>
				<td align="center" valign="top" >
				<?=$quantity;?> Qty
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
				$kueri_weight_class=mysqli_query($con,"
				SELECT
				tbl_kategori_produk.id_kategori_produk,
				tbl_kategori_produk.weight_class,
				tbl_produk_katalog.id_produk_katalog
				FROM
				tbl_kategori_produk
				LEFT JOIN tbl_produk_katalog ON tbl_produk_katalog.id_kategori_produk = tbl_kategori_produk.id_kategori_produk
				WHERE tbl_produk_katalog.produk_name='$produk_name'");
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
				
				<td align="right" valign="top" ><?=number_format($sum_harga);?></td>
				<td align="center" valign="top" ><?=$no_polisi;?></td>
				<td align="center" valign="top" ><?=$nama_driver;?></td>
				<td align="center" valign="top" ><?=strtoupper($status_pengiriman);?></td>
				<td align="center" valign="top" >
				<?php
				if($status_pengiriman=="delivered")
				{
					if($late<0)
					{
						$status_penerimaan=strtoupper($status_penerimaan);
						$late=strtoupper($late);
						echo "$late";
					}
					elseif($late>=0)
					{
						$status_penerimaan=strtoupper($status_penerimaan);						$late = "0";
						echo "$late";
					}										$telat = str_replace("-", "", $late);					$late_penalty = ($data['sum_harga'] * $telat) * 0.001;
				}else{					$late_penalty = "0";				}								$sum_total_late_penalty += $late_penalty;
				?>
				</td>
				<td align="center" valign="top" ><?=$received_name;?></td>
				<td align="center" valign="top" ><?=$notes;?></td>				<td align="center" valign="top" ><?=$late_penalty;?></td>
			</tr>
	<?php
	}
	?>
    <?php
	$kueri_sum_harga=mysqli_query($con,"SELECT SUM(tbl_pengiriman.sum_harga) AS sum_total_harga FROM tbl_pengiriman WHERE tbl_pengiriman.exit_date BETWEEN '$excel_start' AND '$excel_end'");
	$data_sum_harga=mysqli_fetch_array($kueri_sum_harga);
	$sum_total_harga=$data_sum_harga['sum_total_harga'];
	?>
    <tr>    	<td align="right" colspan="3"><b>Sum Total Harga</b></td>        <td align="left" colspan="24"><b><?=number_format($sum_total_harga);?></b></td>			<tr>		<td align="right" colspan="3"><b>Sum Total Late Penalty</b></td>				<td align="left" colspan="24"><b><?=number_format($sum_total_late_penalty);?></b></td>    </tr>		<?php	$grand_total = $sum_total_harga - $sum_total_late_penalty;	?>		<tr>		<td align="right" colspan="3"><b>Grand Total</b></td>		<td align="left" colspan="24"><b><?=number_format($grand_total);?></b></td>	</tr>
	<tr>
		<td align="justify" colspan="27"><h4><i>
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