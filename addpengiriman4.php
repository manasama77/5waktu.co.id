<?php
$do_num=$_REQUEST['do_num'];

 $checkdata=" SELECT do_num FROM tbl_pengiriman WHERE do_num='$do_num' ";

 $query=mysqli_query($con, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo("<b><font color=\"red\">DO Number Already Exist</font></b><br><button onclick=\"javascript:window.history.back();\">Go Back</button>");
  exit();
 }

?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	$random_id= $_SESSION['random_id'];
	$nama_gudang=$_SESSION["nama_gudang"];
	$id_provinsi=$_SESSION["id_provinsi"];
	$id_kota=$_SESSION['id_kota'];
	
	$_SESSION["id_dealer"]=$_REQUEST['id_dealer'];
	$_SESSION["do_num"]=$_REQUEST['do_num'];
	$_SESSION["id_mobil"]=$_REQUEST['id_mobil'];
	$_SESSION["id_driver"]=$_REQUEST['id_driver'];
	$_SESSION["id_asst"]=$_REQUEST['id_asst'];
	$_SESSION["do_print_date1"]=$_REQUEST['do_print_date'];
	$_SESSION["exit_date1"]=$_REQUEST['exit_date'];
	$_SESSION["date_terima_ekspedisi"]=$_REQUEST['date_terima_ekspedisi'];
	//$_SESSION["received_num"]=$_REQUEST['received_num'];
	$_SESSION["notes"]=$_REQUEST['notes'];
	$_SESSION["waktu_pengiriman"]=$_REQUEST['waktu_pengiriman'];
	
	$do_num=$_SESSION['do_num'];
	//$received_num=$_REQUEST['received_num'];
	$notes=$_REQUEST['notes'];
	$do_print_date1=$_REQUEST['do_print_date'];
	$exit_date1=$_REQUEST['exit_date'];
	$date_terima_ekspedisi=$_REQUEST['date_terima_ekspedisi'];
	$waktu_pengiriman=$_REQUEST['waktu_pengiriman'];
	
	$kueri_provinsi=mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi='$id_provinsi'");
	$data_provinsi=mysqli_fetch_array($kueri_provinsi);
	$id_provinsi = $data_provinsi['id_provinsi'];
	$nama_provinsi = $data_provinsi['nama_provinsi'];
	
	$kueri_kota=mysqli_query($con, "SELECT * FROM tbl_kota WHERE id_kota='$id_kota'");
	$data_kota=mysqli_fetch_array($kueri_kota);
	$id_kota = $data_kota['id_kota'];
	$nama_kota = $data_kota['nama_kota'];
	$satuan_penghitungan = $data_kota['satuan_penghitungan'];
	
	if($waktu_pengiriman=="late")
	{
		$durasi = $data_kota['durasi']+1;
		$durasi2 = $data_kota['durasi']+1;
	}
	else
	{
		$durasi = $data_kota['durasi'];
		$durasi2 = $data_kota['durasi'];
	}
	
	$id_dealer=$_SESSION['id_dealer'];
	$kueri_dealer=mysqli_query($con, "SELECT * FROM tbl_dealer AS d LEFT JOIN tbl_ekspedisi AS e ON d.id_ekspedisi = e.id_ekspedisi WHERE id_dealer='$id_dealer'");
	$data_dealer=mysqli_fetch_array($kueri_dealer);
	$id_dealer = $data_dealer['id_dealer'];
	$nama_dealer = $data_dealer['nama_dealer'];
	$nama_ekspedisi = $data_dealer['nama_ekspedisi'];
	
	$id_mobil=$_SESSION['id_mobil'];
	$kueri_mobil=mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil='$id_mobil'");
	$data_mobil=mysqli_fetch_array($kueri_mobil);
	$id_mobil = $data_mobil['id_mobil'];
	$no_polisi = $data_mobil['no_polisi'];
	
	$id_driver=$_SESSION['id_driver'];
	$kueri_driver=mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver='$id_driver'");
	$data_driver=mysqli_fetch_array($kueri_driver);
	$id_driver = $data_driver['id_driver'];
	$nama_driver = $data_driver['nama_driver'];
	
	$id_asst=$_SESSION['id_asst'];
	$kueri_asst=mysqli_query($con, "SELECT * FROM tbl_asst WHERE id_asst='$id_asst'");
	$data_asst=mysqli_fetch_array($kueri_asst);
	$id_asst = $data_asst['id_asst'];
	$nama_asst = $data_asst['nama_asst'];	
	
	$_SESSION["satuan_penghitungan"]=$satuan_penghitungan;
	$_SESSION["durasi"]=$durasi;
	$_SESSION["nama_ekspedisi"]=$nama_ekspedisi;
	
	
	$end_date = strtotime($exit_date1);
	for($i=0;$i<$durasi;$i++)
	{
		$end_date = strtotime('+1 days', $end_date);
	}
	$end_date=date('Y-m-d', $end_date);
	
	$start = new DateTime($exit_date1);
	$end = new DateTime($end_date);
	$days = $start->diff($end, true)->days;

	$sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);

	$end_date = strtotime($end_date);
	$date = strtotime('+'.$sundays .'days.', $end_date);
	$estimation_date=date('Y-m-d', $date);
	
	$_SESSION["estimation_date"]=$estimation_date;
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
	    <td align="left"><h3>
	      <?=$do_num;?>
	      </h3></td>
      </tr>
	  <tr>
	    <td>Kota</td>
	    <td>:</td>
	    <td><?=$nama_kota;?> (<?=$durasi2;?> Hari)</td>
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
	<form id="add_pengiriman" class="form-horizontal" action="prosesaddpengiriman.php" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Produk</label>
				<div class="controls">
					<select name="id_produk_katalog" id="id_produk_katalog">
                    <?php
					$kueri_produk_katalog = mysqli_query($con, "SELECT * FROM tbl_produk_katalog ORDER BY produk_name ASC");
					while($data_produk_katalog=mysqli_fetch_array($kueri_produk_katalog))
					{
						$id_produk_katalog=$data_produk_katalog['id_produk_katalog'];
						$produk_name=$data_produk_katalog['produk_name'];
					?>
					  <option value="<?=$id_produk_katalog;?>"><?=$produk_name;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Quantity</label>
				<div class="controls">
					<input name="quantity" class="text" id="quantity" Value="" size="5" maxlength="5">
				</div>
            </div>
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Next</button>
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