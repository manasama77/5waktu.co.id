<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Produk Katalog</h3>
</div>
<div class="widget-content">
<div id="formcontrols" class="tab-pane active">
	<form id="add_produkkatalog" class="form-horizontal" action="prosesaddprodukkatalog.php" method="post">
		<fieldset>
			
			<div class="control-group">
				<label class="control-label">Produk Name</label>
				<div class="controls">
					<input name="produk_name" class="text" id="produk_name" size="50" maxlength="50">
				</div>
				<?php
				if(isset($_REQUEST['error']))
				{
					if($_REQUEST['error'] == 1)
					{
						$produk_name=$_REQUEST['produk_name'];
						echo("<div class=\"alert alert-warning\">Produk dengan nama <h3>$produk_name</h3> telah terdaftar, silahkan gunakan nama Produk lain</div>");
					}
					elseif($_REQUEST['error'] == 2)
					{
						echo("<div class=\"alert alert-warning\">Proses tambah data gagal, silahkan coba lagi atau hubungi administrator</div>");
					}
				}
				?>
			</div>
			
			<div class="control-group">
				<label class="control-label">Weight</label>
				<div class="controls">
					<input name="weight" class="text" id="weight" size="5" maxlength="5">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Panjang</label>
				<div class="controls">
					<input type="text" value="" name="panjang" class="text" id="panjang" size="5" maxlength="5">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Lebar</label>
				<div class="controls">
					<input type="text" value="" name="lebar" class="text" id="lebar" size="5" maxlength="5">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Tinggi</label>
				<div class="controls">
					<input name="tinggi" class="text" id="tinggi" size="5" maxlength="5">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Volumetric</label>
				<div class="controls">
					<input type="text" name="volumetric" class="text" id="volumetric" value="0" size="10" maxlength="10">
					<a href="#" data-toggle="tooltip" title="Nilai Volumetric dapat di input manual atau automatic setelah mengisi form Panjang, Lebar dan Tinggi dan nilai Volumetric menggunakan penghitungan (PxLxT)/4000" data-placement="right"><i class="fa  fa-question-circle"></i></a>
				</div>
			</div>
			
			<div class="control-group">
            	<label class="control-label">Packing Status</label>
				<div class="controls">
				  <select name="packing_status" id="packing_status">
				    <option value="yes">Yes</option>
				    <option value="no">No</option>
			      </select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Kategori Produk</label>
				<div class="controls">
				  <select name="id_kategori_produk" id="id_kategori_produk">
				  <?php
				  $kueri_kategori_produk = mysqli_query($con, "SELECT * FROM tbl_kategori_produk ORDER BY nama_kategori_produk ASC");
				  while($data_kategori_produk = mysqli_fetch_array($kueri_kategori_produk))
				  {
				  ?>
				    <option value="<?=$data_kategori_produk['id_kategori_produk'];?>"><?=$data_kategori_produk['nama_kategori_produk'];?></option>
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
$(document).ready(function()
{
	$('[data-toggle="tooltip"]').tooltip(); 
    function updatePrice()
    {
        var panjang = $("#panjang").val();
        var lebar = $("#lebar").val();
        var tinggi = $("#tinggi").val();
        var total = (panjang * lebar * tinggi) / 4000;
        //var total = total.toFixed(0);
        $("#volumetric").val(total);
    }
    $(document).on("change, keyup", "#panjang", updatePrice);
    $(document).on("change, keyup", "#lebar", updatePrice);
    $(document).on("change, keyup", "#tinggi", updatePrice);
});
// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: false,
  success: "valid"
});
$( "#add_produkkatalog" ).validate({
  rules: {
	produk_name: {
	  required: true
	},
	weight: {
	  required: true,
	  number: true
	},
	volumetric: {
	  required: true
	},
	lebar: {
	  number: true
	},
	tinggi: {
	  number: true
	}
  }
});
</script>