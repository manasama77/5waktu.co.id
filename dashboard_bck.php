<style>
td{ font-size:12px; }
</style>
<?php
$id_dealer = $_SESSION['login']['id_dealer'];

if($id_dealer != ''){
	$qdeal = "AND p.id_dealer = '$id_dealer' AND";
}else{
	$qdeal = "";
}

$bulan_sekarang = date('m');

$row = mysqli_num_rows($kueri_dash);

	<thead>
		<tr>
			<th style="text-align:center;">Warehouse</th>
			<th style="text-align:center;">DO Print Date</th>
			<th style="text-align:center;">Exit Date</th>
			<th style="text-align:center;">Estimation Date</th>
			<th style="text-align:center;">Delivered Date</th>
			<th style="text-align:center;">Dealer</th>
			<?php
			if($_SESSION['login']['level'] != "dealer"){
			?>
			<th style="text-align:center;">Total Cost (IDR)</th>
			<?php
			}
			?>
			<th style="text-align:center;">Status Delivery</th>
			<th style="text-align:center;">Delivery Late Time (Day)</th>
			<th style="text-align:center;">Received Name</th>
		</tr>
	</thead>
	<?php
	while($data_waiting = mysqli_fetch_array($kueri_dash))
	{
		$no++;
		$id_pengiriman = $data_waiting['id_pengiriman'];
		$do_print_date = $data_waiting['do_print_date'];
		$exit_date = $data_waiting['exit_date'];
		$estimation_date = $data_waiting['estimation_date'];
		$received_date = $data_waiting['received_date'];
		$do_num = $data_waiting['do_num'];
		$nama_dealer = $data_waiting['nama_dealer'];
		$sum_harga = $data_waiting['sum_harga'];
		$late = $data_waiting['late'];
	?>
	<tr>
			<?=$data_waiting['do_num'];?>
		</button>
		</td>
				echo $late;
				echo strtoupper($data_waiting['status_penerimaan']);
			}
	}
	?>
</table>
</div>
</div>

<div id="modalnyadash"></div>