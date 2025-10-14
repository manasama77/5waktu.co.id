<div class="container">
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddclasstype.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="class_type_name">Name Type Class</label>
              <div class="controls"><input name="class_type_name" class="text" id="class_type_name" Value=""> 
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Name Type Class harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
            </div>
            <div class="form-actions">
            	<button class="btn btn-primary" type="submit">Add</button>
            </div>
    	</fieldset>
    </form>
</div>
</div>
</div>