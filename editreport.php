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
$id = $_REQUEST['id'];
$kueri = mysqli_query($con,
"SELECT
tbl_report.do_num,
tbl_report.do_print_date,
tbl_report.exit_date,
tbl_report.received_date,
tbl_report.received_num,
tbl_report.late,
tbl_report.quantity,
tbl_report.total_weight,
tbl_report.total_volumetric,
tbl_report.price as harga,
tbl_report.total_price,
tbl_report.description,
tbl_report.status,
tbl_report.estimation_date,
tbl_vehicle.no_polisi,
tbl_driver.nama as nama_driver,
tbl_assistant.nama,
tbl_dealer.nama_dealer,
tbl_expedition.nama_expedition,
tbl_expedition.duration,
tbl_region.nama_region,
tbl_product_catalog.product_name,
tbl_product_catalog.weight,
tbl_product_catalog.volumetric,
tbl_class_name.class_name,
tbl_class_name.weight_class,
tbl_class_pricelist.class_type,
tbl_class_pricelist.price
FROM
tbl_report
Inner Join tbl_vehicle ON tbl_report.id_vehicle = tbl_vehicle.id_vehicle
Inner Join tbl_driver ON tbl_report.id_driver = tbl_driver.id_driver
Inner Join tbl_assistant ON tbl_report.id_assistant = tbl_assistant.id_assistant
Inner Join tbl_dealer ON tbl_report.id_dealer = tbl_dealer.id_dealer
Inner Join tbl_expedition ON tbl_dealer.id_expedition = tbl_expedition.id_expedition
Inner Join tbl_region ON tbl_dealer.id_region = tbl_region.id_region
Inner Join tbl_product_catalog ON tbl_report.id_product_catalog = tbl_product_catalog.id_product_catalog
Inner Join tbl_class_name ON tbl_product_catalog.id_class_name = tbl_class_name.id_class_name
Inner Join tbl_class_pricelist ON tbl_class_pricelist.id_class_name = tbl_class_name.id_class_name AND tbl_region.id_region = tbl_class_pricelist.id_region
WHERE
tbl_report.id_report =  '$id'
"
);
$data = mysqli_fetch_array($kueri);
?>
<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Edit Pengiriman Barang</h3>
</div>

<div class="widget-content">
<form method="post" id="add-template" class="form-horizontal" action="proseseditpengiriman.php">
<fieldset>
<div class="control-group">
    <table width="650" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="90">Mobil</td>
        <td width="136"><b><?=$data['no_polisi'];?></b></td>
        <td width="104">Dealer</td>
        <td width="130"><b><?=$data['nama_dealer'];?></b></td>
      </tr>
      <tr>
        <td>Product Name</td>
        <td><b><?=$data['product_name'];?> (<?=$data['quantity'];?> Qty)</b></td>
        <td>Expedtion</td>
        <td><b><?=$data['nama_expedition'];?> (<?=$data['duration'];?> Hari)</b></td>
      </tr>
      <tr>
        <td>Class Name</td>
        <td><b><?=$data['class_name'];?></b></td>
        <td>Region</td>
        <td><b><?=$data['nama_region'];?></b></td>
      </tr>
      <tr>
        <td>Price Type</td>
        <td><b>
          <?=strtoupper($data['class_type']);?>
        </b></td>
        <td>Total Weight</td>
        <td><b>
        <?php
		echo $data['total_weight'];
		?>
        (<?=strtoupper($data['weight_class']);?> Class)</b></td>
      </tr>
      <tr>
        <td>Satuan Price</td>
        <td><b>
        <?php
			$jumlah_desimal ="0";
			$pemisah_desimal =",";
			$pemisah_ribuan =".";
			
			echo "Rp ".number_format($data['total_price'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
			?>
        </b></td>
        <td>Total Volumetric</td>
        <td><b>
          	<?php
			echo $data['total_volumetric'];
			?>
        </b></td>
      </tr>
      <tr>
        <td>Total Price</td>
        <td><b>
          <?php
			$jumlah_desimal ="0";
			$pemisah_desimal =",";
			$pemisah_ribuan =".";
			
			echo "Rp ".number_format($data['total_price'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
			?>
        </b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <hr />
<label class="control-label" for="">Driver</label>
    <div class="controls">
    <input disabled="disabled" name="id_driver" type="text" id="id_driver" value="<?=$data['nama_driver'];?>" size="10" maxlength="10" title="Driver tidak dapat diganti." />
    </div>
    
    <label class="control-label" for="">Asst.</label>
    <div class="controls">
    <input disabled="disabled" name="id_assistant" type="text" id="id_assistant" value="<?=$data['nama'];?>" size="10" maxlength="10" title="Driver tidak dapat diganti." />
    </div>
    
    <label class="control-label" for="">DO Num.</label>
    <div class="controls"><input value="<?=$data['do_num'];?>" name="do_num" class="text" id="do_num" size="10" maxlength="10"></div>
    
    <label class="control-label" for="">DO Print Date</label>
	<div class="controls">
	<input name="do_print_date" value="<?=$data['do_print_date'];?>" class="text" id="do_print_date" size="10" maxlength="10">
    </div>
    
    <label class="control-label" for="">Exit Date</label>
	<div class="controls">
	<input name="exit_date" class="text" id="exit_date" size="10" maxlength="10" value="<?=$data['exit_date'];?>">
    </div>
    
    <label class="control-label" for="">Estimation Date</label>
	<div class="controls">
	<input disabled="disabled" name="estimation_date" class="text" id="estimation_date" size="10" maxlength="10" value="<?=$data['estimation_date'];?>">
    </div>
    
	<label class="control-label" for="">Received Date</label>
	<div class="controls">
	<input name="received_date" class="text" id="received_date" size="10" maxlength="10" value="<?=$data['received_date'];?>">
    </div>
	
    <label class="control-label" for="">Received Num.</label>
    <div class="controls"><input name="received_num" class="text" id="received_num" size="10" maxlength="10" value="<?=$data['received_num'];?>"></div>
    <label class="control-label" for="">Notes</label>
    <div class="controls">
      <textarea name="description" id="description" cols="45" rows="5"><?=$data['description'];?></textarea>
    </div>
    
<div class="control-group">
	<input name="id" type="hidden" id="id" value="<?=$id;?>" />
	<input name="duration" type="hidden" id="duration" value="<?=$data['duration'];?>" />
	<input name="estimation_date" type="hidden" id="estimation_date" value="<?=$data['estimation_date'];?>" />
	<input name="current_status" type="hidden" id="current_status" value="<?=$data['status'];?>" />
	<label class="control-label" for="jenis_barang"><button class="btn btn-primary" type="submit">Save</button></label>
</div>
</fieldset>
</form>
</div>