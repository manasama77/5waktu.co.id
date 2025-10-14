<div class="container">
<div class="widget-content">
<?php
include('config.php');
//$kueri_cek = mysqli_query($con, "SELECT id_class_name, id_region FROM tbl_region ORDER BY nama_region ASC");
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region ORDER BY nama_region ASC");
$kueri_class_name = mysqli_query($con, "SELECT * FROM tbl_class_name ORDER BY class_name ASC");
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddclasspricelist.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Region</label>
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
            	<label class="control-label" for="">Class Name</label>
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
            
            <div class="control-group">
            	<label class="control-label" for="">Class Type</label>
              <div class="controls">
                <select name="class_type" id="class_type">
                  <option value="price">Price</option>
                  <option value="volumetric">Volumetric</option>
                  <option value="weight">Weight</option>
                </select>
              </div>
            </div>
            
          <div class="control-group">
            	<label class="control-label" for="">Price</label>
           	  <div class="controls">
           	  	<p>
           	  	  <input name="price" type="text" id="price" value="" />
           	  	  <br />
           	  	  <em>Catatan:<br />
           	  	  Jika Class
           	  	Type <strong>Volumetric</strong> atau <strong>Weight</strong> Nilai Price <u>tidak perlu di isi</u></em></p>
           	  	<?php
				if(isset($_GET['error']))
				{
					$id_region2 = $_GET['id_region'];
					$id_class_name2 = $_GET['id_class_name'];
					$kueri_region2 = mysqli_query($con, "SELECT * FROM tbl_region WHERE id_region = '$id_region2' ORDER BY nama_region ASC");
					$kueri_class_name2 = mysqli_query($con, "SELECT * FROM tbl_class_name WHERE id_class_name = '$id_class_name2' ORDER BY class_name ASC");
					$data_region2 = mysqli_fetch_array($kueri_region2);
					$nama_region2 = $data_region2['nama_region'];
					$data_class_name2 = mysqli_fetch_array($kueri_class_name2);
					$class_name2 = $data_class_name2['class_name'];
				?>
                <p style="color:#F00;">Data Class Name <b><u><?=$class_name2;?></u></b> dari Regional <b><u><?=$nama_region2;?></u></b> Telah ada, <u>Silahkan pilih Class Name dan Regional Lain</u></p>
                <?php
				}
				?>
   	        </div>
            </div>
            
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Add</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>
</div>