<div class="container">
<div class="widget-content">
<div id="formcontrols" class="tab-pane active">
	<form id="add-template" class="form-horizontal" action="admin.php?page=addpricelist" method="post">
    	<fieldset>
        	<div class="control-group">
            	<label class="control-label" for="">Price Type</label>
              <div class="controls">
              	<select name="type" id="type">
              	  <option value="p">Price</option>
              	  <option value="v">Volumetric</option>
              	  <option value="k">per/kg</option>
              	  <option value="j">Jakarta + Real Cost</option>
                  
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