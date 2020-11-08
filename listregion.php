<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$batas=5;
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
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region ORDER BY nama_region ASC LIMIT $posisi,$batas");
?>
<div><h3><a href="admin.php?page=addregion">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Region / Wilayah
</a></h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fregion&&halaman=1">
Pencarian by Nama Region
<input name="keyword_region" type="text" id="keyword_region" size="50" maxlength="50" />
<input type="submit" name="button" id="button" value="Search" />
</form>
</div>
<hr/>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td width="10%" align="center" bgcolor="grey"><b>ID Region</b></td>
    <td align="center"  bgcolor="grey"><b>Nama Region</b></td>
    <td align="center"  bgcolor="grey"><b>Duration</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_region);
  if($row == NULL)
  {
  ?>
  <tr>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
  </tr>
  <?php
  }
  else
  {	  
	  while($data_region = mysqli_fetch_array($kueri_region))
	  {
	  ?>
	  <tr>
		<td align="center" width="10%"><?=$data_region['id_region'];?></td>
		<td align="center"><?=$data_region['nama_region'];?></td>
		<td align="center"><?=$data_region['duration'];?> Hari</td>
		<td align="center"><a href="admin.php?page=editregion&&id=<?=$data_region['id_region'];?>"><div class="icon-edit"></div></a>
    	<br />
    	<a href="deleteregion.php?id=<?=$data_region['id_region'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
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
    
    $tampil2="select * from tbl_region";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=region&&halaman=1><< First</A> | 
            <A HREF=$file?page=configuration&&tab=region&&halaman=$previous>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=region&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=region&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=region&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=region&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=region&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>