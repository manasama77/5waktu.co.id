<div class="container">
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add_region" class="form-horizontal" action="prosesaddregion.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="nama_region">Nama Region / Wilayah</label>
              <div class="controls"><input name="nama_region" class="text" id="nama_region" Value="" size="50" maxlength="50"> 
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
				  ?>
				  <p style="color:#F00;">Nama Region <b><u><?=$_REQUEST['nama_region'];?></u></b> telah ada, <u>Silahkan pilih nama Regional lain</u></p>
				  <?php
				  }
			  }
			  ?>
              </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="duration">Duration</label>
              <div class="controls"><input name="duration" class="text" id="duration" Value="" size="10" maxlength="10"> 
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
				  ?>
				  <p style="color:#F00;">Nama Region <b><u><?=$_REQUEST['nama_region'];?></u></b> telah ada, <u>Silahkan pilih nama Regional lain</u></p>
				  <?php
				  }
			  }
			  ?>
              </div>
            </div>
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Add</button>
            </div>
    	</fieldset>
    </form>
</div>
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
$( "#add_region" ).validate({
  rules: {
    nama_region: {
      required: true
    },
	duration: {
      required: true,
	  digits: true
    }
  }
});
</script>