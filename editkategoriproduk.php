<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Kategori Produk</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_kategori_produk WHERE id_kategori_produk = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_kategoriproduk" class="form-horizontal" action="proseseditkategoriproduk.php" method="post">
    	<fieldset>
			
        	<div class="control-group">
            	<label class="control-label" for="">Kategori produk</label>
                <div class="controls">
					<input name="nama_kategori_produk" class="text" Value="<?=$data['nama_kategori_produk'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Weight Class</label>
                <div class="controls">
               	  <select name="weight_class" id="weight_class">
                    <option value="a"
					<?php
					if($data['weight_class'] == "a")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >A</option>
					<option value="b"
					<?php
					if($data['weight_class'] == "b")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >B</option>
					<option value="c"
					<?php
					if($data['weight_class'] == "c")
					{
						echo("selected=\"selected\"");
					}
					?>
                    >C</option>
              	  </select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_kategori_produk'];?>">
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
$( "#edit_kategoriproduk" ).validate({
  rules: {
    nama_kategori_produk: {
      required: true
    }
  }
});
</script>
</div>