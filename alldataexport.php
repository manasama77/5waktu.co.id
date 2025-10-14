<?php
include("config.php");
	
	//query menampilkan data
	$sql = mysqli_query($con, "
	SELECT
	tbl_pengiriman.do_num,
	tbl_dealer.nama_dealer,
	tbl_kota.nama_kota,
	tbl_pengiriman.random_id,
	tbl_pengiriman.sum_harga,
	tbl_mobil.no_polisi,
	tbl_driver.nama_driver,
	tbl_pengiriman.do_print_date,
	tbl_pengiriman.exit_date,
	tbl_pengiriman.waktu_pengiriman,
	tbl_pengiriman.estimation_date,
	tbl_pengiriman.received_date,
	tbl_pengiriman.received_num,
	tbl_pengiriman.status_pengiriman,
	tbl_pengiriman.status_penerimaan
	FROM
	tbl_pengiriman
	Inner Join tbl_dealer ON tbl_pengiriman.id_dealer = tbl_dealer.id_dealer
	Inner Join tbl_kota ON tbl_dealer.id_kota = tbl_kota.id_kota
	Inner Join tbl_mobil ON tbl_pengiriman.id_mobil = tbl_mobil.id_mobil
	Inner Join tbl_driver ON tbl_pengiriman.id_driver = tbl_driver.id_driver
	");
	$no = 0;
?>
<table border="1">
	<tr>
    	<td align="center" colspan="13"><h3>Laporan Pengiriman - All Data</h3></td>
    </tr>
	<tr>
		<th align="center">DO Num</th>
        <th align="center">DO Print Date</th>
		<th align="center">Exit Date</th>
		<th align="center">Waktu Pick up</th>
		<th align="center">Estimation Date</th>
		<th align="center">Received Date</th>
		<th align="center">Dealer</th>
		<th align="center">Kota</th>
		<th align="center">Produk</th>
		<th align="center">Total Harga</th>
		<th align="center">Mobil</th>
		<th align="center">Driver</th>
		<th align="center">Status</th>
	</tr>
	<?php
	while($data = mysqli_fetch_array($sql))
	{
		$no++;
		$random_id=$data['random_id'];
		
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
		
	?>
		<tr>
			<td align="center"><?=$data['do_num'];?></td>
            <td  align="center"><?=$data['do_print_date'];?></td>
			<td  align="center"><?=$data['exit_date'];?></td>
			<td  align="center">
			<?php
			if($data['waktu_pengiriman']=="normal")
			{
				echo "Normal";
			}
			elseif($data['waktu_pengiriman']=="late")
			{
				echo "Diatas jam 15.00";
			}
			?>
			</td>
			<td  align="center"><?=$data['estimation_date'];?></td>
			<td  align="center"><?=$data['received_date'];?></td>
			<td  align="center"><?=$data['nama_dealer'];?></td>
			<td  align="center"><?=$data['nama_kota'];?></td>
			<td  align="left">
            <?php
			while($data_temp=mysqli_fetch_array($kueri_temp))
			{
				$produk_name=$data_temp['produk_name'];
				$quantity=$data_temp['quantity'];
				$total_harga=$data_temp['total_harga'];
			?>
			<?=$produk_name;?> (<?=$quantity;?> Qty) Rp.<?=$total_harga;?><br />
			  <?php
			}
			?>
			</td>
			<td  align="right">Rp.<?=$data['sum_harga'];?></td>
			<td  align="center"><?=$data['no_polisi'];?></td>
			<td  align="center"><?=$data['nama_driver'];?></td>
			<td  align="center"><?=strtoupper($data['status_pengiriman']);?>
            <?php
			if($data['status_pengiriman']=="delivered")
			{
			?>
            (<?=strtoupper($data['status_penerimaan']);?>)
            <?php
			}
			?>
            </td>
		</tr>
	<?php
	}
	?>
</table>