<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_product_price_list WHERE id_product_price_list = '$id'");
$data = mysqli_fetch_array($kueri);
$type = $data['type'];
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit-mobil" class="form-horizontal" action="proseseditpricelist.php" method="post">
    	<fieldset>
        	
            <div class="control-group">
            	<label class="control-label" for="">Product Name</label>
                <div class="controls">
               	  <select name="id_product_name" id="id_product_name" style="font-size:10px;">
               	    <?php
					$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog");
					while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
					{
					?>
                    <option value="<?=$data_product_catalog['id_product_catalog'];?>"
					<?php
					if($data_product_catalog['id_product_catalog'] == $data['id_product_catalog'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_product_catalog['product_name'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Class Type</label>
                <div class="controls">
               	  <select name="id_class_price" id="id_class_price" style="font-size:10px;">
               	    <?php
					$kueri_class_price = mysqli_query($con, "SELECT * FROM tbl_class_price");
					while($data_class_price = mysqli_fetch_array($kueri_class_price))
					{
					?>
                    <option value="<?=$data_class_price['id_class_price'];?>"
					<?php
					if($data_class_price['id_class_price'] == $data['id_class_price'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_class_price['class_type'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Region</label>
                <div class="controls">
               	  <select name="id_region" id="id_region" style="font-size:10px;">
               	    <?php
					$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region");
					while($data_region = mysqli_fetch_array($kueri_region))
					{
					?>
                    <option value="<?=$data_region['id_region'];?>"
					<?php
					if($data_region['id_region'] == $data['id_region'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_region['nama_region'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Price Type</label>              
                <div class="controls">
                  <select name="type" id="type">
                    <option value="p" <?php if($data['type'] == 'p'){ echo("selected=\"selected\""); } ?>>Price</option>
                    <option value="v" <?php if($data['type'] == 'v'){ echo("selected=\"selected\""); } ?>>Volumetric</option>
                    <option value="k" <?php if($data['type'] == 'k'){ echo("selected=\"selected\""); } ?>>per/kg</option>
                    <option value="j" <?php if($data['type'] == 'j'){ echo("selected=\"selected\""); } ?>>Jakarta + Real Cost</option>
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
              Perkalian <input name="perkalian" type="text" id="perkalian" value="<?=$data['perkalian'];?>" /><br />x<br />
<?php
			  }
			  else
			  {
			  ?>
              Perkalian <input name="perkalian" type="text" id="perkalian" /><br />x<br />
              <?php
			  }
			  ?>
              Class Price <input name="price" class="text" id="price" Value="<?=$data['price'];?>"><br />
              <i>Jika Price Type = <b>Price</b><br />field perkalian tidak perlu di isi</i>
              </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_product_price_list'];?>">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
            
    </form>
</div>