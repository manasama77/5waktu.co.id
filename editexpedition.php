<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_expedition WHERE id_expedition = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_expedition" class="form-horizontal" action="proseseditexpedition.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Expedition</label>
                <div class="controls"><input name="nama_expedition" class="text" Value="<?=$data['nama_expedition'];?>" size="50" maxlength="50" style="font-size:10px;">   
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Duration / Day</label>
                <div class="controls"><input name="duration" class="text" Value="<?=$data['duration'];?>" size="3" maxlength="3" style="font-size:10px;">   
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_expedition'];?>">
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
$( "#edit_expedition" ).validate({
  rules: {
    duration: {
      required: true,
      digits: true
    },
	nama_expedition: {
      required: true
    }
  }
});
</script>