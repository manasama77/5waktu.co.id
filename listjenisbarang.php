<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_mobil = mysqli_query($con, "SELECT * FROM tbl_barang");
?>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td width="10%" align="center" bgcolor="grey"><b>ID Jenis Barang</b></td>
    <td align="center"  bgcolor="grey"><b>Nama Jenis Barang</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Status</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  while($data_barang = mysqli_fetch_array($kueri_mobil))
  {
  ?>
  <tr>
    <td align="center" width="10%"><?=$data_barang['id_barang'];?></td>
    <td align="center"><a href="#" onclick="return popitup('editbarang.php?id=<?=$data_barang['id_barang'];?>')"><?=$data_barang['nama_barang'];?></a></td>
    <td align="center"><a href="editstatusbarang.php?id=<?=$data_barang['id_barang'];?>&&status=<?=$data_barang['status'];?>"><?=$data_barang['status'];?></a></td>
    <td align="center"><a href="deletejenisbarang.php?id=<?=$data_barang['id_barang'];?>"><div class="icon-trash"></div></a></td>
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