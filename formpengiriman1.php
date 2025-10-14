<?php
$id_region=$_REQUEST['id_region'];
$kueri_vehicle = mysqli_query($con, "SELECT * FROM tbl_vehicle");
$kueri_dealer = mysqli_query($con, "SELECT * FROM tbl_dealer where id_region='$id_region'");
$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog order by product_name ASC");
?>
<form method="post" id="add_pengiriman1" class="form-horizontal" action="admin.php?page=addpengiriman&amp;&amp;sub=2">
<fieldset>
<div class="control-group">
    <label class="control-label" for="">Mobil</label>
    <div class="controls">
    <select name="id_vehicle" id="id_vehicle">
    <?php
    while($data_vehicle = mysqli_fetch_array($kueri_vehicle))
    {
    ?>
        <option value="<?=$data_vehicle['id_vehicle'];?>"><?=$data_vehicle['no_polisi'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="">Dealer</label>
    <div class="controls">
    <select name="id_dealer" id="id_dealer">
<?php
    while($data_dealer = mysqli_fetch_array($kueri_dealer))
    {
    ?>
        <option value="<?=$data_dealer['id_dealer'];?>"><?=$data_dealer['nama_dealer'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="">Product Name</label>
    <div class="controls">
    <select name="id_product_catalog" id="id_product_catalog">
<?php
    while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
    {
    ?>
        <option value="<?=$data_product_catalog['id_product_catalog'];?>"><?=$data_product_catalog['product_name'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="">Quantity</label>
    <div class="controls">
      <input name="quantity" type="text" id="quantity" size="5" maxlength="5" />
      <input name="id_region" type="hidden" id="id_region" value="<?=$id_region;?>" />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="id_barang"><button class="btn btn-primary" type="submit">Next</button></label>
</div>
</fieldset>
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
$( "#add_pengiriman1" ).validate({
  rules: {
    quantity: {
      required: true,
	  digits: true
    }
  }
});
</script>