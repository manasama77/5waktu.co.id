<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysql_query("SELECT * FROM tbl_tipe_barang WHERE id_tipe_barang = '$id'");
$data = mysql_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit-barang" class="form-horizontal" action="prosesedittipe.php">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="kategori">Tipe Barang</label>
                <div class="controls">
                  <p>
                  <input name="tipe_barang" class="text" id="tipe_barang" Value="<?=$data['tipe_barang'];?>" size="50" maxlength="50" style="font-size:10px;">
                  <input name="id" type="hidden" id="id" value="<?=$data['id_tipe_barang'];?>" />
                  </p>
                  <p>
                    <select name="id_barang" id="id_barang">
                    <?php
					$kueri2 = mysql_query("SELECT * FROM tbl_barang WHERE status = 'show'");
					while($data2 = mysql_fetch_array($kueri2))
					{
					?>
                      <option value="<?=$data2['id_barang'];?>"><?=$data2['nama_barang'];?></option>
                    <?php
					}
					?>
                    </select>
                    <br />
                  Note:<br />
                Sesudah melakukan update data silahkan refresh browser dengan menekan tombol <strong>F5</strong></p>
                </div>
            </div>
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
    	</fieldset>
    </form>
</div>