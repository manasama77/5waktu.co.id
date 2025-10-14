<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Mobil</h3>
</div>
<div class="widget-content">
<div id="formcontrols" class="tab-pane active">
	<form id="add_mobil" class="form-horizontal" action="prosesaddmobil.php" method="post">
		<fieldset>
			
			<div class="control-group">
				<label class="control-label">No Polisi Mobil</label>
				<div class="controls">
					<input name="no_polisi" class="text" id="no_polisi" size="10" maxlength="10">
				</div>
				<?php
				if(isset($_REQUEST['error']))
				{
					if($_REQUEST['error'] == 1)
					{
						$nama_asst=$_REQUEST['nama_asst'];
						echo("<div class=\"alert alert-warning\">No Polisi dengan Nomor <h3>$no_polisi</h3> telah terdaftar, silahkan gunakan nomor polisi lain</div>");
					}
					elseif($_REQUEST['error'] == 2)
					{
						echo("<div class=\"alert alert-warning\">Proses tambah data gagal, silahkan coba lagi atau hubungi administrator</div>");
					}
				}
				?>
			</div>
			
			<div class="control-group">
				<label class="control-label">Merk</label>
				<div class="controls">
					<input name="merk" class="text" id="merk" size="25" maxlength="25">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Jenis</label>
				<div class="controls">
					<input name="jenis" class="text" id="jenis" size="25" maxlength="25">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Jumlah Ban</label>
				<div class="controls">
					<input name="jumlah_ban" class="text" id="jumlah_ban" size="2" maxlength="2">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Isi Silinder</label>
				<div class="controls">
					<input name="isi_silinder" class="text" id="isi_silinder" size="10" maxlength="10">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Tahun Pembuatan</label>
				<div class="controls">
					<input name="tahun_pembuatan" class="text" id="tahun_pembuatan" size="10" maxlength="10">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">No Rangka</label>
				<div class="controls">
					<input name="no_rangka" class="text" id="no_rangka" size="50" maxlength="50">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">No Mesin</label>
				<div class="controls">
					<input name="no_mesin" class="text" id="no_mesin" size="40" maxlength="40">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Masa Berlaku STNK</label>
				<div class="controls">
					<input name="masa_berlaku_stnk" class="text" id="masa_berlaku_stnk" size="10" maxlength="10">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Bahan Bakar</label>
				<div class="controls">
					<input name="bahan_bakar" class="text" id="bahan_bakar" size="25" maxlength="25">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Warna</label>
				<div class="controls">
					<input name="warna" class="text" id="warna" size="25" maxlength="25">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">PIC Driver</label>
				<div class="controls">
					<select name="id_driver" id="id_driver">
					<?php
					$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC");
					while($data_driver=mysqli_fetch_array($kueri_driver))
					{
						$id_driver = $data_driver['id_driver'];
						$nama_driver = $data_driver['nama_driver'];
					?>
					  <option value="<?=$id_driver;?>"><?=$nama_driver;?></option>
					<?php
					}
					?>
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
		
</div>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: false,
  success: "valid"
});
$( "#add_mobil" ).validate({
  rules: {
	no_polisi: {
	  required: true
	},
	jumlah_ban: {
	  digits: true
	}
  }
});
</script>