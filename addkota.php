<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Kota</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add_kota" class="form-horizontal" action="prosesaddkota.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Kota</label>
				<div class="controls">
					<input name="nama_kota" class="text" id="nama_kota" Value="" size="25" maxlength="25">
                    <?php
					if(isset($_REQUEST['error']))
					{
						if($_REQUEST['error'] == 1)
						{
							$nama_kota=$_REQUEST['nama_kota'];
							echo("<div class=\"alert alert-warning\">Kota dengan nama <h3>$nama_kota</h3> telah terdaftar, silahkan gunakan nama kota lain</div>");
						}
						elseif($_REQUEST['error'] == 2)
						{
							echo("<div class=\"alert alert-warning\">Proses tambah data gagal, silahkan coba lagi atau hubungi administrator</div>");
						}
					}
					?>
				</div>
              
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Provinsi</label>
				<div class="controls">
					<select name="id_provinsi" id="id_provinsi">
                    <?php
					$kueri_provinsi = mysqli_query($con, "SELECT * FROM tbl_provinsi ORDER BY nama_provinsi ASC");
					while($data_provinsi=mysqli_fetch_array($kueri_provinsi))
					{
						$id_provinsi=$data_provinsi['id_provinsi'];
						$nama_provinsi=$data_provinsi['nama_provinsi'];
					?>
					  <option value="<?=$id_provinsi;?>"><?=$nama_provinsi;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
              
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Durasi Pengiriman</label>
				<div class="controls">
					<input name="durasi" class="text" id="durasi" Value="" size="3" maxlength="3">
				</div>
              
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Penghitungan</label>
				<div class="controls">
				  <select name="satuan_penghitungan" id="satuan_penghitungan">
				    <option value="weight">weight</option>
				    <option value="volumetric">volumetric</option>
			      </select>
				</div>
              
            </div>
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Add</button>
            </div>
    	</fieldset>
    </form>
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
$( "#add_kota" ).validate({
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