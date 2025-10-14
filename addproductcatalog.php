<div class="container">
<div class="widget-content">
<?php
include('config.php');

$kueri_class_name = mysqli_query($con, "SELECT * FROM tbl_class_name ORDER BY class_name ASC");
?>

<div id="formcontrols" class="tab-pane active">
	<form id="add_product_catalog" class="form-horizontal" action="prosesaddproductcatalog.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Product Name</label>
              <div class="controls"><input name="product_name" class="text" id="product_name" Value="">
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Product Name harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Weight</label>
              <div class="controls"><input name="weight" class="text" id="weight" Value=""></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Volumetric</label>
              <div class="controls"><input name="volumetric" class="text" id="volumetric" Value=""></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Panjang</label>
              <div class="controls"><input name="panjang" class="text" id="panjang" Value=""></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Lebar</label>
              <div class="controls"><input name="lebar" class="text" id="lebar" Value=""></div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Tinggi</label>
              <div class="controls"><input name="tinggi" class="text" id="tinggi" Value=""></div>
            </div>
            
          <div class="control-group">
            	<label class="control-label" for="">Packing Status</label>
              <div class="controls">
                <select name="packing_status" id="packing_status">
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
            	</div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="class_name">Class Name</label>
              <div class="controls">
              	<select name="id_class_name" id="id_class_name">
                  <?php
				  while($data_class_name = mysqli_fetch_array($kueri_class_name))
				  {
				  ?>
                  <option value="<?=$data_class_name['id_class_name'];?>"><?=$data_class_name['class_name'];?></option>
                  <?php
				  }
				  ?>
                </select>
              </div>
            </div>
            
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
    	</fieldset>
    </form>
</div>
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
$( "#add_product_catalog" ).validate({
  rules: {
    product_name: {
      required: true
    }
  }
});
</script>