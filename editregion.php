<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Edit Region</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_region WHERE id_region = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_region" class="form-horizontal" action="proseseditregion.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Region</label>
                <div class="controls"><input name="nama_region" class="text" Value="<?=$data['nama_region'];?>" size="50" maxlength="50">   
                </div>
            </div>
            
            <div class="control-group">
            <label class="control-label" for="label">Duration</label>
            <div class="controls">
              <input name="duration" class="text" id="duration" value="<?=$data['duration'];?>" size="10" maxlength="10" /> Hari
            </div>
          </div>

            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_region'];?>">
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
$( "#edit_region" ).validate({
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
</div>