<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Received Info</h3>
</div>
<div class="widget-content">
<?php
$id_pengiriman=$_REQUEST['id_pengiriman'];
$estimation_date=$_REQUEST['estimation_date'];

$kueri_notes=mysqli_query($con, "SELECT notes FROM tbl_pengiriman WHERE id_pengiriman = '$id_pengiriman'");
$data_notes=mysqli_fetch_array($kueri_notes);
$notes=$data_notes['notes'];
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add_received_info" class="form-horizontal" action="prosesaddreceivedinfo.php?id_pengiriman=<?=$id_pengiriman;?>&&estimation_date=<?=$estimation_date;?>" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Received Date</label>
				<div class="controls">
					<input name="received_date" class="text" id="received_date" Value="" size="10" maxlength="10">
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Notes</label>
				<div class="controls">
				  <textarea name="notes" id="notes" cols="45" rows="5"><?=$notes;?></textarea>
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
$( "#add_received_info" ).validate({
  rules: {
    received_date: {
      required: true
    }
  }
});
</script>