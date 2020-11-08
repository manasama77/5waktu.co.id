<div class="container">
<div class="widget-content">
<?php
include('config.php');

$kueri_prduct_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog ORDER BY product_name ASC");
$kueri_class_price = mysqli_query($con, "SELECT * FROM tbl_class_price ORDER BY class_type ASC");
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region ORDER BY nama_region ASC");

$type = $_REQUEST['type'];
?>

<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddpricelist.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="no_mesin">Product Name</label>
              <div class="controls">
              	<select name="id_product_name" id="id_product_name">
                  <?php
				  while($data_product_catalog = mysqli_fetch_array($kueri_prduct_catalog))
				  {
				  ?>
                  <option value="<?=$data_product_catalog['id_product_catalog'];?>"><?=$data_product_catalog['product_name'];?></option>
                  <?php
				  }
				  ?>
                </select>
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="no_mesin">Class Type</label>
              <div class="controls">
              	<select name="id_class_price" id="id_class_price">
                  <?php
				  while($data_class_price = mysqli_fetch_array($kueri_class_price))
				  {
				  ?>
                  <option value="<?=$data_class_price['id_class_price'];?>"><?=$data_class_price['class_type'];?></option>
                  <?php
				  }
				  ?>
                </select>
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="no_mesin">Region</label>
              <div class="controls">
              	<select name="id_region" id="id_region">
                  <?php
				  while($data_region = mysqli_fetch_array($kueri_region))
				  {
				  ?>
                  <option value="<?=$data_region['id_region'];?>"><?=$data_region['nama_region'];?></option>
                  <?php
				  }
				  ?>
                </select>
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Price</label>
              <div class="controls">
              <?php
			  if($type == 'v' | $type == 'k' | $type == 'j')
			  {
			  ?>
              	Perkalian <input type="text" name="perkalian" id="perkalian" /><br />x
			  <?php
			  }
              ?>
              <br />Class Price <input name="price" class="text" id="price" Value="">
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Price harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
            </div>
            
            <div class="form-actions">
            	<input name="type" type="hidden" id="type" value="<?=$type;?>" />
           	  <button class="btn btn-primary" type="submit">Save</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>
</div>