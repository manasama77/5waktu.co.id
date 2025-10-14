<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Notes</h3>
</div>
<div class="widget-content">
<?php
$id_pengiriman=$_REQUEST['id_pengiriman'];

//echo $id_pengiriman;

$kueri=mysqli_query($con, "SELECT notes FROM tbl_pengiriman WHERE id_pengiriman = '$id_pengiriman'");
$data=mysqli_fetch_array($kueri);
$notes=$data['notes'];
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_notes" class="form-horizontal" action="proseseditnotes.php?id_pengiriman=<?=$id_pengiriman;?>" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Notes</label>
				<div class="controls">
					<textarea name="notes" id="notes" cols="45" rows="5"><?=$notes;?></textarea>
				</div>
            </div>
			
            <div class="form-actions">
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
$( "#edit_received_name" ).validate({
  rules: {
	notes: {
      required: true
    }
  }
});
</script>