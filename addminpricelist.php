<div class="container">
<div class="widget-content">
<?php
include('config.php');

$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region ORDER BY nama_region ASC");
?>

<div id="formcontrols" class="tab-pane active">
	<form id="add_min_pricelist" class="form-horizontal" action="prosesaddminpricelist.php" method="post">
    	<fieldset>
        
        	<div class="control-group">
       		  <label class="control-label" for="id_region">Region</label>
        		<div class="controls">
                    <select name="id_region" id="id_region">
                    
                    <?php
                    $row = mysqli_num_rows($kueri_region);
                    if($row == NULL)
                    {
                    ?>
                        <option>Region Tidak Ditemukan</option>
                    <?php
                    }
                    else
                    {
        				while($data_region = mysqli_fetch_array($kueri_region))
        				{
        			?>        
        					<option value="<?=$data_region['id_region'];?>"><?=$data_region['nama_region'];?></option>
        			<?php
        				}
        			}
        			?>
                    </select>
       		  </div>
       		</div>

            <div class="control-group">
            	<label class="control-label" for="">Min. Price List</label>
              	<div class="controls"><input name="price_list" class="text" id="price_list" Value=""></div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Volumetric</label>
              	<div class="controls"><input name="satuan_volumetric" class="text" id="satuan_volumetric" Value=""></div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Weight</label>
              	<div class="controls"><input name="satuan_weight" class="text" id="satuan_weight" Value=""></div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Volumetric Class C</label>
              	<div class="controls"><input name="satuan_volumetric_c" class="text" id="satuan_volumetric_c" Value=""></div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Weight Class C</label>
              	<div class="controls"><input name="satuan_weight_c" class="text" id="satuan_weight_c" Value=""></div>
            </div>
            
			<div class="control-group">
				<div class="form-actions">
					<?php
					if(isset($_GET['error']))
					{
						$id_region2 = $_GET['id_region'];
						$kueri_region2 = mysqli_query($con, "SELECT * FROM tbl_region WHERE id_region = '$id_region2'");
						$data_region2 = mysqli_fetch_array($kueri_region2);
						$nama_region2 = $data_region2['nama_region'];
					?>
					<p style="color:#F00;">Data Regional <b><u><?=$nama_region2;?></u></b> Telah ada, <u>Silahkan pilih Regional Lain</u></p>
					<?php
					}
					?>
					<button class="btn btn-default" onclick="window.location.href='admin.php?page=configuration&&tab=mpl'">Back</button>
					<button class="btn btn-primary" type="submit">Save</button>
				</div>
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
$( "#add_min_pricelist" ).validate({
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
    }
  }
});
</script>