<?php
include('config.php');

$kueri_region= mysqli_query($con, "SELECT * FROM tbl_region ORDER BY nama_region ASC");
$kueri_class_type= mysqli_query($con, "SELECT * FROM tbl_class_type ORDER BY class_type_name ASC");
?>

<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddclassprice.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="no_polisi">Class Name</label>
              <div class="controls"><input name="class_type" class="text" id="class_type" Value="">
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Class Name harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="merk">Weight Class</label>
              <div class="controls"><input name="weight_class" class="text" id="weight_class" Value=""></div>
            </div>
            
            <!--?php
            $row = mysqli_num_rows($kueri_region);
            if($row == NULL)
            {
            ?>
            	<div class="control-group">
            		<label class="control-label" for="id_driver">Region</label>
          			<div class="controls">
           				<select>
                  			<option></option>
           				</select>
					</div>
            	</div-->
            <!--?php
            }
			else
			{
			?>
            	<div class="control-group">
            		<label class="control-label" for="id_driver">Region</label>
          			<div class="controls">
                    	<select name="id_region" id="id_region"-->
            		<!--?php
            		while($data_region = mysqli_fetch_array($kueri_region))
            		{
            		?-->        
                      		<!--option value="<//?=$data_region['id_region'];?>"><?=$data_region['nama_region'];?></option-->
            <!--?php
					}
			}
			?>
            			</select>
            		</div>
            	</div-->
            
            <!--?php
            $row = mysqli_num_rows($kueri_class_type);
            if($row == NULL)
            {
            ?>
            	<div class="control-group">
            		<label class="control-label" for="id_class_type">Class Type</label>
          			<div class="controls">
           				<select>
                  			<option></option>
           				</select>
					</div>
            	</div-->
            <!--?php
            }
			else
			{
			?>
            	<div class="control-group">
            		<label class="control-label" for="id_driver">Class Type</label>
          			<div class="controls">
                    	<select name="id_class_type" id="id_class_type"-->
            		<!--?php
            		while($data_class_type = mysqli_fetch_array($kueri_class_type))
            		{
            		?-->        
                      		<!--option value="<//?=$data_class_type['id_class_type'];?>"><//?=$data_class_type['class_type_name'];?></option-->
            <!--?php
					}
			}
			?>
            			</select>
            		</div>
            	</div-->
                
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
    	</fieldset>
    </form>
</div>