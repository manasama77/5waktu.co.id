<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Ekspedisi</h3>
</div>
<div class="widget-content">
<div id="formcontrols" class="tab-pane active">
	<form id="add_ekspedisi" class="form-horizontal" action="prosesaddekspedisi.php" method="post">
		<fieldset>
			
			<div class="control-group">
				<label class="control-label">Nama Ekspedisi</label>
				<div class="controls">
					<input name="nama_ekspedisi" class="text" id="nama_ekspedisi" size="25" maxlength="25">
				</div>.
				<?php
				if(isset($_REQUEST['error']))
				{
					if($_REQUEST['error'] == 1)
					{
						$nama_ekspedisi=$_REQUEST['nama_ekspedisi'];
						echo("<div class=\"alert alert-warning\">Ekspedisi dengan nama <h3>$nama_ekspedisi</h3> telah terdaftar, silahkan gunakan nama Ekspedisi lain</div>");
					}
					elseif($_REQUEST['error'] == 2)
					{
						echo("<div class=\"alert alert-warning\">Proses tambah data gagal, silahkan coba lagi atau hubungi administrator</div>");
					}
				}
				?>
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
$( "#add_ekspedisi" ).validate({
  rules: {
	nama_ekspedisi: {
	  required: true
	}
  }
});
</script>