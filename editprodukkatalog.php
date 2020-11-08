<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Produk Katalog</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_produk_katalog WHERE id_produk_katalog = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_produkkatalog" class="form-horizontal" action="proseseditprodukkatalog.php" method="post">
    	<fieldset>
			
        	<div class="control-group">
            	<label class="control-label" for="">Produk Name</label>
                <div class="controls">
					<input name="produk_name" class="text" Value="<?=$data['produk_name'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Weight</label>
                <div class="controls">
					<input name="weight" class="text" Value="<?=$data['weight'];?>" size="5" maxlength="5">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Panjang</label>
                <div class="controls">
					<input type="text" id="panjang" name="panjang" class="text" Value="<?=$data['panjang'];?>" size="5" maxlength="5">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Lebar</label>
                <div class="controls">
					<input type="text" id="lebar" name="lebar" class="text" Value="<?=$data['lebar'];?>" size="5" maxlength="5">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Tinggi</label>
                <div class="controls">
					<input type="text" id="tinggi" name="tinggi" class="text" Value="<?=$data['tinggi'];?>" size="5" maxlength="5">
                </div>
            </div>
			
			<div class="control-group">
				<label class="control-label">Volumetric</label>
				<div class="controls">
					<input type="text" name="volumetric" class="text" id="volumetric" Value="<?=$data['volumetric'];?>" size="10" maxlength="10">
					<a href="#" data-toggle="tooltip" title="Nilai Volumetric dapat di input manual atau automatic setelah mengisi form Panjang, Lebar dan Tinggi dan nilai Volumetric menggunakan penghitungan (PxLxT)/4000" data-placement="right"><i class="fa  fa-question-circle"></i></a>
				</div>
			</div>
			
			<div class="control-group">
            	<label class="control-label" for="">Packing Status</label>
                <div class="controls">
               	  <select name="packing_status" id="packing_status">
                    <option value="yes"
					<?php
					if($data['packing_status'] == "yes")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >Yes</option>
					<option value="no"
					<?php
					if($data['packing_status'] == "no")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >No</option>
              	  </select>
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Kategori Produk</label>
                <div class="controls">
               	  <select name="id_kategori_produk" id="id_kategori_produk">
				  <?php
				  $kueri_kategori_produk = mysqli_query($con, "SELECT * FROM tbl_kategori_produk ORDER BY nama_kategori_produk ASC");
				  while($data_kategori_produk = mysqli_fetch_array($kueri_kategori_produk))
				  {
				  ?>
                    <option value="<?=$data_kategori_produk['id_kategori_produk'];?>"
					<?php
					if($data['id_kategori_produk'] == $data_kategori_produk['id_kategori_produk'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_kategori_produk['nama_kategori_produk'];?></option>
				   <?php
				   }
				   ?>
				   </select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_produk_katalog'];?>">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
            
    </form>
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
$( "#edit_produkkatalog" ).validate({
  rules: {
	produk_name: {
	  required: true
	},
	weight: {
	  number: true
	},
	volumetric: {
	  number: true
	},
	panjang: {
	  number: true
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
</div>