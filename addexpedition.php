<div class="container">
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddexpedition.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Nama Expedition / Ekspedisi</label>
              <div class="controls"><input name="nama_expedition" class="text" id="nama_expedition" Value=""> 
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Nama Expedition harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
            </div>
            
            <div class="control-group">
            	<label class="control-label" for="">Duration / Day</label>
              <div class="controls"><input name="duration" class="text" id="duration" Value=""> </div>
            </div>
            
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Add</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>
</div>