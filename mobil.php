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
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_mobil AS mobil LEFT JOIN tbl_driver AS driver ON mobil.id_driver = driver.id_driver WHERE no_polisi LIKE '%$keyword%' ORDER BY mobil.no_polisi ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_mobil AS mobil LEFT JOIN tbl_driver AS driver ON mobil.id_driver = driver.id_driver ORDER BY mobil.no_polisi ASC LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Setting - <font color="blue">Mobil</font></h3>
</div>
<div class="widget-content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<h3><a href="admin.php?page=addmobil">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Mobil</a></h3>
		</td>
	</tr>
	</table>
	<form id="form1" name="form1" method="post" action="admin.php?page=mobil&&pencarian=on">
		Cari No Polisi Mobil
		<input name="keyword" type="text" id="keyword" size="10" maxlength="10" />
		<input type="submit" name="button" id="button" value="Search" class="btn btn-info btn-sm" />
	</form>
	<hr />
	<div class="table-responsive">
	<table width="100%" class="table table-responsive table-hover">
	  <tr>
		<td width="10%;" align="center" bgcolor="grey">ID Mobil</td>
		<td align="center" bgcolor="grey">No Polisi</td>
		<td align="center" bgcolor="grey">Merk</td>
		<td align="center" bgcolor="grey">Jenis</td>
		<td align="center" bgcolor="grey">Jumlah Ban</td>
		<td align="center" bgcolor="grey">Isi Silinder</td>
		<td align="center" bgcolor="grey">Tahun Pembuatan</td>
		<td align="center" bgcolor="grey">No Rangka</td>
		<td align="center" bgcolor="grey">No Mesin</td>
		<td align="center" bgcolor="grey">Masa Berlaku STNK</td>
		<td align="center" bgcolor="grey">Bahan Bakar</td>
		<td align="center" bgcolor="grey">Warna</td>
		<td align="center" bgcolor="grey">PIC Driver</td>
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
			<td align="center">-</td>
			<td align="center">-</td>
			<td align="center">-</td>
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
		<td align="center"><?=$data_waiting['id_mobil'];?></td>
		<td align="center"><?=$data_waiting['no_polisi'];?></td>
		<td align="center"><?=$data_waiting['merk'];?></td>
		<td align="center"><?=$data_waiting['jenis'];?></td>
		<td align="center"><?=$data_waiting['jumlah_ban'];?></td>
		<td align="center"><?=$data_waiting['isi_silinder'];?></td>
		<td align="center"><?=$data_waiting['tahun_pembuatan'];?></td>
		<td align="center"><?=$data_waiting['no_rangka'];?></td>
		<td align="center"><?=$data_waiting['no_mesin'];?></td>
		<td align="center"><?=$data_waiting['masa_berlaku_stnk'];?></td>
		<td align="center"><?=$data_waiting['bahan_bakar'];?></td>
		<td align="center"><?=$data_waiting['warna'];?></td>
		<td align="center"><?=$data_waiting['nama_driver'];?></td>
		<?php
		if($_SESSION['login']['username'] == "admin")
		{
		?>
			<td align="center">
			<a href="admin.php?page=editmobil&&id=<?=$data_waiting['id_mobil'];?>">				<button type="button" class="btn btn-primary btn-sm" title="Edit Mobil"><div class="fa fa-pencil"></div></button>			</a>
			<a href="deletemobil.php?id=<?=$data_waiting['id_mobil'];?>" onClick="return confirm('Are you sure you want to DELETE??');">				<button type="button" class="btn btn-danger btn-sm" title="Delete Mobil"><div class="fa fa-trash"></div></button>			</a>
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
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_mobil WHERE no_polisi LIKE '%$keyword%'");
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=mobil&&halaman=1&&pencarian=on&&keyword=$keyword><< First</A> | 
					<A HREF=$file?page=mobil&&halaman=$previous&&pencarian=on&&keyword=$keyword>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=mobil&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=mobil&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=mobil&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=mobil&&halaman=$next&&pencarian=on&&keyword=$keyword>Next ></A> | 
			  <A HREF=$file?page=mobil&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}
		else
		{
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_mobil");
			
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=mobil&&halaman=1><< First</A> | 
					<A HREF=$file?page=mobil&&halaman=$previous>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=mobil&&halaman=$i>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=mobil&&halaman=$i>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=mobil&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=mobil&&halaman=$next>Next ></A> | 
			  <A HREF=$file?page=mobil&&halaman=$jmlhalaman>Last >></A> ";
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