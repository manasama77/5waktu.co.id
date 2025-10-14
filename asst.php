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
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_asst WHERE nama_asst LIKE '%$keyword%' ORDER BY nama_asst ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_asst ORDER BY nama_asst ASC LIMIT $posisi,$batas");
}

$row = mysqli_num_rows($kueri_waiting);
?>
<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Setting - <font color="blue">Assistant</font></h3>
</div>
<div class="widget-content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left">
			<h3><a href="admin.php?page=addasst">
			<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Assistant</a></h3>
		</td>
	</tr>
	</table>
	<form id="form1" name="form1" method="post" action="admin.php?page=asst&&pencarian=on">
		Cari Assistant
		<input name="keyword" type="text" id="keyword" size="25" maxlength="25" />
		<input type="submit" name="button" id="button" value="Search" class="btn btn-info btn-sm" />
	</form>
	<hr />
	<div class="table-responsive">
	<table width="100%" class="table table-responsive table-hover">
	  <tr>
		<td width="10%;" align="center" bgcolor="grey">ID Assistant</td>
		<td align="center" bgcolor="grey">Nama Assistant</td>
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
		<td align="center"><?=$data_waiting['id_asst'];?></td>
		<td align="center"><?=$data_waiting['nama_asst'];?></td>
		<?php
		if($_SESSION['login']['username'] == "admin")
		{
		?>
			<td align="center">
			<a href="admin.php?page=editasst&&id=<?=$data_waiting['id_asst'];?>">				<button type="button" class="btn btn-primary btn-sm" title="Edit Assistant Driver">					<div class="fa fa-pencil"></div>				</button>			</a>
			<a href="deleteasst.php?id=<?=$data_waiting['id_asst'];?>" onClick="return confirm('Are you sure you want to DELETE??');">				<button type="button" class="btn btn-danger btn-sm" title="Delete Assistant Driver">					<div class="fa fa-trash"></div>				</button>			</a>
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
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_asst WHERE nama_asst LIKE '%$keyword%'");
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=asst&&halaman=1&&pencarian=on&&keyword=$keyword><< First</A> | 
					<A HREF=$file?page=asst&&halaman=$previous&&pencarian=on&&keyword=$keyword>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=asst&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=asst&&halaman=$i&&pencarian=on&&keyword=$keyword>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=asst&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=asst&&halaman=$next&&pencarian=on&&keyword=$keyword>Next ></A> | 
			  <A HREF=$file?page=asst&&halaman=$jmlhalaman&&pencarian=on&&keyword=$keyword>Last >></A> ";
			}
			else
			{ 
				echo " | Next > | Last >>";
			}
			echo "<p>Total Item : <b>$jmldata</b> Item</p>";
		}
		else
		{
			$hasil2 = mysqli_query($con, "SELECT * FROM tbl_asst");
			
			$jmldata=mysqli_num_rows($hasil2);
			$jmlhalaman=ceil($jmldata/$batas);
			//link ke halaman sebelumnya (previous)
			if($halaman > 1)
			{
				$previous=$halaman-1;
				echo "<A HREF=$file?page=asst&&halaman=1><< First</A> | 
					<A HREF=$file?page=asst&&halaman=$previous>< Previous</A> | ";
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
			  $angka .= "<a href=$file?page=asst&&halaman=$i>$i</A> ";
			}
			
			$angka .= " <b><u>$halaman</u></b> ";
			for($i=$halaman+1;$i<($halaman+3);$i++)
			{
			  if ($i > $jmlhalaman) 
				  break;
			  $angka .= "<a href=$file?page=asst&&halaman=$i>$i</A> ";
			}
			
			$angka .= ($halaman+2<$jmlhalaman ? " ...  
					  <a href=$file?page=asst&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
			
			echo "$angka";
			
			//link kehalaman berikutnya (Next)
			if($halaman < $jmlhalaman)
			{
				$next=$halaman+1;
				echo " | <A HREF=$file?page=asst&&halaman=$next>Next ></A> | 
			  <A HREF=$file?page=asst&&halaman=$jmlhalaman>Last >></A> ";
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