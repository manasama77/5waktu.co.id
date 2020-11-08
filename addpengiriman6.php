<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
$id=$_REQUEST['id'];
$status=$_REQUEST['status'];
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	$random_id= $_SESSION['random_id'];
	?>
	<form id="add_pengiriman" class="form-horizontal" action="prosesaddpengiriman3.php?status=<?=$status;?>&&id=<?=$id;?>" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Produk</label>
				<div class="controls">
					<select name="id_produk_katalog" id="id_produk_katalog">
                    <?php
					$kueri_produk_katalog = mysqli_query($con, "SELECT * FROM tbl_produk_katalog ORDER BY produk_name ASC");
					while($data_produk_katalog=mysqli_fetch_array($kueri_produk_katalog))
					{
						$id_produk_katalog=$data_produk_katalog['id_produk_katalog'];
						$produk_name=$data_produk_katalog['produk_name'];
					?>
					  <option value="<?=$id_produk_katalog;?>"><?=$produk_name;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Quantity</label>
				<div class="controls">
					<input name="quantity" class="text" id="quantity" Value="" size="5" maxlength="5">
				</div>
            </div>
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Next</button>
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
$( "#add_pengiriman" ).validate({
  rules: {
    id_produk_katalog: {
		required: true
    },
	quantity: {
		required: true,
		digits: true
    }
  }
});
</script>