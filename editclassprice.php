<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_class_price WHERE id_class_price = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit-mobil" class="form-horizontal" action="proseseditclassprice.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Class Name</label>
                <div class="controls"><input name="class_type" class="text" Value="<?=$data['class_type'];?>" size="50" maxlength="50" style="font-size:10px;">
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Weight Class</label>
                <div class="controls"><input name="weight_class" class="text" Value="<?=$data['weight_class'];?>" size="50" maxlength="50" style="font-size:10px;">
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_class_price'];?>">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
            
    </form>
</div>