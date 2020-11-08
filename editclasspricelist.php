<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Edit Class Price List</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_REQUEST['id'];
$kueri= mysqli_query($con, "SELECT * FROM tbl_class_pricelist WHERE id_class_pricelist = '$id'");
$data=mysqli_fetch_array($kueri);
$id_region=$data['id_region'];
$id_class_name=$data['id_class_name'];
$price=$data['price'];
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region WHERE id_region = '$id_region'");
$kueri_class_name = mysqli_query($con, "SELECT * FROM tbl_class_name WHERE id_class_name = '$id_class_name'");

$data_region=mysqli_fetch_array($kueri_region);
$data_class_name=mysqli_fetch_array($kueri_class_name);

$nama_region=$data_region['nama_region'];
$class_name=$data_class_name['class_name'];
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_class_pricelist" class="form-horizontal" action="proseseditclasspricelist.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Region</label>
              <div class="controls">
                <input name="textfield" type="text" id="textfield" value="<?=$nama_region;?>" disabled="disabled"/>
                <input name="id" type="hidden" id="id" value="<?=$id;?>" />
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Class Name</label>
              <div class="controls">
                <input name="textfield2" type="text" id="textfield2" value="<?=$class_name;?>" disabled="disabled" />
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Class Type</label>
                <div class="controls">
               	  <select name="class_type" id="class_type" style="font-size:10px;">                    
                    <option value="price"
                    <?php
					if($data['class_type'] == "price")
					{
						echo("selected=\"selected\"");
					}
					?>>Price</option>
                    <option value="volumetric"
                    <?php
					if($data['class_type'] == "volumetric")
					{
						echo("selected=\"selected\"");
					}
					?>>Volumetric</option>
                    <option value="weight"
                    <?php
					if($data['class_type'] == "weight")
					{
						echo("selected=\"selected\"");
					}
					?>>Weight</option>
              	  </select>
                </div>
            </div>
            
          <div class="control-group">
            	<label class="control-label" for="">Price</label>
           	  <div class="controls">
           	  	<p>
           	  	  <input name="price" type="text" id="price" value="<?=$price;?>" /><span Class="alert alert-info">Jika Class Type <strong>Volumetric</strong> atau <strong>Weight</strong> isi Nilai Price dengan angka <b>0</b></span>
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
				<p>
                <span class="alert alert-danger">Data Class Name <b><u><?=$class_name2;?></u></b> dari Regional <b><u><?=$nama_region2;?></u></b> Telah ada, <u>Silahkan pilih Class Name dan Regional Lain</u></span>
				</p>
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
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: false,
  success: "valid"
});
$( "#edit_class_pricelist" ).validate({
  rules: {
    price: {
      required: true,
      digits: true
    }
  }
});
</script>
</div>