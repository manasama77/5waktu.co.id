<?php
$status=$_REQUEST['status'];
if($status=="filterwaiting")
{
	$status="waiting";
}
elseif($status=="filterprogress")
{
	$status="progress";
}
elseif($status=="filterdelivered")
{
	$status="delivered";
}


?>
<div class="container">
	<div class="widget-header"><i class="icon-list-alt"></i><h3>Report Pengiriman Barang - Status <font color="red"><?=strtoupper($status);?></font></h3>
</div>
<div class="widget-content">
	<div class="tab-content">
		<div id="listpengiriman" class="tab-pane active">
            <?php
			if($_SESSION['login']['username'] == "sales")
			{
			?>
            <div></div>
            <?php
			}
			else
			{
			?>
            <div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            	<td align="left"><h3>
            		<a href="admin.php?page=addpengiriman&&sub=0">
					<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Pengiriman
					</a></h3>
            	</td>
                <td align="right"><input type="button" class="button btn btn-success btn-medium" onclick="exportExcel();" value="Export All Data to Excel"/> <input type="button" class="button btn btn-alert btn-medium" onclick="exportPDF();" value="Export All Data to PDF"/></td>
            </tr>
            </table>
            </div>
            <?php
			}
			?>
			<?php
			$status="";
			$status=$_REQUEST['status'];
			if($status=='waiting')
			{
				include('listpengirimanwaiting.php');
			}
			elseif($status=='progress')
			{
				include('listpengirimanprogress.php');
			}
			elseif($status=='delivered')
			{
				include('listpengirimandelivered.php');
			}
			elseif($status=='filterwaiting')
			{
				include('filterlistpengirimanwaiting.php');
			}
			elseif($status=='filterprogress')
			{
				include('filterlistpengirimanprogress.php');
			}
			elseif($status=='filterdelivered')
			{
				include('filterlistpengirimandelivered.php');
			}
			?>
		</div>
	</div>
</div>
<script language="javascript" type="text/javascript">
function exportExcel() {
    window.open("exportexcel.php");
}

function exportPDF() {
    window.open("exporttopdf.php");
}
</script>