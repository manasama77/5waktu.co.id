<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Edit Min. Price List</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_min_pricelist WHERE id_min_pricelist = '$id'");
$data = mysqli_fetch_array($kueri);
$id_region = $data['id_region'];
//echo $id_region;
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region");
$pilih = "";

?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_min_pricelist" class="form-horizontal" action="proseseditminpricelist.php" method="post">
    	<fieldset>
        	
      <div class="control-group">
            	<label class="control-label" for="">Region</label>
                <div class="controls">
               	  <select name="id_region" id="id_region">
               	    <?php
					while($data_region=mysqli_fetch_array($kueri_region))
					{
						$id_region2 = $data_region['id_region'];
						if($id_region == $id_region2)
						{
							$pilih="selected=\"selected\"";
						}
						else
						{
							$pilih="";
						}
					?>
                    <option value="<?=$data_region['id_region'];?>" <?=$pilih;?>><?=$data_region['nama_region'];?></option>
                    <?php
					}
					?>
              	  </select>
          		</div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Min. Price List</label>
                <div class="controls">
                	<input name="price_list" class="text" Value="<?=$data['price_list'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Volumetric</label>
                <div class="controls">
                	<input name="satuan_volumetric" class="text" Value="<?=$data['satuan_volumetric'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Weight</label>
                <div class="controls">
                	<input name="satuan_weight" class="text" Value="<?=$data['satuan_weight'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Volumetric</label>
                <div class="controls">
                	<input name="satuan_volumetric_c" class="text" Value="<?=$data['satuan_volumetric_c'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Weight</label>
                <div class="controls">
                	<input name="satuan_weight_c" class="text" Value="<?=$data['satuan_weight_c'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$id;?>">
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
$( "#edit_min_pricelist" ).validate({
  rules: {
    price_list: {
      required: true,
      digits: true
    },
	satuan_volumetric: {
      digits: true
    },
	satuan_weight: {
      digits: true
    },
	satuan_volumetric_c: {
      digits: true
    },
	satuan_weight_c: {
      digits: true
    },
  }
});
</script>
</div>