<?php
include("config.php");
$id_print = $_REQUEST['id'];

$q_print = mysqli_query($con, "SELECT
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
WHERE tbl_pengiriman.id_pengiriman = '$id_print'");

$fa_q_print = mysqli_fetch_array($q_print);
$p1 = $fa_q_print['do_num'];
$p2 = $fa_q_print['nama_dealer'];
$p3 = $fa_q_print['do_print_date'];
$p4 = $fa_q_print['exit_date'];
$p5 = $fa_q_print['estimation_date'];
$p6 = $fa_q_print['received_date'];
$p7 = $fa_q_print['random_id'];
$p8 = $fa_q_print['sum_harga'];
$p9 = $fa_q_print['late'];

if($p9 < "0"){
	$telat = str_replace("-", "", $p9);
	$late_penalty = ($p8 * $telat) * 0.001;
}else{
	$late_penalty = 0;
}

?>
<style>
td{
	vertical-align:top;
}
</style>
<table cellpadding="2" class="table">
	<tr>
		<td style="text-align:center;" colspan="3">
			<font size="5px">INVOICE</font><br>
			<font size="3px">DO No: <?=$p1;?></font>
		</td>
	</tr>
	<tr>
		<td style="text-align:left; width:100px;">Dealer</td>
		<td style="text-align:center; width:10px;">:</td>
		<td style="text-align:left;"><?=$p2;?></td>
	</tr>
	<tr>
		<td style="text-align:left;">DO Print</td>
		<td style="text-align:center;">:</td>
		<td style="text-align:left;"><?=$p3;?></td>
	</tr>
	<tr>
		<td style="text-align:left;">Exit Date</td>
		<td style="text-align:center;">:</td>
		<td style="text-align:left;"><?=$p4;?></td>
	</tr>
	<tr>
		<td style="text-align:left;">Estimation Date</td>
		<td style="text-align:center;">:</td>
		<td style="text-align:left;"><?=$p5;?></td>
	</tr>
	<tr>
		<td style="text-align:left;">Delivered Date</td>
		<td style="text-align:center;">:</td>
		<td style="text-align:left;"><?=$p6;?></td>
	</tr>
	<tr>
		<td style="text-align:center;" colspan="3"><H3><hr></H3></td>
	</tr>
</table>
<table cellpadding="2" class="table table-bordered table-hover">
	<tr>
		<th style="width:10px;">No</th>
		<th>Item</th>
		<th style="width:50px;">QTY</th>
		<th style="width:50px;">Weight</th>
		<th style="text-align:right; width:170px;">Price</th>
	</tr>
<?php
$q_temp_produk = mysqli_query($con, "SELECT
temp_produk.quantity,
temp_produk.total_harga,
temp_produk.total_weight,
temp_produk.total_volumetric,
temp_produk.weight_class,
tbl_produk_katalog.produk_name,
tbl_produk_katalog.weight,
tbl_produk_katalog.volumetric,
tbl_produk_katalog.panjang,
tbl_produk_katalog.lebar,
tbl_produk_katalog.tinggi,
tbl_produk_katalog.packing_status,
tbl_produk_katalog.id_kategori_produk
FROM
temp_produk
Left Join tbl_produk_katalog ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
WHERE
temp_produk.random_id =  '$p7'");
$no="1";
while($fa_q_temp_produk = mysqli_fetch_array($q_temp_produk)){
	$c1 = $fa_q_temp_produk['produk_name'];
	$c2 = $fa_q_temp_produk['quantity'];
	$c3 = $fa_q_temp_produk['total_weight'];
	$c4 = $fa_q_temp_produk['total_harga'];
?>
	<tr>
		<td style="text-align:center;"><?=$no;?></td>
		<td style="text-align:left;"><?=$c1;?></td>
		<td style="text-align:center;"><?=$c2;?></td>
		<td style="text-align:center;"><?=$c3;?></td>
		<td style="text-align:right;">Rp.<?=number_format($c4);?></td>
	</tr>
<?php
	$no++;
}

$grand_total = $p8 - $late_penalty;
?>
	<tr>
		<th colspan="4" style="text-align:right;">Total</th>
		<th style="text-align:right;">Rp.<?=number_format($p8);?></th>
	</tr>
	<tr>
		<th colspan="4" style="text-align:right;">Late Penalty</th>
		<th style="text-align:right;">Rp.<?=number_format($late_penalty);?></th>
	</tr>
	<tr>
		<th colspan="4" style="text-align:right;">Grand Total</th>
		<th style="text-align:right;">Rp.<?=number_format($grand_total);?></th>
	</tr>
</table>