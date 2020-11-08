<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	$nama_gudang=$_SESSION["nama_gudang"];
	
	$id_provinsi=$_SESSION["id_provinsi"];
	$kueri_provinsi=mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi='$id_provinsi'");
	$data_provinsi=mysqli_fetch_array($kueri_provinsi);
	$id_provinsi = $data_provinsi['id_provinsi'];
	$nama_provinsi = $data_provinsi['nama_provinsi'];
	
	$id_kota=$_SESSION["id_kota"];
	$kueri_kota=mysqli_query($con, "SELECT * FROM tbl_kota WHERE id_kota='$id_kota'");
	$data_kota=mysqli_fetch_array($kueri_kota);
	$id_kota = $data_kota['id_kota'];
	$nama_kota = $data_kota['nama_kota'];
	$satuan_penghitungan = $data_kota['satuan_penghitungan'];
	
	$id_dealer=$_SESSION["id_dealer"];
	$kueri_dealer=mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_dealer='$id_dealer'");
	$data_dealer=mysqli_fetch_array($kueri_dealer);
	$id_dealer = $data_dealer['id_dealer'];
	$nama_dealer = $data_dealer['nama_dealer'];
	
	$do_num=$_SESSION["do_num"];
	
	$id_mobil=$_SESSION["id_mobil"];
	$kueri_mobil=mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil='$id_mobil'");
	$data_mobil=mysqli_fetch_array($kueri_mobil);
	$id_mobil = $data_mobil['id_mobil'];
	$no_polisi = $data_mobil['no_polisi'];
	
	$id_driver=$_SESSION["id_driver"];
	$kueri_driver=mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver='$id_driver'");
	$data_driver=mysqli_fetch_array($kueri_driver);
	$id_driver = $data_driver['id_driver'];
	$nama_driver = $data_driver['nama_driver'];
	
	$id_asst=$_SESSION["id_asst"];
	$kueri_asst=mysqli_query($con, "SELECT * FROM tbl_asst WHERE id_asst='$id_asst'");
	$data_asst=mysqli_fetch_array($kueri_asst);
	$id_asst = $data_asst['id_asst'];
	$nama_asst = $data_asst['nama_asst'];
	
	$random_id=$_REQUEST['random_id'];
	$do_print_date1=$_SESSION["do_print_date1"];
	$exit_date1=$_SESSION["exit_date1"];
	$date_terima_ekspedisi=$_SESSION["date_terima_ekspedisi"];
	$estimation_date=$_SESSION["estimation_date"];
	$durasi=$_SESSION["durasi"];
	//$received_num=$_SESSION["received_num"];
	$notes=$_SESSION["notes"];
	$nama_ekspedisi=$_SESSION["nama_ekspedisi"];
	$waktu_pengiriman=$_SESSION["waktu_pengiriman"];
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="12%">Provinsi</td>
	    <td width="1%">:</td>
	    <td width="23%"><?=$nama_provinsi;?></td>
	    <td width="9%">Nama Gudang</td>
	    <td width="1%">:</td>
	    <td width="17%"><?=$nama_gudang;?></td>
	    <td align="right"><h3>DO Num</h3></td>
	    <td align="center">:</td>
	    <td align="left"><h3><?=$do_num;?></h3></td>
      </tr>
	  <tr>
	    <td>Kota</td>
	    <td>:</td>
	    <td><?=$nama_kota;?> (<?=$durasi;?> Hari)</td>
	    <td width="9%">Mobil</td>
	    <td width="1%">:</td>
	    <td width="17%"><?=$no_polisi;?></td>
	    <td align="right">DO Print Date</td>
	    <td align="center">:</td>
	    <td align="left"><?=$do_print_date1;?></td>
      </tr>
	  <tr>
	    <td>Satuan Penghitungan</td>
	    <td>:</td>
	    <td><?=$satuan_penghitungan;?></td>
	    <td>Driver</td>
	    <td>:</td>
	    <td><?=$nama_driver;?></td>
	    <td width="23%" align="right">Exit Date</td>
	    <td width="1%" align="center">:</td>
	    <td width="13%"><?=$exit_date1;?></td>
      </tr>
	  <tr>
	    <td>Dealer</td>
	    <td>:</td>
	    <td><?=$nama_dealer;?></td>
	    <td>Assistant</td>
	    <td>:</td>
	    <td><?=$nama_asst;?></td>
	    <td align="right">Estimation Date</td>
	    <td align="center">:</td>
	    <td align="left"><?=$estimation_date;?></td>
      </tr>
	  <tr>
	    <td>Ekspedisi</td>
	    <td>:</td>
	    <td><?=$nama_ekspedisi;?></td>
	    <td>Exit Time</td>
	    <td>:</td>
	    <td>
        <?php
		if($waktu_pengiriman=="normal")
		{
			echo "Normal";
		}
		elseif($waktu_pengiriman=="late")
		{
			echo "Diatas jam 15.00";
		}
		?>
        </td>
	    <!--td align="right">Received Num</td>
	    <td align="center">:</td>
	    <td align="left"--><!--?=$received_num;?></td-->
      </tr>
	  <tr>
	    <td align="left">Notes</td>
	    <td align="left">:</td>
	    <td align="left"><?=$notes;?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="right">Date Terima Ekspedisi</td>
	    <td align="center">:</td>
	    <td align="left"><?=$date_terima_ekspedisi;?></td>
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
			$kueri_temp_produk=mysqli_query($con, "SELECT * FROM temp_produk AS temp LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = temp.id_produk_katalog LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE temp.random_id=$random_id");
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
				
				$kueri_total_harga=mysqli_query($con, "SELECT SUM(total_harga) as sum_harga FROM temp_produk WHERE random_id=$random_id");
				$data_total_harga=mysqli_fetch_array($kueri_total_harga);
				$sum_harga=$data_total_harga['sum_harga'];
				$_SESSION["sum_harga"]=$sum_harga;
			?>
		  <tr>
            <td><?php
			echo("<a href=\"deletecheckout.php?id_temp_produk=$id_temp_produk&&random_id=$random_id\"><i class=\"fa fa-remove\"></i></a>");
			?></td>
            <td align="center"><?=$no;?></td>
			<td align="center"><?=$nama_produk;?></td>
			<td align="center"><?=$total_weight;?></td>
			<td align="center"><?=$total_volumetric;?></td>
			<td align="center"><?=$kategori_produk;?> (Weight Class <?=$weight_class;?>)</td>
			<td align="center"><?=$quantity;?> <?php
			echo("<a href=\"admin.php?page=editquantitycheckout&&id_temp_produk=$id_temp_produk&&random_id=$random_id\"><i class=\"fa fa-edit\"></i></a>");
			?></td>
			<td align="center"><?=number_format($total_harga);?> <?php
			echo("<a href=\"admin.php?page=edithargacheckout&&id_temp_produk=$id_temp_produk&&random_id=$random_id\"><i class=\"fa fa-edit\"></i></a>");
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
		$linklink="admin.php?page=addpengiriman5&&random_id=$random_id"
		?>
		<a href="<?=$linklink;?>"><button class="btn btn-sm btn-warning">+ Add Produk</button></a>
	</div>
	<hr />
	<form action="prosescheckout.php?random_id=<?=$random_id;?>" id="checkout" method="post">
	<button class="btn btn-primary" type="submit">Checkout</button>
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