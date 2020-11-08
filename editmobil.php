<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Mobil</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_mobil WHERE id_mobil= '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_mobil" class="form-horizontal" action="proseseditmobil.php" method="post">
    	<fieldset>
			
			<div class="control-group">
				<label class="control-label">No Polisi Mobil</label>
				<div class="controls">
					<input name="no_polisi" class="text" id="no_polisi" size="10" maxlength="10" value="<?=$data['no_polisi'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Merk</label>
				<div class="controls">
					<input name="merk" class="text" id="merk" size="25" maxlength="25" value="<?=$data['merk'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Jenis</label>
				<div class="controls">
					<input name="jenis" class="text" id="jenis" size="25" maxlength="25" value="<?=$data['jenis'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Jumlah Ban</label>
				<div class="controls">
					<input name="jumlah_ban" class="text" id="jumlah_ban" size="2" maxlength="2" value="<?=$data['jumlah_ban'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Isi Silinder</label>
				<div class="controls">
					<input name="isi_silinder" class="text" id="isi_silinder" size="10" maxlength="10" value="<?=$data['isi_silinder'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Tahun Pembuatan</label>
				<div class="controls">
					<input name="tahun_pembuatan" class="text" id="tahun_pembuatan" size="10" maxlength="10" value="<?=$data['tahun_pembuatan'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">No Rangka</label>
				<div class="controls">
					<input name="no_rangka" class="text" id="no_rangka" size="50" maxlength="50" value="<?=$data['no_rangka'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">No Mesin</label>
				<div class="controls">
					<input name="no_mesin" class="text" id="no_mesin" size="40" maxlength="40" value="<?=$data['no_mesin'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Masa Berlaku STNK</label>
				<div class="controls">
					<input name="masa_berlaku_stnk" class="text" id="masa_berlaku_stnk" size="10" maxlength="10" value="<?=$data['masa_berlaku_stnk'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Bahan Bakar</label>
				<div class="controls">
					<input name="bahan_bakar" class="text" id="bahan_bakar" size="25" maxlength="25" value="<?=$data['bahan_bakar'];?>">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Warna</label>
				<div class="controls">
					<input name="warna" class="text" id="warna" size="25" maxlength="25" value="<?=$data['warna'];?>">
				</div>
			</div>
			
			<div class="control-group">
            	<label class="control-label" for="">PIC Driver</label>
                <div class="controls">
               	  <select name="id_driver" id="id_driver">
               	    <?php
					$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC");
					while($data_driver = mysqli_fetch_array($kueri_driver))
					{
					?>
                    <option value="<?=$data_driver['id_driver'];?>"
					<?php
					if($data_driver['id_driver'] == $data['id_driver'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_driver['nama_driver'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_mobil'];?>">
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
$( "#edit_mobil" ).validate({
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
</div>