<script>
$(function() {
	$('.tpl').tooltip();
});
</script>
<style>
.tpl {
display: inline-block;
width: 5em;
}
</style>
<?php
$id_vehicle = $_REQUEST['id_vehicle'];
$id_dealer  = $_REQUEST['id_dealer'];
$id_product_catalog = $_REQUEST['id_product_catalog'];
$quantity=$_REQUEST['quantity'];

$kueri_mobil = mysqli_query($con, "select * FROM tbl_vehicle where id_vehicle = '$id_vehicle'");
$data_mobil = mysqli_fetch_array($kueri_mobil);

$kueri_dealer = mysqli_query($con, "select * FROM tbl_dealer as d left join tbl_expedition as e on d.id_expedition=e.id_expedition left join tbl_region as r on r.id_region=d.id_region where id_dealer = '$id_dealer'");
$data_dealer = mysqli_fetch_array($kueri_dealer);
$id_region=$data_dealer['id_region'];
$duration=$data_dealer['duration'];

$kueri_product_catalog = mysqli_query($con, "select * FROM tbl_product_catalog as c left join tbl_class_name as cn on c.id_class_name=cn.id_class_name where id_product_catalog = '$id_product_catalog'");
$data_product_catalog = mysqli_fetch_array($kueri_product_catalog);
$volumetric=$data_product_catalog['volumetric'];
$weight=$data_product_catalog['weight'];
$weight_class=$data_product_catalog['weight_class'];
$id_class_name=$data_product_catalog['id_class_name'];

$kueri_class_price_list = mysqli_query($con, "select * FROM tbl_class_pricelist where id_region = '$id_region' and id_class_name = '$id_class_name'");
$data_class_price_list = mysqli_fetch_array($kueri_class_price_list);
$class_type=$data_class_price_list['class_type'];

$kueri_satuan_region=mysqli_query($con, "select * from tbl_min_pricelist where id_region='$id_region'");
$data_satuan_region=mysqli_fetch_array($kueri_satuan_region);
$satuan_volumetric=$data_satuan_region['satuan_volumetric'];
$satuan_weight=$data_satuan_region['satuan_weight'];
$satuan_volumetric_c=$data_satuan_region['satuan_volumetric_c'];
$satuan_weight_c=$data_satuan_region['satuan_weight_c'];

if($weight==NULL)
{
	$weight=1;
}

if($volumetric==NULL)
{
	$volumetric=1;
}

$total_weight=$weight*$quantity;
$total_volumetric=$volumetric*$quantity;

$kueri_min_pricelist=mysqli_query($con, "select * from tbl_min_pricelist where id_region='$id_region'");
$data_min_pricelist=mysqli_fetch_array($kueri_min_pricelist);
$min_pricelist=$data_min_pricelist['price_list'];

if($class_type=="weight")
{
	if($weight_class=="c")
	{
		if($total_weight<=20)
		{
			$price=$min_pricelist;
		}
		elseif($total_weight>=20)
		{
			$price=$satuan_weight_c*$weight;
		}
	}
	elseif($weight_class=="b" || $weight_class=="a")
	{
		$price=$satuan_weight*$weight;
	}
}
elseif($class_type=="volumetric")
{
	if($weight_class=="c")
	{
		$price=$satuan_volumetric_c*$volumetric;
	}
	else
	{
		$price=$satuan_volumetric*$volumetric;
	}
}
else
{
	$price=$data_class_price_list['price'];
}

$total_price=$price*$quantity;



/*
if($weight_class=='c')
{
	if($total_weight<=20)
	{
		if($class_type=='volumetric')
		{
			$price=$volumetric*$satuan_volumetric_c;
			echo $price;
		}
		else
		{
			$kueri_min_pricelist=mysqli_query($con, "select * from tbl_min_pricelist where id_region='$id_region'");
			$data_min_pricelist=mysqli_fetch_array($kueri_min_pricelist);
			$min_pricelist=$data_min_pricelist['price_list'];
		
			$price=$min_pricelist;
		}
	}
	else
	{
		if($class_type=='weight')
		{
			$price=$weight*$satuan_weight_c;
		}
		elseif($class_type=='volumetric')
		{
			$price=$volumetric*$satuan_volumetric_c;
		}
		else
		{
			$price=$data_class_price_list['price'];
		}
	}
}
else
{
	if($class_type=='weight')
	{
		$price=$weight*$satuan_weight;
	}
	elseif($class_type=='volumetric')
	{
		$price=$volumetric*$satuan_volumetric;
	}
	else
	{
		$price=$data_class_price_list['price'];
	}
}

$total_price=$price*$quantity;
*/

