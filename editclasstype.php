<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_class_type WHERE id_class_type = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit-mobil" class="form-horizontal" action="proseseditclasstype.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Type Class</label>
                <div class="controls"><input name="class_type_name" class="text" Value="<?=$data['class_type_name'];?>" size="50" maxlength="50" style="font-size:10px;">   
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_class_type'];?>">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
            
    </form>
</div>