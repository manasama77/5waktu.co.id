<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Satuan Harga Volumetric</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric AS shv LEFT JOIN tbl_kota AS kota ON shv.id_kota = kota.id_kota LEFT JOIN tbl_provinsi AS provinsi ON kota.id_provinsi = provinsi.id_provinsi WHERE shv.id_satuan_harga_volumetric = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_satuanhargavol" class="form-horizontal" action="proseseditsatuanhargavol.php" method="post">
    	<fieldset>
			
        	<div class="control-group">
				<label class="control-label">Provinsi: <?php echo $data['nama_provinsi']; ?></label><br>
				<label class="control-label">Kota: <?php echo $data['nama_kota']; ?></label>
			</div>
			
			<hr />
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Harga</label>
                <div class="controls">
					<input name="satuan_harga_volumetric" class="text" Value="<?=$data['satuan_harga_volumetric'];?>" size="7" maxlength="7">
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_satuan_harga_volumetric'];?>">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
            
    </form>
</div>
<script src="js/jquery.validate.vol.js"></script>
<script src="js/additional-methods.vol.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: false,
  success: "valid"
});
$( "#edit_satuanhargavol" ).validate({
  rules: {
	satuan_harga: {
	  required: true,
	  digits: true
	}
  }
});
</script>
</div>