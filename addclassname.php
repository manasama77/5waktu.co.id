<div class="container">
<div class="widget-content">
<?php
include('config.php');
?>
<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="prosesaddclassname.php" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Class Name</label>
              <div class="controls"><input name="class_name" class="text" id="class_name" Value="" size="50" maxlength="50"> 
              <?php
              if(isset($_REQUEST['error']))
			  {
				  if($_REQUEST['error'] == 1)
				  {
					  echo("<font color=\"#FF0000\"><b>Class Name harus di isi...</b></font>");
				  }
			  }
			  ?>
              </div>
              
              <div class="control-group">
            	<label class="control-label" for="">Weight Class</label>
              <div class="controls">
                <select name="weight_class" id="weight_class">
                  <option value="a">A</option>
                  <option value="b">B</option>
                  <option value="c">C</option>
                </select>
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