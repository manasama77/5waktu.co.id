<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
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
	Provinsi : <?=$nama_provinsi;?><br>
	Kota : <?=$nama_kota;?><br>
	Dealer : <?=$nama_dealer;?><br>
	DO Num : <?=$do_num;?><br>
	Mobil : <?=$no_polisi;?><br>
	Driver : <?=$nama_driver;?><br>
	Assistant : <?=$nama_asst;?><br>
	<hr />
	<form id="add_pengiriman" class="form-horizontal" action="admin.php?page=addpengiriman5" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Dealer</label>
				<div class="controls">
					<select name="id_dealer" id="id_dealer">
                    <?php
					$kueri_dealer = mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_kota=$id_kota ORDER BY nama_dealer ASC");
					while($data_dealer=mysqli_fetch_array($kueri_dealer))
					{
						$id_dealer=$data_dealer['id_dealer'];
						$nama_dealer=$data_dealer['nama_dealer'];
					?>
					  <option value="<?=$id_dealer;?>"><?=$nama_dealer;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">DO Num</label>
				<div class="controls">
					<input name="do_num" class="text" id="do_num" Value="" size="25" maxlength="25">
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Mobil</label>
				<div class="controls">
					<select name="id_mobil" id="id_mobil">
                    <?php
					$kueri_mobil = mysqli_query($con, "SELECT * FROM tbl_mobil ORDER BY no_polisi ASC");
					while($data_mobil=mysqli_fetch_array($kueri_mobil))
					{
						$id_mobil=$data_mobil['id_mobil'];
						$no_polisi=$data_mobil['no_polisi'];
					?>
					  <option value="<?=$id_mobil;?>"><?=$no_polisi;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Driver</label>
				<div class="controls">
					<select name="id_driver" id="id_driver">
                    <?php
					$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC");
					while($data_driver=mysqli_fetch_array($kueri_driver))
					{
						$id_driver=$data_driver['id_driver'];
						$nama_driver=$data_driver['nama_driver'];
					?>
					  <option value="<?=$id_driver;?>"><?=$nama_driver;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Assistant</label>
				<div class="controls">
					<select name="id_asst" id="id_asst">
                    <?php
					$kueri_asst = mysqli_query($con, "SELECT * FROM tbl_asst ORDER BY nama_asst ASC");
					while($data_asst=mysqli_fetch_array($kueri_asst))
					{
						$id_asst=$data_asst['id_asst'];
						$nama_asst=$data_asst['nama_asst'];
					?>
					  <option value="<?=$id_asst;?>"><?=$nama_asst;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
            <div class="form-actions">
				<input name="id_provinsi" type="hidden" id="id_provinsi" value="<?=$id_provinsi;?>" />
				<input name="id_kota" type="hidden" id="id_kota" value="<?=$id_kota;?>" />
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
    id_dealer: {
		required: true
    },
	do_num: {
		required: true
    },
	id_mobil: {
		required: true
    },
	id_driver: {
		required: true
    },
	id_asst: {
		required: true
    }
  }
});
</script>