<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Date Terima Ekspedisi</h3>
</div>
<div class="widget-content">
<?php
$id_pengiriman=$_REQUEST['id_pengiriman'];

$kueri=mysqli_query($con, "SELECT date_terima_ekspedisi FROM tbl_pengiriman WHERE id_pengiriman = '$id_pengiriman'");
$data=mysqli_fetch_array($kueri);
$date_terima_ekspedisi=$data['date_terima_ekspedisi'];
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_date_terima_ekspedisi" class="form-horizontal" action="proseseditdateterimaekspedisi.php?id_pengiriman=<?=$id_pengiriman;?>" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Date Terima Ekspedisi</label>
				<div class="controls">
					<input name="date_terima_ekspedisi" class="text" id="date_terima_ekspedisi" Value="<?=$date_terima_ekspedisi;?>" size="10" maxlength="10">
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
$( "#edit_date_terima_ekspedisi" ).validate({
  rules: {
	date_terima_ekspedisi: {
      required: true
    }
  }
});
</script>