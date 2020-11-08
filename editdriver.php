<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Driver</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_driver" class="form-horizontal" action="proseseditdriver.php" method="post">
    	<fieldset>
			
        	<div class="control-group">
            	<label class="control-label" for="">Ekspedisi</label>
                <div class="controls">
					<input name="nama_driver" class="text" Value="<?=$data['nama_driver'];?>" size="25" maxlength="25">
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_driver'];?>">
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
$( "#edit_driver" ).validate({
  rules: {
    nama_driver: {
      required: true
    }
  }
});
</script>
</div>