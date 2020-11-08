<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_barang WHERE id_barang = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="edit-barang" class="form-horizontal" action="proseseditbarang.php">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="kategori">Barang</label>
                <div class="controls"><input name="nama_barang" class="text" id="nama_barang" Value="<?=$data['nama_barang'];?>" size="50" maxlength="50" style="font-size:10px;">
                  <input name="id" type="hidden" id="id" value="<?=$data['id_barang'];?>" />
                  <br />
                  Note:<br />
                Sesudah melakukan update data silahkan refresh browser dengan menekan tombol <strong>F5</strong> </div>
            </div>
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Save</button>
            </div>
    	</fieldset>
    </form>
</div>