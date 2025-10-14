<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>List Pengiriman Barang</h3>
</div>
<div class="widget-content">
	<div class="tab-content">
		<div id="listpengiriman" class="tab-pane active">
			<div><h4><a href="admin.php?page=addpengiriman&amp;&amp;sub=1">
            <img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Tambah Pengiriman
            </a></h4></div>
            <div>
              <form id="formpencarianpengiriman" name="formpencarianpengiriman" method="post" action="admin.php?page=filterpengiriman">
                Pencarian DO
                <input type="text" name="do" id="do" />
                <input type="submit" name="button" id="button" value="Cari" />
              </form>
            </div>
			<?php include('listfilterpengiriman.php'); ?>
		</div>
	</div>
</div>