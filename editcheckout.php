<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Pengiriman Produk</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
$random_id=$_REQUEST['random_id'];
$id_temp_produk=$_REQUEST['id_temp_produk'];

$kueri_temp_edit=mysqli_query($con, "SELECT * FROM temp_produk AS temp LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = temp.id_produk_katalog LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE temp.random_id=$random_id AND temp.id_temp_produk=$id_temp_produk");
$data_temp_edit=mysqli_fetch_array($kueri_temp_edit);
$temp_id_produk_katalog=$data_temp_edit['id_produk_katalog'];
$temp_quantity=$data_temp_edit['quantity'];
$temp_total_harga=$data_temp_edit['total_harga'];
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	$id_provinsi=$_REQUEST['id_provinsi'];
	$kueri_provinsi=mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi='$id_provinsi'");
	$data_provinsi=mysqli_fetch_array($kueri_provinsi);
	$id_provinsi = $data_provinsi['id_provinsi'];
	$nama_provinsi = $data_provinsi['nama_provinsi'];
	
	$id_kota=$_REQUEST['id_kota'];
	$kueri_kota=mysqli_query($con, "SELECT * FROM tbl_kota WHERE id_kota='$id_kota'");
	$data_kota=mysqli_fetch_array($kueri_kota);
	$id_kota = $data_kota['id_kota'];
	$nama_kota = $data_kota['nama_kota'];
	
	$id_dealer=$_REQUEST['id_dealer'];
	$kueri_dealer=mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_dealer='$id_dealer'");
	$data_dealer=mysqli_fetch_array($kueri_dealer);
	$id_dealer = $data_dealer['id_dealer'];
	$nama_dealer = $data_dealer['nama_dealer'];
	
	$do_num=$_REQUEST['do_num'];
	
	$id_mobil=$_REQUEST['id_mobil'];
	$kueri_mobil=mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil='$id_mobil'");
	$data_mobil=mysqli_fetch_array($kueri_mobil);
	$id_mobil = $data_mobil['id_mobil'];
	$no_polisi = $data_mobil['no_polisi'];
	
	$id_driver=$_REQUEST['id_driver'];
	$kueri_driver=mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver='$id_driver'");
	$data_driver=mysqli_fetch_array($kueri_driver);
	$id_driver = $data_driver['id_driver'];
	$nama_driver = $data_driver['nama_driver'];
	
	$id_asst=$_REQUEST['id_asst'];
	$kueri_asst=mysqli_query($con, "SELECT * FROM tbl_asst WHERE id_asst='$id_asst'");
	$data_asst=mysqli_fetch_array($kueri_asst);
	$id_asst = $data_asst['id_asst'];
	$nama_asst = $data_asst['nama_asst'];
	?>
	random id : <?=$random_id;?><br>
	Provinsi : <?=$nama_provinsi;?><br>
	Kota : <?=$nama_kota;?><br>
	Dealer : <?=$nama_dealer;?><br>
	DO Num : <?=$do_num;?><br>
	Mobil : <?=$no_polisi;?><br>
	Driver : <?=$nama_driver;?><br>
	Assistant : <?=$nama_asst;?><br>
	<hr />
	<div class="table-responsive">
		<b>Produk Info</b>
		<table width="100%" class="table table-responsive table-hover">
		  <tr>
			<td align="center" bgcolor="grey"><b>Produk Name</b></td>
			<td align="center" bgcolor="grey"><b>Total Weight</b></td>
			<td align="center" bgcolor="grey"><b>Total Volumetric</b></td>
			<td align="center" bgcolor="grey"><b>Kategori</b></td>
			<td align="center" bgcolor="grey"><b>Quantity</b></td>
			<td align="center" bgcolor="grey"><b>Harga</b></td>
		  </tr>
			<?php
			$kueri_temp_produk=mysqli_query($con, "SELECT * FROM temp_produk AS temp LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = temp.id_produk_katalog LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE temp.random_id=$random_id");
			while($data_temp_produk=mysqli_fetch_array($kueri_temp_produk))
			{
				$nama_produk=$data_temp_produk['produk_name'];
				$quantity=$data_temp_produk['quantity'];
				$kategori_produk=$data_temp_produk['nama_kategori_produk'];
				$weight_class=strtoupper($data_temp_produk['weight_class']);
				$total_weight=strtoupper($data_temp_produk['weight'])*$quantity;
				$total_volumetric=strtoupper($data_temp_produk['volumetric'])*$quantity;
				
				if($total_weight=="c" && $total_weight<="20")
				{
					$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota_class_c WHERE id_kota=$id_kota");
					$data_harga=mysqli_fetch_array($kueri_harga);
					$total_harga=$data_harga['satuan_harga']*$quantity;
				}else{
					$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota");
					$data_harga=mysqli_fetch_array($kueri_harga);
					$total_harga=$data_harga['satuan_harga']*$quantity;
				}
				
				$kueri_total_harga=mysqli_query($con, "SELECT SUM(total_harga) as sum_harga FROM temp_produk WHERE random_id=$random_id");
				$data_total_harga=mysqli_fetch_array($kueri_total_harga);
				$sum_harga=$data_total_harga['sum_harga'];
			?>
		  <tr>
			<td align="center"><?=$nama_produk;?></td>
			<td align="center"><?=$total_weight;?></td>
			<td align="center"><?=$total_volumetric;?></td>
			<td align="center"><?=$kategori_produk;?> (Weight Class <?=$weight_class;?>)</td>
			<td align="center"><?=$quantity;?></td>
			<td align="center"><?=$total_harga;?></td>
		  </tr>
		  <?php
			}
		  ?>
		  <tr>
		    <td align="center">&nbsp;</td>
		    <td align="center">&nbsp;</td>
		    <td align="center">&nbsp;</td>
		    <td align="center">&nbsp;</td>
		    <td align="center"><strong>Total Harga</strong></td>
		    <td align="center"><?=$sum_harga;?></td>
	      </tr>
		</table>
	</div>
	<hr />
	<form id="add_pengiriman" class="form-horizontal" action="proseseditcheckout.php" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Produk</label>
				<div class="controls">
                    <?php
					$kueri_produk_katalog = mysqli_query($con, "SELECT * FROM tbl_produk_katalog WHERE id_produk_katalog=$temp_id_produk_katalog");
					$data_produk_katalog=mysqli_fetch_array($kueri_produk_katalog);
					$produk_name=$data_produk_katalog['produk_name'];
					
					echo $produk_name;
					?>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Quantity</label>
				<div class="controls">
					<input name="quantity" class="text" id="quantity" Value="<?=$temp_quantity;?>" size="5" maxlength="5">
				</div>
            </div>
			
            <div class="form-actions">
				<input name="id_temp_produk" type="hidden" id="id_temp_produk" value="<?=$id_temp_produk;?>" />
				<input name="random_id" type="hidden" id="random_id" value="<?=$random_id;?>" />
				<input name="id_provinsi" type="hidden" id="id_provinsi" value="<?=$id_provinsi;?>" />
				<input name="id_kota" type="hidden" id="id_kota" value="<?=$id_kota;?>" />
				<input name="id_dealer" type="hidden" id="id_dealer" value="<?=$id_dealer;?>" />
				<input name="do_num" type="hidden" id="do_num" value="<?=$do_num;?>" />
				<input name="id_mobil" type="hidden" id="id_mobil" value="<?=$id_mobil;?>" />
				<input name="id_driver" type="hidden" id="id_driver" value="<?=$id_driver;?>" />
				<input name="id_asst" type="hidden" id="id_asst" value="<?=$id_asst;?>" />
            	<button class="btn btn-primary" type="submit">Edit</button>
            </div>
    	</fieldset>
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