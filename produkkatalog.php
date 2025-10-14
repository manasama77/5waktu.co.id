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
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_produk_katalog AS pk LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE produk_name LIKE '%$keyword%' ORDER BY produk_name ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_produk_katalog AS pk LEFT JOIN tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk ORDER BY produk_name ASC LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Setting - <font color="blue">Produk Katalog</font></h3>
</div>
<div class="widget-content">
	<?php
	if($_SESSION['login']['level'] == "super_admin" || $_SESSION['login']['level'] == "staff"){
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<h3><a href="admin.php?page=addprodukkatalog">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Produk Katalog</a></h3>
		</td>
	</tr>
	</table>
	<?php
	}
	?>
	<form id="form1" name="form1" method="post" action="admin.php?page=produkkatalog&&pencarian=on">
		Cari Produk
		<input name="keyword" type="text" id="keyword" size="50" maxlength="50" />
		<input type="submit" name="button" id="button" value="Search" class="btn btn-info btn-sm" />
	</form>
	<hr />
	<div class="table-responsive">
	<table width="100%" class="table table-responsive table-hover">
	  <tr>
		<td width="10%;" align="center" bgcolor="grey">ID Produk</td>
		<td align="center" bgcolor="grey">Nama Produk</td>
		<td align="center" bgcolor="grey">Weight</td>
		<td align="center" bgcolor="grey">Volumetric</td>
		<td align="center" bgcolor="grey">Panjang</td>
		<td align="center" bgcolor="grey">Lebar</td>
		<td align="center" bgcolor="grey">Tinggi</td>
		<td align="center" bgcolor="grey">Packing Status</td>
		<td align="center" bgcolor="grey">Kategori Produk</td>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
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
			<td align="center">-</td>
			<td align="center">-</td>
			<td align="center">-</td>
			<td align="center">-</td>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
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
		<td align="center"><?=$data_waiting['id_produk_katalog'];?></td>
		<td align="center"><?=$data_waiting['produk_name'];?></td>
		<td align="center"><?=$data_waiting['weight'];?></td>
		<td align="center"><?=$data_waiting['volumetric'];?></td>
		<td align="center"><?=$data_waiting['panjang'];?></td>
		<td align="center"><?=$data_waiting['lebar'];?></td>
		<td align="center"><?=$data_waiting['tinggi'];?></td>
		<td align="center"><?=$data_waiting['packing_status'];?></td>
		<td align="center"><?=$data_waiting['nama_kategori_produk'];?></td>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
		?>
			<td align="center">
			<a href="admin.php?page=editprodukkatalog&&id=<?=$data_waiting['id_produk_katalog'];?>">
				<button type="button" class="btn btn-primary btn-sm" title="Edit Produk Katalog"><div class="fa fa-pencil"></div></button>
			</a>
			<a href="deleteprodukkatalog.php?id=<?=$data_waiting['id_produk_katalog'];?>" onClick="return confirm('Are you sure you want to DELETE??  Jika menghapus produk maka pada laporan transaksi Progress maupun Delivered semua produk akan ikut terhapus....');">
				<button type="button" class="btn btn-danger btn-sm" title="Hapus Produk Katalog"><div class="fa fa-trash"></div></button>
			</a>
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
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_produk_katalog WHERE produk_name LIKE '%$keyword%'");
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=produkkatalog&&halaman=1&&pencarian=on&&keyword=$keyword><< First</A> | 
					<A HREF=$file?page=produkkatalog&&halaman=$previous&&pencarian=on&&keyword=$keyword>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=produkkatalog&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=produkkatalog&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=produkkatalog&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=produkkatalog&&halaman=$next&&pencarian=on&&keyword=$keyword>Next ></A> | 
			  <A HREF=$file?page=produkkatalog&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}
		else
		{
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_produk_katalog");
			
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=produkkatalog&&halaman=1><< First</A> | 
					<A HREF=$file?page=produkkatalog&&halaman=$previous>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=produkkatalog&&halaman=$i>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=produkkatalog&&halaman=$i>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=produkkatalog&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=produkkatalog&&halaman=$next>Next ></A> | 
			  <A HREF=$file?page=produkkatalog&&halaman=$jmlhalaman>Last >></A> ";
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