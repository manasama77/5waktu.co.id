<div class="container">
<div class="widget-content">
<?php
include('config.php');

$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama ASC");
?>

<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddvehicle.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="no_polisi">No Polisi</label>
              <div class="controls"><input name="no_polisi" class="text" id="no_polisi" Value="">
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Nomor Polisi harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="merk">Merk</label>
              <div class="controls"><input name="merk" class="text" id="merk" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="jenis">Jenis</label>
              <div class="controls"><input name="jenis" class="text" id="jenis" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="jumlah_ban">Jumlah Ban</label>
              <div class="controls"><input name="jumlah_ban" class="text" id="jumlah_ban" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="isi_silinder">Isi Silinder</label>
              <div class="controls"><input name="isi_silinder" class="text" id="isi_silinder" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="tahun_pembuatan">Tahun Pembuatan</label>
              <div class="controls"><input name="tahun_pembuatan" class="text" id="tahun_pembuatan" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="no_rangka">No Rangka</label>
              <div class="controls"><input name="no_rangka" class="text" id="no_rangka" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="no_mesin">No Mesin</label>
              <div class="controls"><input name="no_mesin" class="text" id="no_mesin" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="period_stnk_tanggal_bulan">Period STNK</label>
				<div class="controls">
                <input name="period_stnk" class="text" id="period_stnk" Value="">
              </div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="bahan_bakar">Bahan Bakar</label>
              <div class="controls"><input name="bahan_bakar" class="text" id="bahan_bakar" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="warna">Warna</label>
              <div class="controls"><input name="warna" class="text" id="warna" Value=""></div>
            </div>
			<?php
            $row = mysqli_num_rows($kueri_driver);
            if($row == NULL)
            {
            ?>
            	<div class="control-group">
            		<label class="control-label" for="id_driver">PIC Driver</label>
          			<div class="controls">
           				<select>
                  			<option> Data Driver Tidak Ditemukan</option>
           				</select>
					</div>
            	</div>
            <?php
            }
			else
			{
			?>
            	<div class="control-group">
            		<label class="control-label" for="id_driver">PIC Driver</label>
          			<div class="controls">
                    	<select name="id_driver" id="id_driver">
            		<?php
            		while($data_driver = mysqli_fetch_array($kueri_driver))
            		{
            		?>        
                      		<option value="<?=$data_driver['id_driver'];?>"><?=$data_driver['nama'];?></option>
            <?php
					}
			}
			?>
            			</select>
            		</div>
            	</div>
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>