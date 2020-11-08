<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_tipe = mysql_query("SELECT tipe.id_tipe_barang, tipe.tipe_barang, tipe.id_barang, tipe.status, barang.nama_barang FROM tbl_tipe_barang AS tipe LEFT JOIN tbl_barang AS barang ON tipe.id_barang = barang.id_barang");
?>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td width="10%" align="center" bgcolor="grey"><b>ID Tipe Barang</b></td>
    <td align="center"  bgcolor="grey"><b>Tipe Barang</b></td>
    <td align="center"  bgcolor="grey"><b>Jenis Barang</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Status</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  while($data_tipe = mysql_fetch_array($kueri_tipe))
  {
  ?>
  <tr>
    <td align="center" width="10%"><?=$data_tipe['id_tipe_barang'];?></td>
    <td align="center"><a href="#" onclick="return popitup('edittipe.php?id=<?=$data_tipe['id_tipe_barang'];?>')"><?=$data_tipe['tipe_barang'];?></a></td>
    <td align="center"><a href="#" onclick="return popitup('edittipe.php?id=<?=$data_tipe['id_tipe_barang'];?>')"><?=$data_tipe['nama_barang'];?></a></td>
    <td align="center"><a href="editstatustipe.php?id=<?=$data_tipe['id_tipe_barang'];?>&&status=<?=$data_tipe['status'];?>"><?=$data_tipe['status'];?></a></td>
    <td align="center"><a href="deletetipe.php?id=<?=$data_tipe['id_tipe_barang'];?>"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=1000,width=1000');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>