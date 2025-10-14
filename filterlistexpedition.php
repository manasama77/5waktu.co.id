<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$keyword_expedition = $_REQUEST['keyword_expedition'];

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
if($keyword_expedition == NULL)
{
	$kueri_expedition = mysqli_query($con, "SELECT * FROM tbl_expedition ORDER BY nama_expedition ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_expedition = mysqli_query($con, "SELECT * FROM tbl_expedition WHERE nama_expedition LIKE '%$keyword_expedition%' ORDER BY nama_expedition ASC LIMIT $posisi,$batas");
}
?>
<div><h3><a href="admin.php?page=addexpedition">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Expedition / Ekspedisi
</a></h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fexpedition&&halaman=1">
Pencarian by Expedition Name
<input name="keyword_expedition" type="text" id="keyword_expedition" size="50" maxlength="50" />
<input type="submit" name="button" id="button" value="Search" />
</form>
</div>
<hr/>
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Expedition</b></td>
    <td align="center"  bgcolor="grey"><b>Nama Expedition</b></td>
    <td align="center"  bgcolor="grey"><b>Duration / Day</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_expedition);
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
	  while($data_expedition = mysqli_fetch_array($kueri_expedition))
	  {
	  ?>
	  <tr>
		<td align="center"><?=$data_expedition['id_expedition'];?></td>
		<td align="center"><?=$data_expedition['nama_expedition'];?></td>
        <td align="center"><?=$data_expedition['duration'];?></td>
		<td align="center"><a href="admin.php?page=editexpedition&&id=<?=$data_expedition['id_expedition'];?>"><div class="icon-edit"></div></a>
    	<br />
    	<a href="deleteexpedition.php?id=<?=$data_expedition['id_expedition'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
	  </tr>
  <?php
  	  }
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="SELECT * FROM tbl_expedition WHERE nama_expedition LIKE '%$keyword_expedition%'";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=fexpedition&&halaman=1&&keyword_expedition=$keyword_expedition><< First</A> | 
            <A HREF=$file?page=configuration&&tab=fexpedition&&halaman=$previous&&keyword_expedition=$keyword_expedition>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=fexpedition&&halaman=$i&&keyword_expedition=$keyword_expedition>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=fexpedition&&halaman=$i&&keyword_expedition=$keyword_expedition>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=fexpedition&&halaman=$jmlhalaman&&keyword_expedition=$keyword_expedition>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=fexpedition&&halaman=$next&&keyword_expedition=$keyword_expedition>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=fexpedition&&halaman=$jmlhalaman&&keyword_expedition=$keyword_expedition>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>