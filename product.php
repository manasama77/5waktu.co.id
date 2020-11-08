<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>List Product Catalog</h3>
</div>
<div class="widget-content">
	<div class="tab-content">
		<div id="listpengiriman" class="tab-pane active">
			<?php
			if(isset($_REQUEST['filter']))
			{
				include('filterlistproductcatalog.php');
			}
			else
			{
				include('listproductcatalog.php');
			}
			?>
		</div>
	</div>
</div>