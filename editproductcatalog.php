<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_product_catalog WHERE id_product_catalog = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_product_catalog" class="form-horizontal" action="proseseditproductcatalog.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Product Name</label>
                <div class="controls"><input name="product_name" class="text" Value="<?=$data['product_name'];?>" size="50" maxlength="50" style="font-size:10px;">
                  
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Weight</label>
              <div class="controls"><input name="weight" class="text" id="weight" Value="<?=$data['weight'];?>"></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Volumetric</label>
              <div class="controls"><input name="volumetric" class="text" id="volumetric" Value="<?=$data['volumetric'];?>"></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Panjang</label>
              <div class="controls"><input name="panjang" class="text" id="panjang" Value="<?=$data['panjang'];?>"></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Lebar</label>
              <div class="controls"><input name="lebar" class="text" id="lebar" Value="<?=$data['lebar'];?>"></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Tinggi</label>
              <div class="controls"><input name="tinggi" class="text" id="tinggi" Value="<?=$data['tinggi'];?>"></div>
            </div>
            
          <div class="control-group">
            	<label class="control-label" for="">Packing Status</label>
              <div class="controls">
                <select name="packing_status" id="packing_status">
                  <?php
					if($data['packing_status'] == "yes")
					{
						echo("<option value=\"yes\" selected=\"selected\">Yes</option><option value=\"no\">No</option>");
					}else{
						echo("<option value=\"yes\">Yes</option><option value=\"no\" selected=\"selected\">No</option>");
					}
					?>
                </select>
            	</div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="id_class_name">Class Type</label>
                <div class="controls">
               	  <select name="id_class_name" id="id_class_name" style="font-size:10px;">
               	    <?php
					$kueri_class_name = mysqli_query($con, "SELECT * FROM tbl_class_name");
					while($data_class_name = mysqli_fetch_array($kueri_class_name))
					{
					?>
                    <option value="<?=$data_class_name['id_class_name'];?>"
					<?php
					if($data_class_name['id_class_name'] == $data['id_class_name'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_class_name['class_name'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_product_catalog'];?>">
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
$( "#edit_product_catalog" ).validate({
  rules: {
    product_name: {
      required: true
    },
	weight: {
      number: true
    },
	volumetric: {
      number: true
    },
	panjang: {
      number: true
    },
	lebar: {
      number: true
    },
	tinggi: {
      number: true
    }
  }
});
</script>