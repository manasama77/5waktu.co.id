<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Add Pengiriman</h3>
</div>
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<?php
	$nama_gudang=$_REQUEST['nama_gudang'];
	$id_provinsi=$_REQUEST['id_provinsi'];
	$kueri_provinsi=mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE id_provinsi='$id_provinsi'");
	$data_provinsi=mysqli_fetch_array($kueri_provinsi);
	$id_provinsi = $data_provinsi['id_provinsi'];
	$nama_provinsi = $data_provinsi['nama_provinsi'];
	$random_id = rand(0, 100000);
	$cek_random = mysqli_query($con, "SELECT * FROM tbl_pengiriman WHERE random_id = $random_id");
	$random_row = mysqli_num_rows($cek_random);
	
	if($random_row == 1)
	{
		$_SESSION["random_id"] = $random_id;
	}
	else
	{
		$random_id = rand(0, 100000);
		$cek_random = mysqli_query($con, "SELECT * FROM tbl_pengiriman WHERE random_id = $random_id");
		$random_row = mysqli_num_rows($cek_random);
		if($random_row == 1)
		{
			$_SESSION["random_id"] = $random_id;
		}
		else
		{
			$random_id = rand(0, 100000);
			$_SESSION["random_id"] = $random_id;
		}
	}
	
	$_SESSION["nama_gudang"] = $_REQUEST['nama_gudang'];
	$_SESSION["id_provinsi"] = $_REQUEST['id_provinsi'];
	
	?>
	Nama Gudang : <?=$nama_gudang;?><br>
	Provinsi : <?=$nama_provinsi;?>
	<hr />
	<form id="add_pengiriman" class="form-horizontal" action="admin.php?page=addpengiriman3" method="post">
    	<fieldset>
			
			<div class="control-group">
            	<label class="control-label" for="">Kota</label>
				<div class="controls">
					<select name="id_kota" id="id_kota">
                    <?php
					$kueri_kota = mysqli_query($con, "SELECT * FROM tbl_kota WHERE id_provinsi=$id_provinsi ORDER BY nama_kota ASC");
					while($data_kota=mysqli_fetch_array($kueri_kota))
					{
						$id_kota=$data_kota['id_kota'];
						$nama_kota=$data_kota['nama_kota'];
					?>
					  <option value="<?=$id_kota;?>"><?=$nama_kota;?></option>
			      	<?php
					}
				  	?>
                  	</select>
				</div>
            </div>
			
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Next</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>