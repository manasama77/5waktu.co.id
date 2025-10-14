<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Provinsi</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add_provinsi" class="form-horizontal" action="prosesaddprovinsi.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Provinsi</label>
				<div class="controls">
					<input name="nama_provinsi" class="text" id="nama_provinsi" Value="" size="25" maxlength="25">
				</div>
            </div>
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Add</button>
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
$( "#add_provinsi" ).validate({
  rules: {
    nama_provinsi: {
      required: true
    }
  }
});
</script>