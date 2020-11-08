<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_pengiriman = mysql_query("SELECT * FROM tbl_tagihan_dealer");
?>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td width="5%" align="center" bgcolor="grey"><b>ID</b></td>
    <td width="10%" align="center" bgcolor="grey"><b>No. Mobil</b></td>
    <td align="center"  bgcolor="grey"><b>Jenis Barang</b></td>
    <td align="center"  bgcolor="grey"><b>Tipe Barang</b></td>
    <td align="center"  bgcolor="grey"><b>Nama Dealer</b></td>
    <td align="center"  bgcolor="grey"><b>No. DO</b></td>
    <td align="center"  bgcolor="grey"><b>No. Resi</b></td>
    <td align="center"  bgcolor="grey"><b>Jumlah</b></td>
    <td align="center"  bgcolor="grey"><b>Jenis Ekspedisi</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Status</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  while($data_pengiriman = mysql_fetch_array($kueri_pengiriman))
  {
  ?>
  <tr>
    <td align="center" width="10%">
		<?=$data_pengiriman['id_pengiriman'];?>
    </td>
    <?php
	//$id_mobil = $data_pengiriman['id_mobil'];
	$kueri_mobil = mysql_query("SELECT * FROM tbl_mobil WHERE id_mobil = '$data_pengiriman[id_mobil]'");
	while($data_mobil = mysql_fetch_array($kueri_mobil))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_mobil['nama_mobil'];?>
        </a>
    </td>
    <?php
	}
	?>
    <?php
	$kueri_jenis_barang = mysql_query("SELECT * FROM tbl_barang WHERE id_barang = '$data_pengiriman[id_barang]'");
	while($data_barang = mysql_fetch_array($kueri_jenis_barang))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_barang['nama_barang'];?>
        </a>
    </td>
    <?php
	}
	?>
    <?php
	$kueri_tipe_barang = mysql_query("SELECT * FROM tbl_tipe_barang WHERE id_tipe_barang = '$data_pengiriman[id_tipe_barang]'");
	while($data_tipe_barang = mysql_fetch_array($kueri_tipe_barang))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_tipe_barang['tipe_barang'];?>
        </a>
    </td>
    <?php
	}
	?>
    <?php
	$kueri_dealer = mysql_query("SELECT * FROM tbl_dealer WHERE id_dealer = '$data_pengiriman[id_dealer]'");
	while($data_dealer = mysql_fetch_array($kueri_dealer))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_dealer['nama_dealer'];?>
        </a>
    </td>
    <?php
	}
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_pengiriman['no_do'];?>
        </a>
    </td>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_pengiriman['no_resi'];?>
        </a>
    </td>
    <?php
	if(isset($data_pengiriman['jumlah_1']))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_pengiriman['jumlah_1'];?> Pcs
        </a>
    </td>
    <?php
	}elseif(isset($data_pengiriman['jumlah_2']))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_pengiriman['jumlah_2'];?> Koli
        </a>
    </td>
    <?php
	}else{
	?>
    <td align="center">
    	Error
    </td>
    <?php
	}
	?>
    <?php
	$kueri_ekspedisi = mysql_query("SELECT * FROM tbl_ekspedisi WHERE id_ekspedisi = '$data_pengiriman[id_ekspedisi]'");
	while($data_ekspedisi = mysql_fetch_array($kueri_ekspedisi))
	{
	?>
    <td align="center">
    	<a href="#" onclick="return popitup('editpengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>')">
    	<?=$data_ekspedisi['nama_ekspedisi'];?>
        </a>
    </td>
    <?php
	}
	?>
    <td align="center">
    	<a href="editstatuspengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>&&status=<?=$data_pengiriman['status'];?>">
    	<?=$data_pengiriman['status'];?>
        </a>
    </td>
    <td align="center">
    	<a href="deletepengiriman.php?id=<?=$data_pengiriman['id_pengiriman'];?>">
        <div class="icon-trash"></div>
        </a>
	</td>
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