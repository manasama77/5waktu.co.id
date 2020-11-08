<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Edit Dealer</h3>
</div>

<div class="widget-content">
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_dealer AS dealer LEFT JOIN tbl_kota AS kota ON dealer.id_kota = kota.id_kota LEFT JOIN tbl_ekspedisi AS ekspedisi ON ekspedisi.id_ekspedisi = dealer.id_ekspedisi LEFT JOIN tbl_provinsi AS provinsi ON provinsi.id_provinsi = kota.id_provinsi WHERE id_dealer = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit_dealer" class="form-horizontal" action="proseseditdealer.php" method="post">
    	<fieldset>
		
			<div class="control-group">
            	<label class="control-label">Provinsi : <?=$data['nama_provinsi'];?></label>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Kota : <?=$data['nama_kota'];?></label>
            </div>
			
			<hr />
			
        	<div class="control-group">
            	<label class="control-label" for="">Nama Dealer</label>
                <div class="controls">
					<input name="nama_dealer" class="text" Value="<?=$data['nama_dealer'];?>" size="50" maxlength="50">
                </div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Ekspedisi</label>
                <div class="controls">
               	  <select name="id_ekspedisi" id="id_ekspedisi">
               	    <?php
					$kueri_ekspedisi = mysqli_query($con, "SELECT * FROM tbl_ekspedisi ORDER BY nama_ekspedisi ASC");
					while($data_ekspedisi = mysqli_fetch_array($kueri_ekspedisi))
					{
					?>
                    <option value="<?=$data_ekspedisi['id_ekspedisi'];?>"
					<?php
					if($data_ekspedisi['id_ekspedisi'] == $data['id_ekspedisi'])
					{
						echo("selected=\"selected\"");
					}
					?>
                    ><?=$data_ekspedisi['nama_ekspedisi'];?></option>
                    <?php
					}
					?>
              	  </select>
                </div>
            </div>
            
            <div class="form-actions">
            	<input name="id" type="hidden" Value="<?=$data['id_dealer'];?>">
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
$( "#edit_dealer" ).validate({
  rules: {
    nama_dealer: {
      required: true
    }
  }
});
</script>
</div>