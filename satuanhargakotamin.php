<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<style>
td{ font-size:12px; }
</style>
<?php
$batas=10;
if(isset($_GET['halaman']))
{
	$halaman=$_GET['halaman'];
	$posisi = ($halaman-1) * $batas;
}
else
{
	$posisi=0;
	$halaman=1;
}
	
$no=$posisi+1;
?>
<?php
if(isset($_GET['pencarian']))
{
	$keyword = $_REQUEST['keyword'];
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota AS shk LEFT JOIN tbl_kota AS kota ON shk.id_kota = kota.id_kota LEFT JOIN tbl_kategori_produk AS kp ON shk.id_kategori_produk = kp.id_kategori_produk WHERE kota.nama_kota LIKE '%$keyword%' ORDER BY kp.weight_class ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota AS shk LEFT JOIN tbl_kota AS kota ON shk.id_kota = kota.id_kota LEFT JOIN tbl_kategori_produk AS kp ON shk.id_kategori_produk = kp.id_kategori_produk ORDER BY kp.weight_class ASC LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Setting - <font color="blue">Satuan Harga Kota</font></h3>
</div>
<div class="widget-content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<h3><a href="admin.php?page=addsatuanhargakota&&subpage=1">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Satuan Harga Kota</a></h3>
		</td>
	</tr>
	</table>
	<form id="form1" name="form1" method="post" action="admin.php?page=satuanhargakota&&pencarian=on">
		Cari Kota
		<input name="keyword" type="text" id="keyword" size="50" maxlength="50" />
		<input type="submit" name="button" id="button" value="Search" />
	</form>
	<hr />
	<div class="table-responsive">
	<table width="100%" class="table table-responsive table-hover">
	  <tr>
		<td width="10%;" align="center" bgcolor="grey">ID</td>
		<td align="center" bgcolor="grey">Kota</td>
		<td align="center" bgcolor="grey">Kategori Produk</td>
		<td align="center" bgcolor="grey">Weight Class</td>
		<td align="center" bgcolor="grey">Satuan Harga</td>
		<?php
		if($_SESSION['login']['username'] == "admin" || $_SESSION['login']['username'] == "staff")
		{
		?>
			<td width="10%;" align="center" bgcolor="grey">Config</td>
		<?php
		}
		?>
	  </tr>
	  <?php
	  if($row == NULL)
	  {
	  ?>
		<tr>
			<td align="center">-</td>
			<td align="center">-</td>
			<td align="center">-</td>
			<td align="center">-</td>
			<td align="center">-</td>
		<?php
		if($_SESSION['login']['username'] == "admin" || $_SESSION['login']['username'] == "staff")
		{
		?>
			<td align="center">-</td>
		<?php
		}
		?>
		</tr>
	  <?php
	  }
	  else
	  {
		while($data_waiting = mysqli_fetch_array($kueri_waiting))
		{
			$no++;
	  ?>
	  <tr>
		<td align="center"><?=$data_waiting['id_satuan_harga_kota'];?></td>
		<td align="center"><?=$data_waiting['nama_kota'];?></td>
		<td align="center"><?=$data_waiting['nama_kategori_produk'];?></td>
		<td align="center"><?=strtoupper($data_waiting['weight_class']);?></td>
		<td align="center"><?=$data_waiting['satuan_harga'];?></td>
		<?php
		if($_SESSION['login']['level'] == "admin")
		{
		?>
			<td align="center">
			<a href="admin.php?page=editsatuanhargakota&&id=<?=$data_waiting['id_satuan_harga_kota'];?>"><div class="fa fa-edit"></div></a>
			<br />
			<a href="deletesatuanhargakota.php?id=<?=$data_waiting['id_satuan_harga_kota'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="fa fa-trash"></div></a>
			</td>
		<?php
		}
		?>
	  </tr>
	  <?php
		}
	  }
	  ?>
	</table>
	</div>
	<div align="center">
		<?php
		$file="admin.php";
		
		if(isset($_GET['pencarian']))
		{
			$keyword = $_REQUEST['keyword'];
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota AS shk LEFT JOIN tbl_kota AS kota ON shk.id_kota = kota.id_kota WHERE nama_kota LIKE '%$keyword%'");
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=satuanhargakota&&halaman=1&&pencarian=on&&keyword=$keyword><< First</A> | 
					<A HREF=$file?page=satuanhargakota&&halaman=$previous&&pencarian=on&&keyword=$keyword>< Previous</A> | ";
			}
			else
			{ 
				echo "<< First | < Previous | ";
			}
			
			$angka=($halaman > 3 ? " ... " : " ");
			for($i=$halaman-2;$i<$halaman;$i++)
			{
			  if ($i < 1) 
				  continue;
			  $angka .= "<a href=$file?page=satuanhargakota&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=satuanhargakota&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=satuanhargakota&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=satuanhargakota&&halaman=$next&&pencarian=on&&keyword=$keyword>Next ></A> | 
			  <A HREF=$file?page=satuanhargakota&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}
		else
		{
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota");
			
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=satuanhargakota&&halaman=1><< First</A> | 
					<A HREF=$file?page=satuanhargakota&&halaman=$previous>< Previous</A> | ";
			}
			else
			{ 
				echo "<< First | < Previous | ";
			}
			
			$angka=($halaman > 3 ? " ... " : " ");
			for($i=$halaman-2;$i<$halaman;$i++)
			{
			  if ($i < 1) 
				  continue;
			  $angka .= "<a href=$file?page=satuanhargakota&&halaman=$i>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=satuanhargakota&&halaman=$i>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=satuanhargakota&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=satuanhargakota&&halaman=$next>Next ></A> | 
			  <A HREF=$file?page=satuanhargakota&&halaman=$jmlhalaman>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}	
		?>
	</div>
</div>