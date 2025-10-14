<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Ekspedisi</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_ekspedisi WHERE id_ekspedisi = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_ekspedisi" class="form-horizontal" action="proseseditekspedisi.php" method="post">
    	<fieldset>
			
        	<div class="control-group">
            	<label class="control-label" for="">Ekspedisi</label>
                <div class="controls">
					<input name="nama_ekspedisi" class="text" Value="<?=$data['nama_ekspedisi'];?>" size="25" maxlength="25">
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_ekspedisi'];?>">
            	<button class="btn btn-primary" type="submit">Save</button>
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
$( "#edit_ekspedisi" ).validate({
  rules: {
    nama_ekspedisi: {
      required: true
    }
  }
});
</script>
</div>