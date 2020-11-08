<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Kategori Produk</h3>
</div>
<div class="widget-content">
<div id="formcontrols" class="tab-pane active">
	<form id="add_kategoriproduk" class="form-horizontal" action="prosesaddkategoriproduk.php" method="post">
		<fieldset>
			
			<div class="control-group">
				<label class="control-label">Kategori Produk</label>
				<div class="controls">
					<input name="nama_kategori_produk" class="text" id="nama_kategori_produk" size="50" maxlength="50">
				</div>.
				<?php
				if(isset($_REQUEST['error']))
				{
					if($_REQUEST['error'] == 1)
					{
						$nama_kategori_produk=$_REQUEST['nama_kategori_produk'];
						echo("<div class=\"alert alert-warning\">Kategori Produk dengan nama <h3>$nama_kategori_produk</h3> telah terdaftar, silahkan gunakan nama Kategori Produk lain</div>");
					}
					elseif($_REQUEST['error'] == 2)
					{
						echo("<div class=\"alert alert-warning\">Proses tambah data gagal, silahkan coba lagi atau hubungi administrator</div>");
					}
				}
				?>
			</div>
			
			<div class="control-group">
            	<label class="control-label">Weight Class</label>
				<div class="controls">
				  <select name="weight_class" id="weight_class">
				    <option value="a">A</option>
				    <option value="b">B</option>
				    <option value="c">C</option>
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
$( "#add_kategoriproduk" ).validate({
  rules: {
	nama_kategori_produk: {
	  required: true
	}
  }
});
</script>