<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<?php
include('config.php');
$id = $_GET['id'];

$kueri = mysqli_query($con, "SELECT * FROM tbl_user WHERE id_user = '$id'");
$data = mysqli_fetch_array($kueri);
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add-user" class="form-horizontal" action="prosesedituser.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="username">Username</label>
                <div class="controls"><input name="username" class="text" id="username" value="<?=$data['username'];?>" size="25" maxlength="25" style="font-size:10px;">
                  <input name="id" type="hidden" id="id" value="<?=$data['id_user'];?>" />
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