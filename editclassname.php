<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Edit Class Name</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_class_name WHERE id_class_name = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_class_name" class="form-horizontal" action="proseseditclassname.php" method="post">
    	<fieldset>
        	
            <div class="control-group">
            	<label class="control-label" for="">Class Name</label>
                <div class="controls"><input name="class_name" class="text" Value="<?=$data['class_name'];?>" size="50" maxlength="50">   
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Weight Class</label>
                <div class="controls">
					<select name="weight_class" id="weight_class">
                      <?php
					  $selecteda = "";
					  $selectedb = "";
					  $selectedc = "";
					  if($data['weight_class'] == "a")
					  {
						  $selecteda = "selected=\"selected\"";
					  }
					  elseif($data['weight_class'] == "b")
					  {
						  $selectedb = "selected=\"selected\"";
					  }
					  elseif($data['weight_class'] == "c")
					  {
						  $selectedc = "selected=\"selected\"";
					  }
					  ?>
                      <option value="a" <?=$selecteda;?>>A</option>
                      <option value="b" <?=$selectedb;?>>B</option>
                      <option value="c" <?=$selectedc;?>>C</option>
					</select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_class_name'];?>">
				<button class="btn btn-default" onclick="window.location.href='admin.php?page=configuration&&tab=cn'">Back</button>
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
$( "#edit_class_name" ).validate({
  rules: {
    class_name: {
      required: true
    }
  }
});
</script>
</div>