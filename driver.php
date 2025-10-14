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
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama_driver LIKE '%$keyword%' ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama_driver ASC LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Setting - <font color="blue">Driver</font></h3>
</div>
<div class="widget-content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<h3><a href="admin.php?page=adddriver">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Driver</a></h3>
		</td>
	</tr>
	</table>
	<form id="form1" name="form1" method="post" action="admin.php?page=driver&&pencarian=on">
		Cari Driver
		<input name="keyword" type="text" id="keyword" size="25" maxlength="25" />
		<input type="submit" name="button" id="button" value="Search" class="btn btn-info btn-sm" />
	</form>
	<hr />
	<div class="table-responsive">
	<table width="100%" class="table table-responsive table-hover table-bordered">
	  <thead>	  <tr>
		<th width="10%;" style="text-align:center;">ID Driver</th>
		<th align="center" style="text-align:center;">Nama Driver</th>
		<?php
		if($_SESSION['login']['username'] == "admin" || $_SESSION['login']['username'] == "staff")
		{
		?>
			<th width="10%;" style="text-align:center;">Config</th>
		<?php
		}
		?>
	  </tr>	  </thead>
	  <?php
	  if($row == NULL)
	  {
	  ?>
		<tbody>		<tr>
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
		</tr>		</tbody>
	  <?php
	  }
	  else
	  {
		while($data_waiting = mysqli_fetch_array($kueri_waiting))
		{
			$no++;
	  ?>
	  <tbody>	  <tr>
		<td align="center"><?=$data_waiting['id_driver'];?></td>
		<td align="center"><?=$data_waiting['nama_driver'];?></td>		
		<?php
		if($_SESSION['login']['username'] == "admin")
		{
		?>
			<td align="center">
			<a href="admin.php?page=editdriver&&id=<?=$data_waiting['id_driver'];?>">				<button type="button" class="btn btn-primary btn-sm" title="Edit Driver">					<span class="fa fa-pencil"></span>				</button>			</a>
			<a href="deletedriver.php?id=<?=$data_waiting['id_driver'];?>" onClick="return confirm('Are you sure you want to DELETE??');">				<button type="button" class="btn btn-danger btn-sm" title="Delete Driver">					<span class="fa fa-trash"></span>				</button>			</a>
			</td>
		<?php
		}
		?>
	  </tr>	  </tbody>
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
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama_driver LIKE '%$keyword%'");
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=driver&&halaman=1&&pencarian=on&&keyword=$keyword><< First</A> | 
					<A HREF=$file?page=driver&&halaman=$previous&&pencarian=on&&keyword=$keyword>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=driver&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=driver&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=driver&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=driver&&halaman=$next&&pencarian=on&&keyword=$keyword>Next ></A> | 
			  <A HREF=$file?page=driver&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}
		else
		{
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_driver");
			
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=driver&&halaman=1><< First</A> | 
					<A HREF=$file?page=driver&&halaman=$previous>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=driver&&halaman=$i>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=driver&&halaman=$i>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=driver&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=driver&&halaman=$next>Next ></A> | 
			  <A HREF=$file?page=driver&&halaman=$jmlhalaman>Last >></A> ";
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