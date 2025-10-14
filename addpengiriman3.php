<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	$nama_gudang=$_SESSION['nama_gudang'];
	$id_provinsi=$_SESSION['id_provinsi'];
	$kueri_provinsi=mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi='$id_provinsi'");
	$data_provinsi=mysqli_fetch_array($kueri_provinsi);
	$id_provinsi = $data_provinsi['id_provinsi'];
	$nama_provinsi = $data_provinsi['nama_provinsi'];
	
	$id_kota=$_REQUEST['id_kota'];
	$kueri_kota=mysqli_query($con, "SELECT * FROM tbl_kota WHERE id_kota='$id_kota'");
	$data_kota=mysqli_fetch_array($kueri_kota);
	$id_kota = $data_kota['id_kota'];
	$nama_kota = $data_kota['nama_kota'];
	
	$random_id=$_SESSION['random_id'];
	
	$_SESSION["id_kota"]=$id_kota;
	?>
    Nama Gudang : <?=$nama_gudang;?><br>
	Provinsi : <?=$nama_provinsi;?><br>
	Kota : <?=$nama_kota;?>
	<hr />
	<!--form id="add_pengiriman" class="form-horizontal" action="admin.php?page=addpengiriman4" method="post" onsubmit="return checkall();"-->
	<form id="add_pengiriman" class="form-horizontal" action="admin.php?page=addpengiriman4" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Dealer</label>
				<div class="controls">
					<select name="id_dealer" id="id_dealer">
                    <?php
					$kueri_dealer = mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_kota=$id_kota ORDER BY nama_dealer ASC");
					while($data_dealer=mysqli_fetch_array($kueri_dealer))
					{
						$id_dealer=$data_dealer['id_dealer'];
						$nama_dealer=$data_dealer['nama_dealer'];
					?>
					  <option value="<?=$id_dealer;?>"><?=$nama_dealer;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">DO Num</label>
				<div class="controls">
					<input name="do_num" class="text" id="do_num" Value="" size="25" maxlength="25" onkeyup="checkname();">
					<span id="name_status"></span>
					<?php
					if(isset($_REQUEST['alert']))
					{
						echo "<span><b><font color=\"red\">DO Number Already Exist</font></b></span>";
					}
					?>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">DO Print Date</label>
				<div class="controls">
					<input name="do_print_date" class="text" id="do_print_date" Value="" size="10" maxlength="10">
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Exit Date</label>
				<div class="controls">
					<input name="exit_date" class="text" id="exit_date" Value="" size="10" maxlength="10">
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Date Terima Ekspedisi</label>
				<div class="controls">
					<input name="date_terima_ekspedisi" class="text" id="date_terima_ekspedisi" Value="" size="10" maxlength="10">
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label">Exit Time</label>
				<div class="controls">
					<select name="waktu_pengiriman" id="waktu_pengiriman">
					  <option value="normal">Normal</option>
					  <option value="late">Di atas jam 15.00</option>
                  	</select>
					<a href="#" data-toggle="tooltip" title="Jika pengiriman diatas jam 15.00 Pengiriman dilakukan di hari berikutnya" data-placement="right"><i class="fa  fa-question-circle"></i></a>
				</div>
            </div>
            
            <!--div class="control-group">
            	<label class="control-label">Received Num</label>
				<div class="controls">
					<input name="received_num" class="text" id="received_num" Value="" size="25" maxlength="25">
				</div>
            </div-->
			
			<div class="control-group">
            	<label class="control-label" for="">Mobil</label>
				<div class="controls">
					<select name="id_mobil" id="id_mobil">
                    <?php
					$kueri_mobil = mysqli_query($con, "SELECT * FROM tbl_mobil ORDER BY no_polisi ASC");
					while($data_mobil=mysqli_fetch_array($kueri_mobil))
					{
						$id_mobil=$data_mobil['id_mobil'];
						$no_polisi=$data_mobil['no_polisi'];
					?>
					  <option value="<?=$id_mobil;?>"><?=$no_polisi;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Driver</label>
				<div class="controls">
					<select name="id_driver" id="id_driver">
                    <?php
					$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC");
					while($data_driver=mysqli_fetch_array($kueri_driver))
					{
						$id_driver=$data_driver['id_driver'];
						$nama_driver=$data_driver['nama_driver'];
					?>
					  <option value="<?=$id_driver;?>"><?=$nama_driver;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
			<div class="control-group">
            	<label class="control-label" for="">Assistant</label>
				<div class="controls">
					<select name="id_asst" id="id_asst">
                    <?php
					$kueri_asst = mysqli_query($con, "SELECT * FROM tbl_asst ORDER BY nama_asst ASC");
					while($data_asst=mysqli_fetch_array($kueri_asst))
					{
						$id_asst=$data_asst['id_asst'];
						$nama_asst=$data_asst['nama_asst'];
					?>
					  <option value="<?=$id_asst;?>"><?=$nama_asst;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
            
            <div class="control-group">
            	<label class="control-label">Notes</label>
				<div class="controls">
				  <textarea name="notes" id="notes" cols="45" rows="5"></textarea>
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
function checkname()
{
 var name=document.getElementById( "do_num" ).value;
	
 if(name)
 {
  $.ajax({
  type: 'post',
  url: 'checkdonum.php',
  data: {
   do_num:name,
  },
  success: function (response) {
   $( '#name_status' ).html(response);
   if(response=="OK")	
   {
    return true;	
   }
   else
   {
    return false;	
   }
  }
  });
 }
 else
 {
  $( '#name_status' ).html("");
  return false;
 }
}

/*function checkall()
{
 var namehtml=document.getElementById("name_status").innerHTML;

 if(namehtml=="OK")
 {
  return true;
 }
 else
 {
  return false;
 }
}*/


// just for the demos, avoids form submit
jQuery.validator.setDefaults({
  debug: false,
  success: "valid"
});
$( "#add_pengiriman" ).validate({
  rules: {
    id_dealer: {
		required: true
    },
	do_num: {
		required: true
    },
	id_mobil: {
		required: true
    },
	id_driver: {
		required: true
    },
	id_asst: {
		required: true
    },
	do_print_date: {
		required: true
    },
	exit_date: {
		required: true
    }
  }
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>