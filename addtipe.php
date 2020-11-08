<div class="container">
<div class="widget-content">
<?php
include('config.php');
$kueri = mysql_query("SELECT * FROM tbl_barang WHERE status = 'show'");
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddtipe.php">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="nama_barang">Tipe Barang</label>
              <div class="controls"><input name="tipe_barang" class="text" id="tipe_barang" Value=""></div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="nama_barang">Jenis Barang</label>
              <div class="controls">
                <select name="id_barang" id="id_barang">
                <?php
				while($data = mysql_fetch_array($kueri))
				{
				?>
                  <option value="<?=$data['id_barang'];?>"><?=$data['nama_barang'];?></option>
                <?php
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
</div>