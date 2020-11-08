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
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE nama_provinsi LIKE '%$keyword%' LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_provinsi LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Dashboard</h3>
</div>
<div class="widget-content">
	<?php
	if($_SESSION['login']['level'] == "super_admin"){
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<h3><a href="admin.php?page=addprovinsi">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Provinsi</a></h3>
		</td>
	</tr>
	</table>
	<?php
	}
	?>
	<form id="form1" name="form1" method="post" action="admin.php?page=provinsi&&pencarian=on">
		Cari Provinsi
		<input name="keyword" type="text" id="keyword" size="50" maxlength="50" />
		<input type="submit" name="button" id="button" value="Search" class="btn btn-info btn-sm" />
	</form>
	<hr />
	<div class="table-responsive">
	<table width="100%" class="table table-responsive table-hover">
	  <tr>
		<td width="10%;" align="center" bgcolor="grey">ID Provinsi</td>
		<td align="center" bgcolor="grey">Nama Provinsi</td>
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
		  $id_provinsi = $data_waiting['id_provinsi'];
		  $nama_provinsi = $data_waiting['nama_provinsi'];
	  ?>
	  <tr>
		<td align="center"><?=$data_waiting['id_provinsi'];?></td>
		<td align="center"><?=$data_waiting['nama_provinsi'];?></td>
		<?php
		if($_SESSION['login']['level'] == "super_admin"){
		?>
		<td align="center">
		<a href="admin.php?page=editprovinsi&&id=<?=$data_waiting['id_provinsi'];?>">			<button type="button" class="btn btn-primary btn-sm" title="Edit Provinsi"><div class="fa fa-pencil"></div></button>		</a>
		<a href="deleteprovinsi.php?id=<?=$data_waiting['id_provinsi'];?>" onClick="return confirm('Are you sure you want to DELETE??');">			<button type="button" class="btn btn-danger btn-sm" title="Delete Provinsi"><div class="fa fa-trash"></div></button>		</a>
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
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_provinsi WHERE nama_provinsi LIKE '%$keyword%'");
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=provinsi&&halaman=1&&pencarian=on&&keyword=$keyword><< First</A> | 
					<A HREF=$file?page=provinsi&&halaman=$previous&&pencarian=on&&keyword=$keyword>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=provinsi&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=provinsi&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=provinsi&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=provinsi&&halaman=$next&&pencarian=on&&keyword=$keyword>Next ></A> | 
			  <A HREF=$file?page=provinsi&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}
		else
		{
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_provinsi");
			
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=provinsi&&halaman=1><< First</A> | 
					<A HREF=$file?page=provinsi&&halaman=$previous>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=provinsi&&halaman=$i>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=provinsi&&halaman=$i>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=provinsi&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=provinsi&&halaman=$next>Next ></A> | 
			  <A HREF=$file?page=provinsi&&halaman=$jmlhalaman>Last >></A> ";
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