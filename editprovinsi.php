<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Provinsi</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_provinsi" class="form-horizontal" action="proseseditprovinsi.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Provinsi</label>
                <div class="controls">
					<input name="nama_provinsi" class="text" Value="<?=$data['nama_provinsi'];?>" size="25" maxlength="25">
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_provinsi'];?>">
            	<button class="btn btn-primary" type="submit">Edit</button>
            </div>
            
    </form>
</div>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: false,
  success: "valid"
});
$( "#edit_provinsi" ).validate({
  rules: {
    nama_provinsi: {
      required: true
    }
  }
});
</script>
</div>