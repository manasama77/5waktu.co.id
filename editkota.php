<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Kota</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_kota AS kota LEFT JOIN tbl_provinsi AS provinsi ON kota.id_provinsi = provinsi.id_provinsi WHERE id_kota = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_kota" class="form-horizontal" action="proseseditkota.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Kota</label>
                <div class="controls">
					<input name="nama_kota" class="text" Value="<?=$data['nama_kota'];?>" size="25" maxlength="25">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Nama Kota</label>
                <div class="controls">
					<input name="nama_kota" class="text" Value="<?=$data['nama_kota'];?>" size="25" maxlength="25">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Provinsi</label>
                <div class="controls">
               	  <select name="id_provinsi" id="id_provinsi">
               	    <?php
					$kueri_provinsi = mysqli_query($con, "SELECT * FROM tbl_provinsi ORDER BY nama_provinsi ASC");
					while($data_provinsi = mysqli_fetch_array($kueri_provinsi))
					{
					?>
                    <option value="<?=$data_provinsi['id_provinsi'];?>"
					<?php
					if($data_provinsi['id_provinsi'] == $data['id_provinsi'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_provinsi['nama_provinsi'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Durasi</label>
                <div class="controls">
					<input name="durasi" class="text" Value="<?=$data['durasi'];?>" size="3" maxlength="3">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Penghitungan</label>
                <div class="controls">
               	  <select name="satuan_penghitungan" id="satuan_penghitungan">
                    <option value="weight"
					<?php
					if($data['satuan_penghitungan'] == "weight")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >weight</option>
					<option value="volumetric"
					<?php
					if($data['satuan_penghitungan'] == "volumetric")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >volumetric</option>
              	  </select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_kota'];?>">
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
$( "#edit_kota" ).validate({
  rules: {
    nama_kota: {
      required: true
    },
	durasi: {
      digits: true
    }
  }
});
</script>
</div>