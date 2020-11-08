<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Satuan Harga Dasar</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota AS shk LEFT JOIN tbl_kota AS kota ON shk.id_kota = kota.id_kota LEFT JOIN tbl_kategori_produk AS kp ON shk.id_kategori_produk = kp.id_kategori_produk LEFT JOIN tbl_provinsi AS provinsi ON kota.id_provinsi = provinsi.id_provinsi WHERE id_satuan_harga_kota = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_satuanhargakota" class="form-horizontal" action="proseseditsatuanhargakota.php" method="post">
    	<fieldset>
			
        	<div class="control-group">
				<label class="control-label">Provinsi: <?php echo $data['nama_provinsi']; ?></label><br>
				<label class="control-label">Kota: <?php echo $data['nama_kota']; ?></label>
			</div>
			
			<hr />
			
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
			
			<div class="control-group">
            	<label class="control-label" for="">Satuan Harga</label>
                <div class="controls">
					<input name="satuan_harga" class="text" Value="<?=$data['satuan_harga'];?>" size="7" maxlength="7">
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_satuan_harga_kota'];?>">
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
$( "#edit_satuanhargakota" ).validate({
  rules: {
	satuan_harga: {
	  required: true,
	  digits: true
	}
  }
});
</script>
</div>