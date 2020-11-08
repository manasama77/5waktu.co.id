<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Received Num</h3>
</div>
<div class="widget-content">
<?php
$id_pengiriman=$_REQUEST['id_pengiriman'];

$kueri=mysqli_query($con, "SELECT received_num FROM tbl_pengiriman WHERE id_pengiriman = '$id_pengiriman'");
$data=mysqli_fetch_array($kueri);
$received_num=$data['received_num'];
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_received_num" class="form-horizontal" action="proseseditreceivednum.php?id_pengiriman=<?=$id_pengiriman;?>" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Received Num</label>
				<div class="controls">
					<input name="received_num" class="text" id="received_num" Value="<?=$received_num;?>" size="25" maxlength="25">
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
$( "#edit_received_num" ).validate({
  rules: {
	received_num: {
      required: true
    }
  }
});
</script>