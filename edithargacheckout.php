<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Pengiriman Produk</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
$status=$_REQUEST['status'];
$random_id=$_REQUEST['random_id'];
$id_temp_produk=$_REQUEST['id_temp_produk'];

$kueri_temp_edit=mysqli_query($con, "SELECT * FROM temp_produk AS temp LEFT JOIN tbl_produk_katalog AS pk ON pk.id_produk_katalog = temp.id_produk_katalog LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE temp.random_id=$random_id AND temp.id_temp_produk=$id_temp_produk");
$data_temp_edit=mysqli_fetch_array($kueri_temp_edit);
$temp_id_produk_katalog=$data_temp_edit['id_produk_katalog'];
$temp_total_harga=$data_temp_edit['total_harga'];
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	if(isset($_SESSION["id_provinsi"]))
	{
		$id_provinsi=$_SESSION["id_provinsi"];
	}
	else
	{
		$id_provinsi=NULL;
	}
	
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
	
	if(isset($_SESSION["id_dealer"]))
	{
		$id_dealer=$_SESSION["id_dealer"];
	}
	else
	{
		$id_dealer=NULL;
	}
	
	$kueri_dealer=mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_dealer='$id_dealer'");
	$data_dealer=mysqli_fetch_array($kueri_dealer);
	$id_dealer = $data_dealer['id_dealer'];
	$nama_dealer = $data_dealer['nama_dealer'];
	
	if(isset($_SESSION["do_num"]))
	{
		$do_num=$_SESSION["do_num"];
	}
	else
	{
		$do_num=NULL;
	}
	
	if(isset($_SESSION["id_mobil"]))
	{
		$id_mobil=$_SESSION["id_mobil"];
	}
	else
	{
		$id_mobil=NULL;
	}
	
	$kueri_mobil=mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil='$id_mobil'");
	$data_mobil=mysqli_fetch_array($kueri_mobil);
	$id_mobil = $data_mobil['id_mobil'];
	$no_polisi = $data_mobil['no_polisi'];
	
	if(isset($_SESSION["id_driver"]))
	{
		$id_driver=$_SESSION["id_driver"];
	}
	else
	{
		$id_driver=NULL;
	}
	
	$kueri_driver=mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver='$id_driver'");
	$data_driver=mysqli_fetch_array($kueri_driver);
	$id_driver = $data_driver['id_driver'];
	$nama_driver = $data_driver['nama_driver'];
	
	if(isset($_SESSION["id_asst"]))
	{
		$id_asst=$_SESSION["id_asst"];
	}
	else
	{
		$id_asst=NULL;
	}
	
	$kueri_asst=mysqli_query($con, "SELECT * FROM tbl_asst WHERE id_asst='$id_asst'");
	$data_asst=mysqli_fetch_array($kueri_asst);
	$id_asst = $data_asst['id_asst'];
	$nama_asst = $data_asst['nama_asst'];
	
	$random_id=$_REQUEST['random_id'];
	
	if(isset($_SESSION["do_print_date1"]))
	{
		$do_print_date1=$_SESSION["do_print_date1"];
	}
	else
	{
		$do_print_date1=NULL;
	}
	
	if(isset($_SESSION["exit_date1"]))
	{
		$exit_date1=$_SESSION["exit_date1"];
	}
	else
	{
		$exit_date1=NULL;
	}
	
	?>
	random id : <?=$random_id;?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td width="12%">Provinsi</td>
	    <td width="1%">:</td>
	    <td width="23%"><?=$nama_provinsi;?></td>
	    <td width="9%">Mobil</td>
	    <td width="1%">:</td>
	    <td width="17%"><?=$no_polisi;?></td>
	    <td colspan="3" align="center"><h3>DO Num</h3></td>
      </tr>
	  <tr>
	    <td>Kota</td>
	    <td>:</td>
	    <td><?=$nama_kota;?></td>
	    <td>Driver</td>
	    <td>:</td>
	    <td><?=$nama_driver;?></td>
	    <td colspan="3" align="center"><h3><?=$do_num;?></h3></td>
      </tr>
	  <tr>
	    <td>Satuan Penghitungan</td>
	    <td>:</td>
	    <td><?=$satuan_penghitungan;?></td>
	    <td>Assistant</td>
	    <td>:</td>
	    <td><?=$nama_asst;?></td>
	    <td width="23%" align="right">DO Print Date</td>
	    <td width="1%" align="center">:</td>
	    <td width="13%"><?=$do_print_date1;?></td>
      </tr>
	  <tr>
	    <td>Dealer</td>
	    <td>:</td>
	    <td><?=$nama_dealer;?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td align="right">Exit Date</td>
	    <td align="center">:</td>
	    <td align="left"><?=$exit_date1;?></td>
      </tr>
    </table>
	<hr />
	<?php
	if(isset($_REQUEST['id']))
	{
	?>
	<form id="add_pengiriman" class="form-horizontal" action="prosesedithargacheckout.php?status=<?=$status;?>&&id=<?=$_REQUEST['id'];?>" method="post">
	<?php
	}else{
	?>
	<form id="add_pengiriman" class="form-horizontal" action="prosesedithargacheckout.php" method="post">
	<?php
	}
	?>
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Produk</label>
				<div class="controls">
                    <?php
					$kueri_produk_katalog = mysqli_query($con, "SELECT * FROM tbl_produk_katalog WHERE id_produk_katalog=$temp_id_produk_katalog");
					$data_produk_katalog=mysqli_fetch_array($kueri_produk_katalog);
					$id_produk_katalog=$data_produk_katalog['id_produk_katalog'];
					$produk_name=$data_produk_katalog['produk_name'];
					
					echo $produk_name;
					?>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Total Harga</label>
				<div class="controls">
					<input name="total_harga" class="text" id="total_harga" Value="<?=$temp_total_harga;?>" size="15" maxlength="15">
				</div>
            </div>
			
            <div class="form-actions">
				<input name="id_temp_produk" type="hidden" id="id_temp_produk" value="<?=$id_temp_produk;?>" />
				<input name="random_id" type="hidden" id="random_id" value="<?=$random_id;?>" />
				<input name="id_produk_katalog" type="hidden" id="id_produk_katalog" value="<?=$id_produk_katalog;?>" />
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