?>
<form method="post" id="add-template" class="form-horizontal" action="prosesaddpengiriman.php">
<fieldset>
<div class="control-group">
    <table width="100%" class="table table-responsive table-hover">
      <tr>
        <td width="90">Mobil</td>
        <td width="136"><b><?=$data_mobil['no_polisi'];?></b></td>
        <td width="104">Dealer</td>
        <td width="130"><b><?=$data_dealer['nama_dealer'];?></b></td>
      </tr>
      <tr>
        <td>Product Name</td>
        <td><b><?=$data_product_catalog['product_name'];?> (<?=$quantity;?> Qty)</b></td>
        <td>Expedtion</td>
        <td><b><?=$data_dealer['nama_expedition'];?> (<?=$duration;?> Hari)</b></td>
      </tr>
      <tr>
        <td>Class Name</td>
        <td><b><?=$data_product_catalog['class_name'];?></b></td>
        <td>Region</td>
        <td><b><?=$data_dealer['nama_region'];?></b></td>
      </tr>
      <tr>
        <td>Price Type</td>
        <td><b>
          <?=strtoupper($class_type);?>
        </b></td>
        <td>Total Weight</td>
        <td><b>
          <?=$total_weight;?> 
        (<?=strtoupper($weight_class);?> Class)</b></td>
      </tr>
      <tr>
        <td>Satuan Price</td>
        <td><b>
          Rp.<input name="price_new" type="text" id="price_new" value="<?=$price;?>" size="10" maxlength="10" title="Satuan Price dapat diganti." />
        </b></td>
        <td>Total Volumetric</td>
        <td><b>
          <?=$total_volumetric;?>
        </b></td>
      </tr>
      <tr>
        <td>Total Price</td>
        <td title="Jika Satuan Price diedit, maka Total Price akan berubah pada proses selanjutnya"><b>
        	Rp.<input name="total_price_amount" type="text" id="total_price_amount" value="<?=$total_price;?>" size="10" maxlength="10" title="Total Price Otomatis berubah." readonly="readonly" />
        </b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <hr />
<label class="control-label" for="">Driver</label>
    <div class="controls">
    <select name="id_driver" id="id_driver">
    <?php
	$kueri_driver=mysqli_query($con, "select * from tbl_driver");
    while($data_driver = mysqli_fetch_array($kueri_driver))
    {
    ?>
        <option value="<?=$data_driver['id_driver'];?>"><?=$data_driver['nama'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
    
    <label class="control-label" for="">Asst.</label>
    <div class="controls">
    <select name="id_assistant" id="id_assistant">
    <?php
	$kueri_assistant=mysqli_query($con, "select * from tbl_assistant");
    while($data_assistant = mysqli_fetch_array($kueri_assistant))
    {
    ?>
        <option value="<?=$data_assistant['id_assistant'];?>"><?=$data_assistant['nama'];?></option>
    <?php
    }
    ?>
    </select>
    </div>
    
    <label class="control-label" for="">DO Num.</label>
    <div class="controls"><input name="do_num" class="text" id="do_num" size="10" maxlength="10"></div>
    
    <label class="control-label" for="">DO Print Date</label>
	<div class="controls">
	<input name="do_print_date" class="text" id="do_print_date" size="10" maxlength="10">
    </div>
    
    <label class="control-label" for="">Exit Date</label>
	<div class="controls">
	<input name="exit_date" class="text" id="exit_date" size="10" maxlength="10">
    </div>
    
	<label class="control-label" for="">Received Num.</label>
    <div class="controls"><input name="received_num" class="text" id="received_num" size="10" maxlength="10"></div>
    
    <label class="control-label" for="">Notes</label>
    <div class="controls">
      <textarea name="description" id="description" cols="45" rows="5"></textarea>
    </div>
    
<div class="control-group">
	<input name="id_vehicle" type="hidden" id="id_vehicle" value="<?=$id_vehicle;?>" />
    <input name="id_dealer" type="hidden" id="id_barang" value="<?=$id_dealer;?>" />
    <input name="id_product_catalog" type="hidden" id="id_barang" value="<?=$id_product_catalog;?>" />
    <input name="total_weight" type="hidden" id="total_weight" value="<?=$total_weight;?>" />
    <input name="total_volumetric" type="hidden" id="total_volumetric" value="<?=$total_volumetric;?>" />
    <input name="duration" type="hidden" id="price" value="<?=$duration;?>" />
    <input name="class_type" type="hidden" id="class_type" value="<?=$class_type;?>" />
    <input name="quantity" type="hidden" id="quantity" value="<?=$quantity;?>" />
    <label class="control-label" for="jenis_barang"><button class="btn btn-primary" type="submit">Save</button></label>
</div>
</fieldset>
</form>
<script>
$(document).ready(function()
{
    function updatePrice()
    {
        var price = parseFloat($("#price_new").val());
        var total = price * <?=$quantity;?>;
        var total = total.toFixed(0);
        $("#total_price_amount").val(total);
    }
    $(document).on("change, keyup", "#price_new", updatePrice);
});
</script>