<?php
if(isset($_REQUEST['subpage']))
{
	$subpage=$_REQUEST['subpage'];
	if($subpage==1)
	{
?>
		<div class="container">
			<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Dealer</h3>
		</div>
		<div class="widget-content">
		<div id="formcontrols" class="tab-pane active">
			<form id="add_dealer1" class="form-horizontal" action="admin.php?page=adddealer&subpage=2" method="post">
				<fieldset>
					
					<div class="control-group">
						<label class="control-label">Provinsi</label>
						<div class="controls">
							<select name="id_provinsi" id="id_provinsi">
							<?php
							include('config.php');
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
					
					<div class="form-actions">
						<button class="btn btn-primary" type="submit">Add</button>
					</div>
				</fieldset>
			</form>
		</div>
		</div>
<?php
	}
	elseif($subpage==2)
	{
		$id_provinsi=$_REQUEST['id_provinsi'];
		$kueri_provinsi2 = mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi = '$id_provinsi'");
		$data_provinsi2 = mysqli_fetch_array($kueri_provinsi2);
		$nama_provinsi2 = $data_provinsi2['nama_provinsi'];
?>
		<div class="container">
			<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Dealer</h3>
		</div>
		<div class="widget-content">
		<div id="formcontrols" class="tab-pane active">
			<form id="add_dealer2" class="form-horizontal" action="prosesadddealer.php" method="post">
				<fieldset>
				
					<div class="control-group">
						<label class="control-label" for="">Provinsi: <?=$nama_provinsi2;?></label>
					</div>
					
					<hr />
					
					<div class="control-group">
						<label class="control-label" for="">Kota</label>
						<div class="controls">
							<select name="id_kota" id="id_kota">
							<?php
							$kueri_kota = mysqli_query($con, "SELECT * FROM tbl_kota WHERE id_provinsi = '$id_provinsi' ORDER BY nama_kota ASC");
							while($data_kota=mysqli_fetch_array($kueri_kota))
							{
								$id_kota=$data_kota['id_kota'];
								$nama_kota=$data_kota['nama_kota'];
							?>
							  <option value="<?=$id_kota;?>"><?=$nama_kota;?></option>
							<?php
							}
							?>
							</select>
							<?php
							if(isset($_REQUEST['error']))
							{
								if($_REQUEST['error'] == 1)
								{
									$nama_dealer2=$_REQUEST['nama_dealer'];
									echo("<div class=\"alert alert-warning\">Dealer dengan nama <h3>$nama_dealer2</h3> telah terdaftar, silahkan gunakan dealer lain</div>");
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
						<label class="control-label" for="">Ekspedisi</label>
						<div class="controls">
							<select name="id_ekspedisi" id="id_ekspedisi">
							<?php
							$kueri_ekspedisi = mysqli_query($con, "SELECT * FROM tbl_ekspedisi ORDER BY nama_ekspedisi ASC");
							while($data_ekspedisi=mysqli_fetch_array($kueri_ekspedisi))
							{
								$id_ekspedisi=$data_ekspedisi['id_ekspedisi'];
								$nama_ekspedisi=$data_ekspedisi['nama_ekspedisi'];
							?>
							  <option value="<?=$id_ekspedisi;?>"><?=$nama_ekspedisi;?></option>
							<?php
							}
							?>
							</select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Nama Dealer</label>
						<div class="controls">
							<input name="nama_dealer" class="text" id="nama_dealer" size="50" maxlength="50">
						</div>
					</div>
					
					<div class="form-actions">
						<input name="id_provinsi" type="hidden" id="id_provinsi" value="<?=$id_provinsi;?>" />
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
		$( "#add_dealer2" ).validate({
		  rules: {
			nama_dealer: {
			  required: true
			}
		  }
		});
		</script>
<?php
	}
}
?>